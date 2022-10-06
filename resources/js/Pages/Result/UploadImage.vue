<template>
  <app-layout title="Image list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>

      <Card>
          <div class="flex justify-between mb-2">
              <div class="bg-gray-200 border-1 border-gray-800 px-2 py-1 rounded-lg">
                <label class="mr-2 text-blue-700 font-bold">Upload Image</label>
                  <input @change="uploadImage($event)"
                    type="file"
                    name="pictureLeft"
                    id="new-file"
                    class="custom-file-input"
                    aria-label="picture"
                    multiple
                    ref="fileupload"
                    >
                <button class="bg-blue-900 cursor-pointer py-1 px-2 rounded-sm hover:bg-blue-500 hover:text-gray-900 text-white" @click="submitImage" type="button" >Submit</button>
              </div>
               <!-- <div class="bg-gray-300 border-1 border-gray-800 px-2 py-1 rounded-lg">
                <label class="mr-2 text-green-700 font-bold">Upload Image Right</label>
                  <input @change="uploadRight($event)"
                    type="file"
                    name="pictureRight"
                    id="new-file"
                    class="custom-file-input"
                    aria-label="picture"
                    multiple
                    >
                <button class="bg-blue-900 cursor-pointer py-1 px-2 rounded-sm hover:bg-green-500 hover:text-gray-900 text-white" @click="submitRight" type="button" >Submit</button>
              </div> -->
           </div>
           <hr>
    <div class="flex justify-between mt-2 my-1">
        <div class=" bg-blue-100">
              <div class=" text-right">
                <div class="flex mb-2 text-right h-8 px-2">
                            <jet-input
                              required
                              id="search"
                              type="text"
                              class="mt-1 block w-full h-8 mr-2"
                              autocomplete="search"
                               v-model="termSearch"
                               @keyup="search"
                            />
                        <span class="justify-center justify-items-center mt-2 cursor-pointer">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                          </svg>
                        </span>
                  </div>
                </div>
        </div>

          <div class="flex flex-row">
            <div>
              <div class="col-span-2  mx-2">
                <div class="flex flex-grow">
                  <div class="">
                        <span class="mr-2">BS đọc mẫu:</span>
                      </div>
                    <div class="col-span-2 w-72">
                          <select
                              name="testgroup"
                              id="testgroup"
                              class="block py-0 w-full form-input h-8 rounded-lg text-md"
                              v-model="readCode">
                              <option value="all">All</option>
                              <option value="">--</option>
                              <option v-for="(dot, i) in oureads" :key="i" :value="dot.read_code" class="text-lg">{{dot.read_code}}&nbsp ({{dot.name}})</option>
                          </select>
                    </div>
                    </div>
              </div>
            </div>
              <div class="flex flex-row">
                  <span>Từ:</span>
                      <div class="flex flex-row">
                          <jet-input
                          id="startDate"
                          type="date"
                          class="h-8 block w-full"
                          v-model="startDate"
                          autocomplete="startDate"/>
                      </div>
                </div>
              <div class="flex flex-row ml-4">
                  <span>Đến:</span>
                      <jet-input
                        id="endDate"
                        type="date"
                        class= "h-8 block w-full"
                        v-model="endDate"
                        autocomplete="endDate"/>
              </div>
              <div>
                  <button @click="getPageFill" class="px-4 ml-2 py-1 justify-auto text-white font-bold bg-blue-600 rounded-md text-sm h-8">
                  Fill
                  </button>
              </div>
              <div>
                  <button @click="refreshFill" class="px-4 ml-2 py-1 justify-auto text-blue-900 font-bold bg-yellow-400 rounded-md text-sm h-8">
                  Refresh
                  </button>
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
                          <option value="5">2</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="30">30</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                          <option value="150">150</option>
                          <option value="200">200</option>
                        </select>

                </div>
            </div>
        </div>
    </div>
        <Table :headers="headers" :addClass="addClass">
          <tr class="hover:bg-blue-300" v-for="(imageview, i) in imageviews.data" :key="i">
            <td class="border-r-2 w-16 text-center">{{i+1}}</td>
            <td class="border-r-2 text-center">{{imageview.thinprep_code}}</td>
            <td class="border-r-2 text-center font-bold">{{imageview.read_code}}</td>
            <td class="border-r-2 text-center">
              <div class="flex justify-center">
                <img
                  class="h-16 w-16 rounded-sm"
                 :src="pathThinLeft+`${imageview.thinLeft}`"
                  alt=""
                />
                <span class="rouded-md bg-red-500 h-4 w-4 ml-4 text-white cursor-pointer text-xs">X</span>
              </div>
            </td>
            <td class="border-r-2 text-center">
              <div class="flex justify-center">
                   <img
                  class="h-16 w-16 rounded-sm"
                 :src="pathThinRight+`${imageview.thinRight}`"
                  alt=""
                />
              </div>
            </td>

            <td class="text-center">{{formatDate(imageview.created_at)}}</td>
           <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOu(imageview)"
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
             :url="route('images.destroy',imageview.id )"
                  class="p-0 cursor-pointer text-red-700"
                   module-name="imageview"
                />
              </div>
            </td>
          </tr>
        </Table>

        <div class="mt-4">
          <div class="flex">
              <Pagination :links="imageviews.links"/>
          </div>
          </div>



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
import { useForm } from '@inertiajs/inertia-vue3'
import Label from "../../Jetstream/Label.vue";
import Pagination from "@/Components/Pagination";
import moment from 'moment'

