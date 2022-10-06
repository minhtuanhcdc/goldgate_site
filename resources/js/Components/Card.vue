<template>
    <div class="px-20 overflow-hidden shadow-xl sm:rounded-lg sm:py-2 sm:px-6 justify-items-center" :class="addClassCard">
        <slot></slot>
    </div>
</template>

<script>
export default {
props:{
    addClassCard:{
        type:String,
        required:true
    }
}
}
</script>

<style>

</style>