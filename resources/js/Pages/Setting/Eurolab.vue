<template>
  <app-layout title="Eurolab">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <Card>
        <div class="flex justify-between">



           <Button  class="mb-1 float-right cursor-pointer"  @click="addOu">+ Add</Button>
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr v-for="(eu, i) in eurolab" :key="i" class="hover:bg-blue-300">

            <td class="border-r-2">{{eu.name}}</td>
            <td class="border-r-2">{{eu.addressSG}}</td>
            <td class="border-r-2">{{eu.phoneSG}}</td>
            <td class="border-r-2">{{eu.addressHN}}</td>
            <td class="border-r-2">{{eu.phoneHN}}</td>
            <td class="border-r-2">{{eu.website}}</td>

            <td class="border-r-2"><img class="w-24" :src="pathImage + eu.logo"/></td>
            <td class="border-r-2"><img class="w-24" :src="pathImage + eu.background_thin"/></td>


           <td class="border-r-2"><img class="w-24" :src="pathImage + eu.background_hpv"/></td>

            <td class="border-r-2">{{eu.doctor_asign_hpv}}</td>
            <td class="border-r-2">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOuRead(eu)"
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

              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">

        </div>
      <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">
             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode">Thêm đơn vị đọc mẫu </h3>
                <h3 v-show="editMode">Thay đổi thông tin </h3>
                <button  @click.prevent="closeModal" class="text-white bg-green-500 px-4 py-1 rounded-md hover:bg-green-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveOuR(form)">

                      <div class="mt-2">
                        <jet-label for="title" value="Name" />
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
                      <div class="mt-2">
                        <jet-label for="addressSG" value="Địa chỉ SG" />
                        <jet-input
                        required
                          id="addressSG"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.addressSG"
                          autocomplete="addressSG"
                        />
                         <div class="ml-4 text-red-800" v-if="errors.addressSG"> * {{ errors.addressSG }}</div>
                      </div>
                       <div class="ml-1 mt-2">
                            <jet-label for="phoneSG" value="Phone SG" />
                            <jet-input
                              id="phoneSG"
                              type="text"
                              class="block w-3/4"
                              v-model="form.phoneSG"
                              autocomplete="phoneSG"
                            />
                      </div>
                      <div class="mt-2">
                        <jet-label for="addressHN" value="Địa chỉ Hà Nội" />
                        <jet-input
                        required
                          id="addressHN"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.addressHN"
                          autocomplete="addressHN"
                        />
                         <div class="ml-4 text-red-800" v-if="errors.addressHN"> * {{ errors.addressHN }}</div>
                      </div>
                       <div class="ml-1 mt-2">
                            <jet-label for="phone" value="Phone HN" />
                            <jet-input
                              id="phone"
                              type="text"
                              class="block w-3/4"
                              v-model="form.phoneHN"
                              autocomplete="phone"
                            />
                      </div>

                    <div class="grid grid-cols-2">
                       <div class="">
                              <AppImage
                                class="mt-2"
                                 :addClassImage="addClassImage"
                                v-model="form.logo"
                                :image-url="logoUrl"
                                label="Logo"
                              />
                      </div>
                      <div class="ml-1 mt-2">
                            <jet-label for="read_code" value="Website" />
                            <jet-input
                              id="website"
                              type="text"
                              class="block w-full"
                              v-model="form.website"
                              autocomplete="website"
                            />
                           <div class="ml-4 text-red-800" v-if="errors.website"> * {{ errors.website}}</div>

                      </div>
                    </div>
                <div class="grid grid-cols-2">
                     <div class="ml-1 mt-4">
                              <AppImage
                                class="mt-2"
                                :addClassImage="addClassImage"
                                v-model="form.background_hpv"
                                :image-url="background_hpv"
                                label="Background HPV"
                              />
                      </div>
                     <div class="ml-1 mt-4">
                              <AppImage
                                class="mt-2"
                                :addClassImage="addClassImage"
                                v-model="form.background_thin"
                                label="Background Thinprep"
                              />
                      </div>
                </div>
                 <div class="ml-1 mt-2">
                            <jet-label for="phone" value="BS ký kết quả Aptima (HPV)" />
                            <jet-input
                              id="doctor_sign"
                              type="text"
                              class="block w-full"
                              v-model="form.doctor_asign_hpv"
                              autocomplete="doctor_sign"
                            />
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
  name: "Eurolab",
  props: {
    eurolab:'',
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
    termSearch:'',
    perPage:'',
    hasErrors:'',
   logoUrl:'/images/Logo/eurolab.png',
   pathImage:'/storage/Image_Eurolab/',
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
          logo: "",
          background_hpv: "",
          //logo: "",
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
    addClassImage(){
      return "w-32"
    },
    checkerrors(){
      return  this.hasErrors = this.errors;
    },

    breadcrumbs() {
      return [
        {
          label: "Eurolab Info",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "Name" },
        { name: "Address Sài gòn", class:'border-l-2 text-center' },
         { name: "phone SG", class:'border-l-2 text-center' },
        { name: "Address Hà Nội", class:'border-l-2 text-center' },
        { name: "phone HN", class:'border-l-2 text-center' },
        { name: "Website", class:'border-l-2 text-center' },
        { name: "Logo", class:'border-l-2 text-center' },
        { name: "Background Thin", class:'border-l-2 text-center' },

        { name: "Background HPV", class:'border-l-2 text-center' },

        { name: "Bác sỹ ký KQ HPV", class:'border-l-2 text-center' },

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

          this.$inertia.post('/dashboard/eurolab',data)
           console.log('Heeheheeheheeheeeheheeheh:',this.errors);

        } catch (error) {
           console.log(error);
       }
//this.closeModal();

    },
    updateOr(data){

       data._method = 'PUT';
        this.$inertia.post('/dashboard/eurolab/'+data.id, data)
        this.reset();
        this.closeModal();
    }

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
