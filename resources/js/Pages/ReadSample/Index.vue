<template>
  <app-layout title="BS đọc mẫu ">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <!---
       :src="pathImage+`${ou.logo}`"
       src="/storage/image_Ousent/202205161136.jpg"
      --->
      <Card>
        <div class="flex justify-between">
         <div class="flex justify-between mt-2">

                    <div class=" bg-blue-100">
                      <div class=" text-right">
                        <div class="flex mb-2 text-right h-8 px-2 w-full">
                                    <jet-input
                                      placeholder="..."
                                      id="search"
                                      type="text"
                                      class="mt-1 block w-full h-8 mr-2"
                                      autocomplete="search"
                                      v-model="termSearch"
                                      @keyup="search"
                                    />
                                <span class="justify-center justify-items-center mt-2 cursor-pointer" >
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                  </svg>
                                </span>
                          </div>
                        </div>
                    </div>

            </div>

            <div class="">
                <div class="p-0 text-right rounded-sm">
                <div class="flex flex-row justify-end">
                        <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="perPage:" />
                        <select
                          name="perPage"
                          id="perPage"
                          class="block py-0 w-24 form-input h-8 rounded-lg"
                          v-model="perPage"
                          @change="getfilePerpage"
                        >
                          <option value="1">1</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                          <option value="100">100</option>

                        </select>

                </div>
                </div>
          </div>
           <Button  class="mb-1 float-right cursor-pointer"  @click="addOu">+ Add</Button>
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr v-for="(or, i) in oureads.data" :key="i" class="hover:bg-blue-300">

            <td class="border-r-2">{{i+1}}</td>
            <td class="border-r-2">{{or.title }}<span class="ml-1">{{or.name}}</span></td>
            <td class="border-r-2">{{or.read_code}}</td>
            <td class="border-r-2">{{or.sub_read_code}}</td>
            <td class="border-r-2">{{or.phone}}</td>
            <td class="border-r-2 w-48">
              <img :src="pathAsign + or.asign" class="h-20 w-auto"/>
              </td>
            <td class="border-r-2 text-center w-16">
              <span v-if="or.asign_hpv" class="text-4xl text-center  ">v</span>
              <span v-else></span>
            </td>
            <td class="border-r-2">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOuRead(or)"
                  >
                   <svg
                    class="w-6 h-6 text-blue-800 cursor-pointer"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                    ></path></svg>
                </EditBtn>
                <DeleteBtn
                  :url="route('oureads.destroy',or.id)"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="ou"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
         <div class="flex" v-if="oureads">
           <Pagination :links="oureads.links"/>

         </div>
        </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode" >Thêm đơn vị đọc mẫu </h3>
                <h3 v-show="editMode">Thay đổi thông tin </h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveOuR(form)">
                    <div class="grid grid-cols-1">
                      <div class="mt-2">
                        <jet-label for="title" value="Chức danh" class="font-bold text-lg text-blue-800"/>
                        <jet-input
                            required
                          id="title"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.title"
                          autocomplete="tile"
                        />
                         <!-- <div class="ml-4 text-red-800" v-if="errors.title"> * {{ errors.title }}</div> -->
                      </div>
                      <div class="mt-2">
                        <jet-label for="name" value="Tên đơn vị ( BS đọc mẫu)" class="font-bold text-lg text-blue-800"/>
                        <jet-input
                        required
                          id="name"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.name"
                          autocomplete="name"
                        />
                         <div class="ml-4 text-red-800" v-if="errors.name"> * {{ errors.name }}</div>
                      </div>
                    </div>
                    <div class="grid grid-cols-1">
                      <div class="ml-1 mt-2">
                            <jet-label for="read_code" value="Mã đọc mẫu" class="font-bold text-lg text-blue-800"/>
                            <jet-input required
                              id="read_code"
                              type="text"
                              class="mt-4 block w-3/4"
                              v-model="form.read_code"
                              autocomplete="read_code"
                            />
                           <div class="ml-4 text-red-800" v-if="errors.read_code"> * {{ errors.read_code}}</div>

                      </div>
                    </div>
                    <div class="flex justify-evenly items-center border-1  border-gray-400 mt-2 py-2">
                      <div class="flex flex-1">
                         <jet-label for="id_parent" value="Mã chính" class="font-bold text-lg w-20 text-blue-800"/>
                        <select id="id_parent" v-model="form.id_parent" class="rounded-sm h-8 flex-1 py-0">
                          <option value="">--</option>
                           <option
                              v-for="(ou,i) in getOuread"
                              :key="i"
                              :value="ou.id"
                            >{{ou.name}}-({{ou.read_code}})</option>
                        </select>
                      </div>
                      <div class="flex justify-end items-center">
                            <jet-label for="read_code" value="Mã phụ" class="font-bold text-lg text-blue-800"/>
                            <jet-input
                              id="read_code"
                              type="text"
                              class="block w-1/2 h-8"
                              v-model="form.sub_read_code"
                              autocomplete="read_code"
                            />
                           <div class="ml-4 text-red-800" v-if="errors.read_code"> * {{ errors.read_code}}</div>

                      </div>
                    </div>
                <div class="grid grid-cols-1">
                      <div class="ml-1 mt-4">
                            <jet-label for="id_ou" value="phone" class="font-bold text-lg text-blue-800"/>
                            <jet-input
                              id="phone"
                              type="text"
                              class="mt-4 block w-3/4"
                              v-model="form.phone"
                              autocomplete="phone"
                            />
                      </div>
                </div>
                  <div class="ml-2 mt-2 border-1 border-gray-700">
                     <jet-label for="" value="Asign" class="font-bold text-lg text-blue-800"/>
                      <AppImage
                        class="mt-2"
                        v-model="form.asign"
                        :image-url="imageUrl"
                        :clearImage="clearImage"
                        v-on:eventRemoveImage="handleRemoveAsign"
                        label=""
                      />
                  </div>
                  <div class="pl-2">
                        <input
                          type="checkbox"
                          :checked="asignHpv"
                          v-model="form.asign_hpv"
                          />
                        <span class="ml-2 text-bold text-lg text-blue-800">Asign Hpv</span>
                    </div>
