<template>
    <app-layout title="Add Menu">
        <template #header>
          <Breadcrumb :items="breadcrumbs"/>
        </template>
      <Container>
        <Card>
            <form @submit.prevent="saveMenu">
                <!--Name--->+
                    <div class="">
                        <jet-label for="name" value="Tên menu" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                        <jet-input-error :message="form.errors.name" class="mt-2" />
                    </div> 
                     <!--Slug--->
          
                <!--Id Parent--->
                    <div class="mt-4">
                        <jet-label for="parent_id"
                                value="Parent menu" />
                        <select name="parent_id"
                                id="parent_id"
                                class="block w-full form-input"
                                v-model="form.parent_id">
                        <option value="">===Select===</option>
                        <option value="0">Không</option>
                        <option v-for="menu in menus.data"
                                :key="menu.id"
                                :value="menu.id">{{ menu.name }}</option>
                        </select>
                        <jet-input-error :message="form.errors.parent_id"
                            class="mt-2" />
                    </div>
                   <!--Url--->
                   <div class="mt-4">
                        <jet-label for="url" value="Url" />
                        <jet-input id="url" type="text" class="mt-1 block w-full" v-model="form.url" autocomplete="url" />
                        <jet-input-error :message="form.errors.url" class="mt-2" />
                    </div>  
                   <!--Icon--->
                   <div class="mt-4">
                        <jet-label for="icon" value="Icon" />
                        <jet-input id="icon" type="text" class="mt-1 block w-full" v-model="form.icon" autocomplete="icon" />
                        <jet-input-error :message="form.errors.icon" class="mt-2" />
                    </div>  
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
        name:'Add article',
        props:{
            edit: Boolean,
            menus: Object,
            menuedit:""
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
                    parent_id:"",
                    url:"",
                    icon:"",
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
                    label: "Menu",
                    url: route('menus.index'),
                    },
                    {
                    label: `${this.edit ? 'Edit' : 'Add'} Menu`
                    }
                ];
            }
        },
       
        methods:{
            saveMenu(){
               //alert(123);
                this.edit
                ? this.form.put(route('menus.update',{id: this.menuedit.data.id }))
                : this.form.post(route('menus.store'));
            }
        },
        mounted() {
            if (this.edit) {
            this.form.name = this.menuedit.data.name;
            this.form.id_parent = this.menuedit.data.id_parent;
            this.form.url = this.menuedit.data.url;
            this.form.icon = this.menuedit.data.icon;
            this.form.status = this.menuedit.data.status;
            this.checkededit=this.menuedit.data.status==1? true:false;
            }
        }

    }
</script>
