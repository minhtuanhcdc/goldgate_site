<template>
  <app-layout title="Tên XN">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <Card>
      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1">
           <Button  class="mb-1 float-right cursor-pointer bg-blue-600"  @click="addTestName">+ Add</Button>
        </div>
        <div class="grid grid-flow-col justify-items-right">
          <div class=" text-right"></div>
          <div class=" text-right"></div>
          <div class=" px-2 mr-0 text-right">
             <div class="grid grid-cols-2 mb-2 text-right h-8 p-0">
                    <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="Nhóm xét nghiệm:" />
                    <select
                      name="testgroup"
                      id="testgroup"
                      class="block py-0 w-full form-input h-8 rounded-lg"
                      v-model="groupName"
                    >
                      <option value="all">All</option>
                      <option
                        v-for="(tg,i) in testGroups"
                        :key="i"
                        :value="tg.id"
                      >
                        {{ tg.name }}
                      </option>
                    </select>
                  </div>
            </div>
          <div class="p-0 pt-0 flex">
            <Button class="py-1 bg-indigo-600" @click="fileGroup">
             <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
              </svg>
            </span>
            </Button>
              <button @click="refreshFill" class=" px-2 py-1 text-white font-bold bg-blue-400 rounded-md text-sm">
                Refresh
              </button>
          </div>
          <div class="p-0 text-right rounded-sm">
            <div class="flex flex-row justify-end">
                    <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="perPage:" />
                    <select
                      name="perPage"
                      id="perPage"
                      class="block py-0 w-24 form-input h-8 rounded-lg"
                      v-model="perPage"
                      @change="getPageFill"
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
          <tr class="hover:bg-gray-300 " v-for="(te,i) in testNames.data" :key="i">
            <td class="border-r-2 text-center">{{i}}</td>
            <td class="border-r-2">{{te.name}}</td>
            <td class="border-r-2">{{te.get_group.name}}</td>
            <td class="text-center border-r-2 w-24">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  v-if="te.status == 1"
                  >
                 <svg
                  class="w-6 h-6 text-blue-800"
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
                </EditBtn>
               <EditBtn
               v-else
                  title="Edit"
                  class="text-green-800">
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
              </EditBtn>
            </td>
            <td class="border-r-2 w-32">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editTestName(te)"
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
                  :url="route('testnames.destroy',te.id)"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="gr"
                />
              </div>
            </td>
          </tr>
        </Table>
         <div class="mt-4">
          <div class="flex">
            <Pagination :links="testNames.links"/>
          </div>
          </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode">Thêm tên xét nghiệm </h3>
                <h3 v-show="editMode">Chỉnh sửa tên xét nghiệm</h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveTestName(form)">
                    <div class="grid grid-cols-1">
                      <div class="mt-2">
                        <jet-label for="name" class="text-bold text-lg" value="Tên xét nghiệm" />
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
                  <div class="mt-4">
                    <jet-label for="testgroup" value="Nhóm xét nghiệm" />

                    <select
                      name="testgroup"
                      id="testgroup"
                      class="block w-full form-input"
                      v-model="form.group_id"
                    >
                      <option value="">Select</option>
                      <option
                        v-for="(tg,i) in testGroups"
                        :key="i"
                        :value="tg.id"
                      >
                        {{ tg.name }}
                      </option>
                    </select>
                  </div>
                    <div class="mt-4">
                          <Checkbox :checked="checkededit" v-model="form.status"/><span class="ml-2">Hiển thị</span>
                    </div>
                    </div>
                    <div class="mt-4 text-center mb-1" >
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-20 rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateTestName(form)">
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
import { Link } from "@inertiajs/inertia-vue3";
 import Checkbox from '@/Jetstream/Checkbox'

export default defineComponent({

  name: "Tên xét nghiệm",
  props: {
    testNames:'',
    testGroups:'',
     filters:{},
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
    Link,
    Checkbox
  },
data(){
  return{
    groupName:this.filters.groupName,
    perPage:'',

     checkededit:'',
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
          status: "",

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
          label: "Tên xét nghiệm",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#", class:'w-12 text-center' },
        { name: "Tên xét nghiệm", class:'border-l-2' },
        { name: "Nhóm xét nghiệm", class:'border-l-2' },
        { name: "Trạng thái", class:'border-l-2 text-center' },
        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-blue-200 text-indigo-700";
      },
      bgSave(){
        return "bg-blue-900 text-white";
      },
      bgEdit(){
        return "bg-green-600 text-white";
      },
    },
  mounted() {
    if (this.edit) {

       //this.checkededit=this.labogroups.data.status==1? true:false;
      //this.form.role_id=[1];
      // //this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      // this.form.name =' this.user.data.name';
      // this.form.username =this.user.data.username;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.imageUrl = this.user.data.profile_photo_path;
    }
  },
  methods:{
     getPageFill(){
        this.$inertia.get('testnames?',
            {
              perPage:this.perPage,
              groupName:this.groupName
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
     fileGroup(){
         this.$inertia.get('testnames?',
            {  //search:this.search,
                perPage:this.perPage,
                groupName:this.groupName,

            },
            {
              preserveState:true,
              replace:true            }

            )
     },
     refreshFill(){
        this.$inertia.get('testnames?',

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
                    status: null,
                }
            },
      addTestName(){

            this.showModal = true;
            },
    //  openModalEdit(user) {

    //          this.userEdit=user;
    //          console.log('roles_ididididid:',this.userEdit.name);
    //           this.showModal = true;
    //             this.editMode=true;
    //         },
      editTestName(te) {
        var checked111=this.form = Object.assign({}, te);
        this.checkededit= checked111.status
        this.editMode = true;

     this.showModal=true;
        },
      saveTestName(data) {
          this.$inertia.post('/dashboard/testnames',data)
          this.closeModal();
    },
    updateTestName(data){
       data._method = 'PUT';
        this.$inertia.post('/dashboard/testnames/'+data.id, data)
        this.reset();
        this.closeModal();
    }

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
