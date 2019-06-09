<template>
    <button v-on:click="task">{{ name }} <span>{{ strTime }} sec.</span></button>
</template>

<script>
export default {
    props: {
        name: String,
        f: Function
    },
    data() {
        return {
            time: 0
        };
    },

    computed: {
        strTime() {
            return this.time.toFixed(2);
        }
    },

    methods: {
        task() {
            this.time = 0;
            const interval = setInterval(() => {
                this.time += 0.1;
            }, 100);

            this.f().then(() => {
                clearInterval(interval);
            }, () => {
                clearInterval(interval);
            });
        }
    }
}
</script>

