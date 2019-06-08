<template>
    <div>
        <div class="chat">
            <div class="chat__messages">
                <message
                    v-for="(message, index) in messages"
                    v-bind:authorId="authorId"
                    v-bind:message="message"
                    v-bind:key="index"
                />
            </div>
            <div class="chat__input">
                <chat-input v-on:change="send"/>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatInput from './ChatInput.vue';
    import Message from './Message.vue';

    const getMessage = (text, author) => ({ text, author });

    export default {
        components: {
            'chat-input': ChatInput,
            'message': Message
        },
        data() {
            return {
                authorId: null,
                messages: []
            };
        },
        computed: {
            isOwner() {

            }
        },
        methods: {
            send(message) {
                this.messages.push(
                    getMessage(message, this.authorId)
                );
            }
        },
        mounted() {
            this.authorId = "1";

            Echo.channel('chat')
                .listen('MessageEvent', (e) => {
                    console.log(e);
                    this.messages.push(
                        getMessage(e.text, e.author)
                    );
                });
        }
    }
</script>

<style lang="scss" scoped>
    .chat {
        max-width: 600px;
        height: 600px;
        margin: 50px auto;
        position: relative;
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
</style>
