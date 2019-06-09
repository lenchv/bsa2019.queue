<template>
    <div class="chat-wrapper">
        <button v-if="needsLogout" class="logout-button" v-on:click="logout">logout</button>
        <div class="chat">
            <div class="chat__messages">
                <message
                    v-for="(message, index) in messages"
                    v-bind:userName="user.name"
                    v-bind:message="message"
                    v-bind:key="index"
                />
            </div>
            <div v-if="typing" class='chat__typing'>{{ typing }} is typing ...</div>
            <div class="chat__input">
                <chat-input v-on:change="send" v-on:typing="whisper"/>
            </div>
        </div>
        <auth-modal v-bind:show="showAuthModal" v-on:enter="auth"/>
    </div>
</template>

<script>
    import AuthModal from './AuthModal.vue';
    import ChatInput from './ChatInput.vue';
    import Message from './Message.vue';
    import chatService from '../../services/chatService';
    import userService from '../../services/userService';

    export default {
        components: {
            'chat-input': ChatInput,
            'message': Message,
            'auth-modal': AuthModal
        },
        data() {
            return {
                user: {},
                messages: [],
                showAuthModal: false,
                typing: ''
            };
        },
        computed: {
            needsLogout() {
                return !this.showAuthModal;
            }
        },
        methods: {
            send(message) {
                chatService.putMessage(message, this.user.id)
                    .then(() => {
                        const messageItem = chatService.getMessage(
                            message,
                            this.user.name
                        );
                        this.messages.push(messageItem);
                        this.scrollToEnd();
                    })
                    .catch(console.error);
            },

            scrollToEnd() {
                setTimeout(() => {
                    const messagesBlock = this.$el.querySelector('.chat__messages');
                    messagesBlock.scrollTop = messagesBlock.scrollHeight;
                }, 0);
            },

            whisper(e) {
                chatService.broadcast('chat').whisper('typing', {
                    name: this.user.name
                });
            },

            loadMessages() {
                return chatService.getMessages(this.user.id).then(messages => {
                    this.messages = messages;
                    this.scrollToEnd();
                });
            },

            logout() {
                userService.saveUser('');
                this.user = {};
                this.showAuthModal = true;
                this.messages = [];
                chatService.broadcast('chat').leave();
            },

            auth(userName) {
                return userService.authnticate(userName)
                    .then(userData => {
                        this.user = Object.assign({
                            name: '',
                            id: -1
                        }, userData);

                        return this.user;
                    })
                    .then((user) => {
                        this.showAuthModal = false;
                        let timeout = null;

                        chatService.broadcast('chat')
                            .on(`MessageEvent`, (e) => {
                                this.messages.push(
                                    chatService.getMessage(
                                        e.message,
                                        e.author
                                    )
                                );
                                this.scrollToEnd();
                            })
                            .onWhisper('typing', (e) => {
                                this.typing = e.name;
                                clearTimeout(timeout);
                                timeout = setTimeout(() => {
                                    this.typing =null;
                                }, 1000);
                            });

                        this.loadMessages();
                    })
                    .catch(error => {
                        console.error(error);
                        this.user = {};
                        this.showAuthModal = true;
                    });
            }
        },
        mounted() {
            this.auth(
                userService.getUser()
            );
        }
    }
</script>

<style lang="scss" scoped>
    .chat {
        width: 100%;
        height: 100%;
        border: 1px solid #efefef;

        &__input {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 30px;
        }

        &__messages {
            height: calc(100% - 30px);
            overflow-y: auto;
            padding-bottom: 20px;
        }

        &__typing {
            position: absolute;
            bottom: 30px;
            height: 20px;
        }
    }
    .chat-wrapper {
        max-width: 600px;
        max-height: 600px;
        height: calc(100vh - 100px);
        margin: 50px auto;
        position: relative;
    }

    .logout-button {
        position: absolute;
        top: -30px;
        height: 30px;
    }
</style>
