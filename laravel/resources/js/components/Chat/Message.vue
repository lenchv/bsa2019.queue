<template>
    <div class="message">
        <div v-bind:class="{
            owner: isOwner
        }">
            {{ message.text }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            authorId: String,
            message: Object
        },

        computed: {
            isOwner() {
                return this.authorId === this.message.author;
            }
        }
    }
</script>
