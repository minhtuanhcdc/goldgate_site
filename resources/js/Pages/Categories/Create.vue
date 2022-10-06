<template>
    <app-layout title="Add Category">
        <template #header>
           <Breadcrumb :items="breadcrumbs"/>
        </template>
      <Container>
        <Card>
            <form @submit.prevent="saveCategory">
                <!--Name--->+
                    <div class="">
                        <jet-label for="name" value="Name" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div> 
                <!--Slug--->
                    <div class="mt-2">
                        <jet-label for="slug" value="Slug" />
                        <jet-input id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" autocomplete="slug" />
                        <jet-input-error :message="form.errors.slug" class="mt-2" />
                    </div> 
                    <div class="text-right mt-2">
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        <span v-if="edit">Updated.</span>
                        <span v-else >Saved.</span>                    
                    </jet-action-message>
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <span v-if="edit">Update</span>
                        <span v-else >Save</span>
                    </jet-button>
                    </div>
            </form>   
        </Card>
      </Container>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import Breadcrumb from '@/Components/Breadcrumb'
import Container from '@/Components/Container'
import Card from '@/Components/Card'
import AppTable from '@/Components/Table'

    import DeleteBtn from '@/Components/DeleteBtn'   
    import JetButton from '@/Jetstream/Button'
    import JetLabel from '@/Jetstream/Label'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import CompSimplePage from '@/Components/SimplePage'
     
    import {strSlug} from "@/helpers.js"

    export default {
        name:'Add Category',
        props:{
            edit: Boolean,
            category: Object
        },
        components: { 
            AppLayout,
            Container,
            Card,
            Breadcrumb,

            DeleteBtn,
            CompSimplePage,
            AppTable,
            JetButton,
            JetLabel,
            JetInput,
            JetInputError,
            JetActionMessage                 
        },
        data(){
            return {
                form: this.$inertia.form({
                    name:"",
                    slug:""
            },
            {
                resetOnSuccess:false,
            })
            };
        },
        computed:{
            breadcrumbs(){
                return [
                    {
                    label: "Categories",
                    url: route('categories.index'),
                    },
                    {
                    label: `${this.edit ? 'Edit' : 'Add'} Category`
                    }
                ];
            }
        },
        watch:{
            "form.name"(name){
                this.form.slug=strSlug(name);
            }, 
        },
        methods:{
            saveCategory(){
                //alert(123);
                this.edit
                ? this.form.put(route('categories.update',{id: this.category.data.id }))
                : this.form.post(route('categories.store'));
            }
        },
        mounted() {
            if (this.edit) {
            this.form.name = this.category.data.name;
            this.form.slug = this.category.data.slug;
            }
        }
    }
</script>
