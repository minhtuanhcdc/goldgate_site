<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="py-1">
             <div class="px-1 py-1 text-left rounded-lg" :class="{bgHeader,maxWidth}">
                <slot name="title">
                </slot>
            </div>

            <div class="mt-2">
                <slot name="content">
                </slot>
            </div>
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
         
           bgHeader:{
            type:String,
            required:true
        },
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
