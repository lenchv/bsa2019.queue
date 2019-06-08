<template>
    <div class="message">
        <div class="message__text" v-bind:class="{
            message__text_owner: isOwner
        }">
            {{ message.text }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            userName: String,
            message: Object
        },

        computed: {
            isOwner() {
                return this.userName === this.message.author;
            }
        }
    }
</script>

<style lang="scss" scopped>
    .message {
        overflow: hidden;

        &__text {
            float: left;
            padding: 5px 10px;
            border-radius: 0 17px 17px 0;
            margin: 1px 0; 
            background-color: #d3e9fb;
            
            &_owner {
                float: right;
                border-radius: 17px 0 0 17px;
                background-color: #f0f0f0;
            }
        }
    }
</style>