<!--========================================================================================================================================================-->
                    <div class="mt-4 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateOr(form)">
                                Update
                              </button>
                            </span>
                    </div>
                </form>
              </div>
            </template>

        </DialogModal>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import Table from "@/Components/Table";
import Pagination from "@/Components/Pagination";

import AppImageView from "@/Components/ImageView";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import Modal from "@/Components/Modal";
import DialogModal from "@/Components/DialogModal";
import Button from "@/Jetstream/Button";
import Multiselect from "@vueform/multiselect";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import AppImage from "@/Components/Image";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({

  name: "Danh sách đơn vị gửi mẫu",
  props: {
    oureads:'',
    getOuread:'',
    errors: Object,
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    Pagination,
    EditBtn,
    DeleteBtn,
    JetButton,
    AppImage,
    Modal,
    DialogModal,
    Button,
    Multiselect,
    JetLabel,
    JetInput,
    AppImageView,

    Link


  },
data(){
  return{
    clearImage:'',
    asignUrl:'',
    asignPreview:'',
    termSearch:'',
    perPage:'',
    hasErrors:'',
   pathAsign:'/storage/image_Ouread/',
    userEdit:'',
    showModal:'',
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"2xl",
    titleHeader:'Edit',
    example4: {
        mode: "tags",
        value: "value",
        label: "name",
        //options: this.roles.data,
        searchable: true,
        createTag: true,

    },

    form: this.$inertia.form({
         // "_method": this.edit ? 'PUT' : "",
          title: "",
          name: "",
          read_code: "",
          asign: "",
          person_contact: "",
          phone: "",

      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },
  watch:{

  },
  computed: {
    checkerrors(){
      return  this.hasErrors = this.errors;
    },
    breadcrumbs() {
      return [
        {
          label: "Bác sỹ đọc mẫu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Tên đơn vị đọc mẫu (BS đọc mẫu)", class:'border-l-2 text-center' },
        { name: "Mã đọc mẫu", class:'border-l-2 text-center' },
        { name: "Mã Phụ", class:'border-l-2 text-center' },
        { name: "Phone", class:'border-l-2 text-center' },
        { name: "Asign Image", class:'border-l-2 text-center' },
        { name: "Asign HPV", class:'border-l-2 text-center' },

        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-gray-300";
      },
      bgSave(){
        return "bg-gray-600 text-white";
      },
      bgEdit(){
        return "bg-green-600 text-white";
      },
    },
  mounted() {

  },
  methods:{
    handleRemoveAsign(){
      this.clearImage=null

    },
    updateAsign() {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.asignPreview = e.target.result;
        this.form.asign =  this.$refs.asign.files[0];

      };
      reader.readAsDataURL(this.$refs.asign.files[0]);
    },
    selectAsign() {
      this.$refs.asign.click();
       this.form.asign =  this.$refs.asign.files[0];
    },
     removeAsign() {
        this.form.asign = null;
      },
      search(){
       this.$inertia.get('/dashboard/oureads?',
            {
              //alert(ousentFill);
              term:this.termSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
     getfilePerpage(){
         this.$inertia.get('oureads?',
            {  //search:this.search,
              perPage:this.perPage,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },

    closeModal(){
      this.reset();
      this.showModal=false;
      this.editMode=false;
    },
    openModal(){
      this.showModal=true;
    },
     reset() {
        this.asignPreview=null
                this.form = {
                    name: null,
                }
            },
      addOu(){

            this.showModal = true;
            },
    //  openModalEdit(user) {

    //          this.userEdit=user;
    //          console.log('roles_ididididid:',this.userEdit.name);
    //           this.showModal = true;
    //             this.editMode=true;
    //         },
      editOuRead(or) {
        this.form = Object.assign({}, or);
        this.editMode = true;

      this.showModal=true;
          },
    saveOuR(data) {
       try {
          this.$inertia.post('/dashboard/oureads',data)
          this.closeModal();
        } catch (error) {
           console.log(error);
       }
//this.closeModal();

    },
    updateOr(data){
       data._method = 'PUT';
        this.$inertia.post('/dashboard/oureads/'+data.id, data)
        this.reset();
        this.closeModal();
    }
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
