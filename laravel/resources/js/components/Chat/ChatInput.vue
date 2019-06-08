<template>
    <div class="chat-input">
        <div class="chat-input__container chat-input__container--left">
            <input class="chat-input__text" type="text" v-model="message" v-on:keyup.enter="send"/>
        </div>
        <div class="chat-input__container chat-input__container--right">
            <button class="chat-input__button" v-on:click="send">send</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },

        methods: {
            send() {
                this.$emit('change', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .chat-input {
        &__container {
            height: 30px;
            float: left;

            &--left {
                width: calc(100% - 100px);
            }
            &--right {
                width: 100px;
            }
        }

        &__button {
            width: 100%;
            border: 2px solid #ddd;
            border-left: none;
            border-radius: 0 15px 15px 0;
            background-color: transparent;
            box-sizing: border-box;
            height: 30px;

            &:focus {
                outline: none;
                border-color: #cae3f7;
            }
            &:hover {
                cursor: pointer;
            }
        }

        &__text {
            width: 100%;
            padding: 1px 10px;
            border: none;
            border: 2px solid #ddd;
            border-right: none;
            background-color: transparent;
            box-sizing: border-box;
            height: 30px;

            &:focus {
                outline: none;
                border-color: #cae3f7;                
            }
        }
    }
</style>
