<template>
    <button v-on:click="run">Run failed job</button>
</template>

<script>
import requestService from '../../services/requestService';
export default {
    methods: {
        run() {
            requestService.fetch('PUT', '/api/queue/fail');
        }
    }
}
</script>

