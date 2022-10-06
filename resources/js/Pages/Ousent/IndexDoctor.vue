<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>

      <Card>
        <div class="flex justify-between">
          <div> <Button  class="mb-1 float-right cursor-pointer px-4 py-2"  @click="addDoctor">+ Add1212212</Button></div>
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
                          <option value="all">All</option>
                        </select>

                </div>
                </div>
          </div>
        </div>
         <Table :headers="headers" :addClass="addClass">
          <tr v-for="(dtr, i) in doctors.data" :key="i" class="hover:bg-blue-300">
            <td class="border-r-2">{{dtr.id}}</td>
            <td class="border-r-2">{{dtr.name}}</td>
            <td class="border-r-2">{{dtr.title}}</td>
            <td class="border-r-2" v-if="dtr.ousent">{{dtr.ousent.name}}</td>
            <td class="border-r-2">{{dtr.phone}}</td>
            <td class="items-center text-center border-r-2 w-24">
                    <span
                      title=""
                      class="text-center"
                      v-if="dtr.status == 1">
                          <svg
                            class="w-6 h-6 text-blue-800 text-center"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                          </svg>

                    </span>
                  <span
                    v-else
                    title="Edit"
                    class="text-green-800 text-center bg-red-700">
                      <svg
                        class="w-6 h-6 text-gray-200"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                        ></path>
                      </svg>
                  </span>
              </td>
            <td class="border-r-2">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editDoctor(dtr)"
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
                  :url="route('doctors.destroy',dtr.id )"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="dtr"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
         <div class="flex">
           <Pagination :links="doctors.links"/>
         </div>
        </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode">Add Bác sỹ </h3>
                <h3 v-show="editMode">Thay đổi thông tin Bác sỹ</h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-gray-300 overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveDoctor(form)">
                    <div class="grid grid-cols-5">
                      <div class="mt-2 col-span-3">
                        <jet-label for="name" class="text-bold text-lg text-blue-800" value="Tên Bác sỹ" />
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.name"
                          autocomplete="name"
                        />
                      </div>
                        <div class="ml-2 mt-2 col-span-2">
                            <jet-label for="title" class="text-bold text-lg text-blue-800" value="Chức danh (Title)" />
                            <jet-input required
                              id="title"
                              type="text"
                              class="mt-1 block w-full"
                              v-model="form.title"
                              autocomplete="title"/>
                      </div>
                    </div>

                <div class="grid grid-cols-5 mt-4">
                      <div class="ml-1 mt-1 col-span-3">
                            <jet-label for="ousent_id" class="text-bold text-lg text-blue-800" value="Đơn vị" />
                             <select
                                name="ousent_id"
                                id="ousent_id"
                                class="block form-input rounded-lg w-full h-10 "
                                v-model="form.ousent_id">
                                <option value="--">--</option>
                                <option v-for="(ou, i) in ousents" :key="i" :value="ou.id">{{ou.name}}</option>

                                    </select>
                      </div>
                        <div class="ml-2 mt-1 col-span-2">
                        <jet-label for="phone" class="text-bold text-lg text-blue-800" value="Phone" />
                        <jet-input
                          id="phone"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.phone"
                          autocomplete="phone"
                        />
                      </div>
                </div>
                 <div class="mt-2">
                            <Checkbox  v-model="form.status"/><span class="ml-2">Hiển thị</span>

                    </div>
                <div class="mt-2 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateDoctor(form)">
                                Update
                              </button>
                            </span>
                </div>
              </form>
              </div>
            </template>
        >
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
import Checkbox from '@/Jetstream/Checkbox'
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({

  name: "Danh sách Bác sỹ chỉ định",
  props: {
    ousents:'',
    doctors:'',
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
   Checkbox,
    Link


  },
data(){
  return{
    termSearch:'',
    perPage:'',
    checkededit:true,
   pathImage:'/storage/image_Ousent/',
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
          name: "",
          title: "",
          ousent_id: "",
          phone: "",
          status:"",
      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },

  computed: {
    breadcrumbs() {
      return [
        {
          label: "DS Bác sỹ chỉ đinh XN",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Tên Bác sỹ", class:'border-l-2 text-center' },
        { name: "Chức danh", class:'border-l-2 text-center' },
        { name: "Đơn vị", class:'border-l-2 text-center' },
        { name: "Điện thoại" , class:'text-center border-l-2'},
        { name: "Status", class:'border-l-2 text-center' },

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
    if (this.edit) {
     // this.form.role_id=[1];
      // //this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      // this.form.name =' this.user.data.name';
      // this.form.username =this.user.data.username;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.imageUrl = this.user.data.profile_photo_path;
    }
  },
  methods:{
    search(){
       this.$inertia.get('/dashboard/doctors?',
            {
              term:this.termSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
     getfilePerpage(){
         this.$inertia.get('doctors?',
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
                this.form = {
                    name: null,
                    username: null,
                }
            },
    addDoctor(){

            this.showModal = true;
            },
    editDoctor(dtr) {
        this.form = Object.assign({}, dtr);
        this.editMode = true;
        this.showModal=true;
        },
    saveDoctor() {
       this.form.post(route("doctors.store"));
        this.closeModal();
    },
    updateDoctor(data){
       data._method = 'PUT';
        this.$inertia.post('/dashboard/doctors/'+data.id, data)
        this.reset();
        this.closeModal();
    }

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
