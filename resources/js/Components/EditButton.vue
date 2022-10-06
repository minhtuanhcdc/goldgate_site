<template>
    <button @click="visit" :type="type" class="">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'
    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
            href:{}
        },
        methods:{
            visit(event){
                if(!this.href){
                    return
                }
                event.preventDefault();           
                this.$inertia.visit(this.href);
            }
        }
    })
</script>
