<template>
    <app-layout title="Add Chile menu">
        <template #header>
          <Breadcrumb :items="breadcrumbs"/>
        </template>
      <Container>
        <Card>
            <form @submit.prevent="saveChilemenu">
                <!--Name--->+
                    <div class="">
                        <jet-label for="name" value="Chile menu" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div> 
                     <!--Slug--->
          
                <!--Id Parent--->
                  
                   <!--Url--->
                 
                   <!--Status--->
                   <div class="mt-4">
                            <Checkbox :checked="checkededit" v-model="form.status"/><span class="ml-2">Hiển thị</span>   
                    </div>  
                   <!--Action--->
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
    import Checkbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import CompSimplePage from '@/Components/SimplePage'
    import AppImage from "@/Components/Image";
     
    import {strSlug} from "@/helpers.js"
   

    export default {
        name:'Add Chile menu',
        props:{
            edit: Boolean,
           
            chilemenueEdite:""
        },
        components: { 
            AppLayout,
            Container,
            Card,
            Breadcrumb,
            AppImage,
            DeleteBtn,
            CompSimplePage,
            AppTable,
            JetButton,
            JetLabel,
            JetInput,
            JetInputError,
            JetActionMessage,     
            Checkbox
                       
        },
        data(){
            return {
               checkededit:'',
                form: this.$inertia.form({
                    "_method": this.edit ? 'PUT' : "",
                    name:"",
                    status:"",
            },
            {
                resetOnSuccess:false,
            }),
            
              
            };
        },
        computed:{
            breadcrumbs(){
                return [
                    {
                    label: "Chile menu",
                    url: route('chilemenus.index'),
                    },
                    {
                    label: `${this.edit ? 'Edit' : 'Add'} Chile menu`
                    }
                ];
            }
        },
       
        methods:{
            saveChilemenu(){
               //alert(123);
                this.edit
                ? this.form.put(route('chilemenus.update',{id: this.chilemenueEdite.data.id }))
                : this.form.post(route('chilemenus.store'));
            }
        },
        mounted() {
            if (this.edit) {
            this.form.name = this.chilemenueEdite.data.name;  
            //this.checkededit=this.menuedit.data.status==1? true:false;
            }
        }

    }
</script>
