<template>
  <app-layout title="Thành phần XN">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
      <div class="grid grid-cols-1 mb-2">
        <div class="flex flex-1">
           <Button  class="mb-1 float-right cursor-pointer bg-blue-600"  @click="addTestElement">+ Add</Button>
        </div>
        <div class="grid grid-flow-col justify-items-right">

          <div class=" text-right ml-10">
             <div class="flex mb-2 text-right h-8 p-0 ">
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-1 block w-full h-8 mr-2"
                          autocomplete="name"
                          v-model="elementSearch"
                        />
                    <span class="justify-center justify-items-center mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                      </svg>
                    </span>
              </div>
            </div>
          <div class=" ml-0 text-right">
             <div class="grid grid-cols-2 mb-2 text-right h-8 p-0">
                <jet-label class="text-right text-bold text-lg pr-1" for="testgroup" value="Tên Xét nghiệm" />
                  <select
                      name="testgroup"
                      id="testgroup"
                      class="block py-0 w-42 form-input h-8 rounded-lg"
                      v-model="testName"
                    >
                      <option value="all">All</option>
                      <option
                        v-for="(tn,i) in testNames"
                        :key="i"
                        :value="tn.id"
                      >
                        {{ tn.name }}
                      </option>
                  </select>
              </div>
            </div>
          <div class="mr-32 p-0 pt-0 flex">
            <Button class="py-1 bg-indigo-600" @click="getPageFill">
             <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
              </svg>
            </span>
            </Button>
              <button @click="refreshFill" class=" px-2 py-1 text-white font-bold bg-yellow-400 rounded-md text-sm">
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
          <tr class="hover:bg-gray-300 " v-for="(el,i) in testElements.data" :key="i">
            <td class="border-r-2 text-center">{{i+1}}</td>
            <td class="border-r-2 text-center  bg-blue-300">{{el.id}}</td>
             <td class="border-r-2">{{el.name}}</td>
             <td class="border-r-2 text-center">{{el.element_group}}</td>
            <td class="border-r-2 text-center">{{el.testname.name}}</td>
            <td class="border-r-2" ></td>

            <td class="text-center border-r-2">
                <EditBtn
                  title="View"
                  class="text-green-800"
                  v-if="el.status == 1"
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
                  title="View"
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
                  @click="editTestElement(el)"
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
                  :url="route('testelements.destroy',el.id)"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="el"
                />
              </div>
            </td>
          </tr>
      </Table>
         <div class="mt-4">
          <div class="flex">
             <Pagination :links="testElements.links"/>
          </div>
          </div>-
          <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between text-bold text-xl">
                <h3 v-show="!editMode">Thêm thành phần xét nghiệm </h3>
                <h3 v-show="editMode">Chỉnh sửa thành phần xét nghiệm</h3>
                <button  @click.prevent="closeModal" class="text-white text-lg bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveTestElement(form)">
                    <div class="grid grid-cols-1">
                      <div class="mt-2">
                        <jet-label for="name" class="text-bold text-lg text-blue-800" value="Thành phần xét nghiệm xét nghiệm" />
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
                       <div class="mt-4 p-1 grid grid-rows-1 grid-flow-col border-solid border-1 border-gray-400 rounded-lg">
                    <div class=" grow h-14 text-bold text-lg text-blue-800 pt-1">Khoản tham chiếu: </div>
                    <div class=" ml-2 w-40 ">
                       <div class="mt-2">
                        <jet-label for="name" class="text-bold text-base text-gray-800" value="Max" />
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-0 block w-full h-8"
                          v-model="form.value_max"
                          autocomplete="name"
                        />
                         <div class="ml-4 text-red-800" v-if="errors.name"> * {{ errors.max }}</div>
                      </div>
                    </div>
                    <div class=" ml-2 w-40">
                       <div class="mt-2">
                        <jet-label for="name" class="text-bold text-base text-gray-800" value="Min" />
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-0 block w-full h-8"
                          v-model="form.value_min"
                          autocomplete="name"
                        />
                         <div class="ml-4 text-red-800" v-if="errors.name"> * {{ errors.min }}</div>
                      </div>
                    </div>
                  </div>
                      <div class="mt-4">
                    <jet-label for="testgroup" class="text-bold text-lg text-blue-800" value="Đơn vị tính:" />
                    <select
                      name="elementUnit"
                      id="elementUnit"
                      class="block w-full form-input rounded-lg"
                      v-model="form.unit_id"
                    >
                      <option value="">Select</option>
                      <option
                        v-for="(un,i) in testUnits"
                        :key="i"
                        :value="un.id"
                      >
                        {{ un.name }}
                      </option>
                    </select>
                  </div>

                  <div class="mt-4">
                    <jet-label for="elementgroup" class="text-bold text-lg text-blue-800 " value="Phân nhóm" />

                    <select
                      name="elementgroup"
                      id="elementgroup"
                      class="block w-full form-input rounded-lg"
                      v-model="form.element_group"
                    >
                      <option value="">None</option>
                      <option
                        v-for="(eg,i) in 200"
                        :key="i"
                        :value="i"
                      >
                        {{ i }}
                      </option>
                    </select>
                  </div>
                  <div class="mt-4">
                    <jet-label for="testgroup" class="text-bold text-lg text-blue-800 " value="Tên xét nghiệm" />

                    <select
                      name="testgroup"
                      id="testgroup"
                      class="block w-full form-input rounded-lg"
                      v-model="form.testname_id"
                    >
                      <option value="">Select</option>
                      <option
                        v-for="(tn,i) in testNames"
                        :key="i"
                        :value="tn.id"
                      >
                        {{ tn.name }}
                      </option>
                    </select>
                  </div>


                    <div class="mt-4">
                          <Checkbox :checked="checkededit" v-model="form.status"/><span class="ml-2 text-bold text-lg text-blue-800">Hiển thị</span>
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
                                v-show="editMode" @click.prevent="updateTestElement(form)">
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

  name: "Thành phần xét nghiệm",
  props: {
    testGroups:'',
    testNames:'',
    testElements:'',
    filters:{},
    testUnits:'',
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
    testGroup:this.filters.testGroup,
    testName:this.filters.testName,
    elementSearch:this.filters.elementSearch,
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
        value_max: "",
        value_min: "",
        unit_id: "",
        element_group: "",
        testname_id: "",
      },
        {
          resetOnSuccess: false,
        }
      ),
    }
  },
  watch:{
     elementSearch:function(){
       console.log(this.elementSearch);
       this.getelementSearch(this.elementSearch)
    },
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Thành phần xét nghiệm",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#", class:'w-12 text-center' },
        { name: "Id", class:'w-12 text-center' },
        { name: "Thành phần xét nghiệm", class:'border-l-2' },
        { name: "Element group", class:'border-l-2 text-center' },
        { name: "Tên xét nghiệm", class:'border-l-2 text-center px-1' },
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
    getelementSearch(data){
       this.$inertia.get('testelements?',
            {
              perPage:this.perPage,
              testName:this.testName,
              elementSearch:data
            },
            {
              preserveState:true,
              replace:true            }
            )

      },
    saveTestElement(data) {
        //this.form.post(route("testelements.store"));
         this.$inertia.post('/dashboard/testelements',data)
          this.closeModal();
    },

     getPageFill(){
        this.$inertia.get('testelements?',
            {
              perPage:this.perPage,
              testName:this.testName
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
      getfilePerpage(){
         this.$inertia.get('testelements?',
            {  //search:this.search,
                perPage:this.perPage,
                 testName:this.testName

            },
            {
              preserveState:true,
              replace:true            }

            )
     },
     refreshFill(){
        this.$inertia.get('testelements?',

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
    addTestElement(){

            this.showModal = true;
            },
      editTestElement(el) {
        var checked111=this.form = Object.assign({}, el);
        this.checkededit= checked111.status
        this.editMode = true;

     this.showModal=true;
        },

    updateTestElement(data){
       data._method = 'PUT';

        this.$inertia.post('/dashboard/testelements/'+data.id, data)
        this.reset();
        this.closeModal();
    }

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
