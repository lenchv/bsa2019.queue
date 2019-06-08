<template>
    <Chat></Chat>
</template>

<script>
    import Chat from "./Chat/Chat.vue";

    export default {
        components: {
            Chat
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
