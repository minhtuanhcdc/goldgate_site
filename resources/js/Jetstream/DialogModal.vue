<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-2">
            <div class="text-lg">
                <slot name="title">
                </slot>
            </div>

            <div class="mt-2">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div class="px-6 py-2 bg-gray-100 text-right">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import { defineComponent } from 'vue'
    import Modal from './Modal.vue'

    export default defineComponent({
        emits: ['close'],

        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    })
</script>
