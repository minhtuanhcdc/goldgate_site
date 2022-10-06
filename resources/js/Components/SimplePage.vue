<template>
    <div class="flex items-center justify-between">
        <JetButton 
            :href="prevUrl"
            :disable="!prevUrl"
            :class="{'opacity-50':!prevUrl}">
            Previous
        </JetButton>
        <JetButton 
            :href="nextUrl"
            :disable="!nextUrl"
            :class="{'opacity-50':!nextUrl}">
            Next
        </JetButton>
    </div>
</template>

<script>
 import JetButton from '@/Jetstream/Button'
export default {
    components:{
        JetButton
    },
    props:{
        prevUrl:{},
        nextUrl:{}
    }
}
</script>

<style>

</style>