<template>
  <app-layout title="Đơn vị tính">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <!---
       :src="pathImage+`${ou.logo}`"
       src="/storage/image_Ousent/202205161136.jpg"
      --->
      <Card>
           <Button  class="mb-1 float-right cursor-pointer"  @click="addTestUnit">+ Add</Button>
        <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-blue-300" v-for="(tu,i) in testUnits.data" :key="i">
            <td class="border-r-2 text-center">{{i}}</td>
            <td class="border-r-2">{{tu.name}}</td>
            <td class="text-center border-r-2 w-24">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                 v-if="tu.status == 1"
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
                  class="text-green-800"

                  >
              <svg

                class="w-6 h-6 text-gray-200"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
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
                  @click="editTestUnit(tu)"
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
                  :url="route('testunits.destroy',tu.id)"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="gr"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
         <div class="flex">
            <template v-for="(link, i) in testUnits.links" :key="i" >
             <div v-if="link.url === null" v-html="link.label" class="mb-1 mr-1 px-3 py-2 text-gray-400 text-sm leading-4 border rounded"></div>
             <Link v-else :href="link.url" v-html="link.label" class="mb-1 mr-1 px-3 py-2 text-gray-400 text-sm leading-4 border rounded
             focus:text-indigo-500 focus:border-indigo-500
             hover:bg-red-400"
             :class="{'bg-blue-500 text-white' : link.active}"
             />
           </template>
         </div>
        </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode">Thêm đơn vị tính xét nghiệm </h3>
                <h3 v-show="editMode">Chỉnh sửa đơn vị tính xét nghiệm</h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveTestUnit(form)">
                    <div class="grid grid-cols-1">
                      <div class="mt-2">
                        <jet-label for="name" class="text-bold text-lg" value="Đơn vị tính xét nghiệm" />
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
                                v-show="editMode" @click.prevent="updateTestUnit(form)">
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

  name: "Danh sách đơn vị tính",
  props: {
    testUnits:'',
     errors: Object,
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
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
          label: "Danh sách đơn vị tính",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#", class:'w-12 text-center' },
        { name: "Đơn vị tính(Unit)", class:'border-l-2' },
        { name: "Trạng thái", class:'border-l-2 text-center' },
        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-blue-300";
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
      addTestUnit(){

            this.showModal = true;
            },
    //  openModalEdit(user) {

    //          this.userEdit=user;
    //          console.log('roles_ididididid:',this.userEdit.name);
    //           this.showModal = true;
    //             this.editMode=true;
    //         },
      editTestUnit(tu) {
        var checked111=this.form = Object.assign({}, tu);
        this.checkededit= checked111.status
        this.editMode = true;

     this.showModal=true;
        },
      saveTestUnit(data) {
          this.$inertia.post('/dashboard/testunits',data)
          this.closeModal();
    },
    updateTestUnit(data){
       data._method = 'PUT';
        this.$inertia.post('/dashboard/testunits/'+data.id, data)
        this.reset();
        this.closeModal();
    }

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
