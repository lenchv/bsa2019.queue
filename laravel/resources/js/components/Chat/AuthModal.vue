<template>
    <div v-if="show" class="auth-modal">
        <div class="auth-modal__backdrop"></div>
        <div class="auth-modal__form-container">
            <div class="auth-modal__form">
                <input
                    type="text"
                    class="auth-modal__input"
                    placeholder="Enter your name ..."
                    v-model="name"
                    v-on:keyup.enter="enter"
                >
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            show: Boolean
        },
        data() {
            return {
                name: ''
            }
        },
        methods: {
            enter() {
                this.$emit('enter', this.name);
            }
        }
    };
</script>

<style lang="scss" scoped>
    .auth-modal {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;

        &__backdrop {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            z-index: 5;
            background: #333;
            opacity: 0.3;
        }

        &__form-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 6;
        }

        &__form {
            padding: 50px 30px;
            border: 1px solid #efefef;
            background-color: #fff;
            margin: auto;
        }

        &__input {
            width: 100%;
        }
    }
</style>
