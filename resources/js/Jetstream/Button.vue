<template>
    <button @click="visit" :type="type" class="bg-blue-800 py-1 px-2 inline-flex items-center  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
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
