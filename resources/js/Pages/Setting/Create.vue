<template>
    <app-layout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Setting
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
              <UpdateHeroData :settings="settings"/>

            <jet-section-border/>

             <UpdateAboutData :settings="settings"/>
             
              <jet-section-border/>

             <UpdateContactData :settings="settings"/>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import UpdateHeroData from './UpdateHeroData.vue'
    import UpdateAboutData from './UpdateAboutData.vue'
    import UpdateContactData from './UpdateContactData.vue'
    import JetSectionBorder from '@/Jetstream/SectionBorder'

    export default defineComponent({
        props: ['settings'],
        components: {
            AppLayout,
           UpdateHeroData,
           JetSectionBorder,
           UpdateAboutData,
           UpdateContactData
        },
    })
</script>
