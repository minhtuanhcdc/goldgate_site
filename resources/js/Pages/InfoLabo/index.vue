<template>
    <app-layout title="Nhập thông tin">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Thông tin xét nghiệm
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   InfoLabo Page
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
   
    export default defineComponent({
        components: {
            AppLayout,
            
        },
    })
</script>
