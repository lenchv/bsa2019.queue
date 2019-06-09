<template>
    <div>
        <div
            class="toggler"
            :class="{
                'toggler_toggled': isQueue
            }"
            v-on:click="onQueue"
        >Example #1</div>
        <Queue v-if="isQueue" />
        <div
            class="toggler"
            :class="{
                'toggler_toggled': isFailed
            }"
            v-on:click="onFailed"
        >Example #2</div>
        <Failed v-if="isFailed"/>
        <div
            class="toggler"
            :class="{
                'toggler_toggled': isChat
            }"
            v-on:click="onChat"
        >Example #3</div>
        <Chat v-if="isChat" />
    </div>
</template>

<script>
    import Chat from "./Chat/Chat.vue";
    import Queue from './Queue/Queue.vue';
    import Failed from './Queue/Failed.vue';

    export default {
        components: {
            Chat,
            Queue,
            Failed
        },

        data() {
            return {
                task: 'queue'
            };
        },

        computed: {
            isQueue() {
                return this.task === 'queue';
            },
            isChat() {
                return this.task === 'chat';
            },
            isFailed() {
                return this.task === 'failed';
            },
        },

        methods: {
            onQueue() {
                this.task = 'queue';
            },
            onChat() {
                this.task = 'chat';
            },
            onFailed() {
                this.task = 'failed';
            },
        }
    }
</script>

<style lang="scss" scoped>
    .toggler {
        border: 1px solid #ddd;
        background: #eee;
        cursor: pointer;

        &:before {
            content: "+";
            padding-right: 5px;
        }

        &_toggled:before {
           content: "-";
        }
    }
</style>

