<template>
    <div>
        <div>
            <label>Complexity</label>
            <input type="number" v-model="complexity">
        </div>
        <Button :f="syncTask" :name="'Sync'"></Button>
        <Button :f="asyncTask" :name="'Async'"></Button>
    </div>
</template>

<script>
import requestService from '../../services/requestService';
import Button from './Button.vue';

export default {
    components: {
        Button
    },
    data() {
        return {
            complexity: 100,
        };
    },
    methods: {
        syncTask() {
            return requestService.fetch('PUT', '/api/queue/sync', {
                complexity: this.complexity,
                data: 'some data'
            });
        },

        asyncTask() {
            return requestService.fetch('PUT', '/api/queue/async', {
                complexity: this.complexity,
                data: 'some data'
            });
        }
    }
}
</script>
