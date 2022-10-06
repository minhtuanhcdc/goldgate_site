<template>
    <div v-show="message">
        <p class="text-lg text-red-600 text-center">
            {{ message }}
        </p>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['message']
    })
</script>
