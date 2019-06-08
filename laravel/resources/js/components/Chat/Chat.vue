<template>
    <div class="chat-wrapper">
        <div class="chat">
            <div class="chat__messages">
                <message
                    v-for="(message, index) in messages"
                    v-bind:userName="user.name"
                    v-bind:message="message"
                    v-bind:key="index"
                />
            </div>
            <div class="chat__input">
                <chat-input v-on:change="send"/>
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
                showAuthModal: false
            };
        },
        computed: {
            needsAuthorization() {
                return !this.user.id;
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
                    })
                    .catch(console.error);
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
                        chatService.broadcast('chat')
                            .on(`MessageEvent`, (e) => {
                                this.messages.push(
                                    chatService.getMessage(
                                        e.message,
                                        e.author
                                    )
                                );
                            });
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

            &::-webkit-scrollbar { 
                display: none; 
            }
        }
    }
    .chat-wrapper {
        max-width: 600px;
        height: 600px;
        margin: 50px auto;
        position: relative;
    }
</style>