export default defineComponent({

  name: "Image Thinprep",
  props: {
    imageviews:'',
    oureads:'',
    filters:'',

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
    Pagination,
    Link


  },
    Label,
//   setup() {
//         const form = useForm({
//             images:'',
//         });

//         return { form };
//     },
data(){
  return{
    perPage:this.filters.perPage,
    readCode:this.filters.readCode,
    startDate:this.filters.startDate,
    endDate:this.filters.endDate,
    termSearch:'',
    pathThinLeft:'/storage/ImageThinLeft/',
    pathThinRight:'/storage/ImageThinRight/',
    userEdit:'',
    showModal:'',
    editMode: false,
    maxWidth:"2xl",
    titleHeader:'Edit',

 form: new useForm({contract_id: 5, files: []})

    }
  },

  computed: {
    breadcrumbs() {
      return [
        {
          label: "List Image Thinprep",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" , class:"text-center"},
        { name: "Mã Thinprep", class:'border-l-2 text-center' },
        { name: "Read code", class:'border-l-2 text-center' },
        { name: "ImageLeft", class:'border-l-2 text-center' },
        { name: "ImageRigt", class:'border-l-2 text-center' },
        { name: "Date Upload", class:'border-l-2 text-center' },
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

  methods:{
     formatDate(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY (hh:mm)')}
        },
     search(){
       this.$inertia.get('/dashboard/images?',
            {
              term:this.termSearch,
            },
            {
              preserveState:true,
              replace:true            }
            )
    },
    getPageFill(){
        this.$inertia.get('/dashboard/images?',
            {
              perPage:this.perPage,
              startDate:this.startDate,
              endDate:this.endDate,
              readCode:this.readCode,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
    getfilePerpage(){
         this.$inertia.get('/dashboard/images?',
            {  //search:this.search,
              perPage:this.perPage,
              startDate:this.startDate,
              endDate:this.endDate,
              readCode:this.readCode,
            },
            {
              preserveState:true,
              replace:true            }
            )
     },
       refreshFill(){
        this.readCode='',
        this.startDate='',
        this.endDate='',
        this.$inertia.get('/dashboard/images?')
     },

    uploadImage(event) {
            for (let file of event.target.files) {
                  try {
                      let reader = new FileReader();
                      reader.readAsDataURL(file); // Not sure if this will work in this context.
                      this.form.files.push(file);
                    } catch {}
                }
            },
    submitImage(){
            this.form.post(route('imageleft'),{
                preserveScroll:true
            });
           this.$refs.fileupload.value = null;
           this.form.files="";
      },
       uploadRight(event) {
                for (let file of event.target.files) {
                    try {
                        let reader = new FileReader();
                        reader.readAsDataURL(file); // Not sure if this will work in this context.
                        this.form.files.push(file);
                    } catch {}
                }
            },
      submitRight(){
                 this.form.post(route('imagesright'),{
                preserveScroll:true
            });
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
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
