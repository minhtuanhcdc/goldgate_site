<template>
  <app-layout title="Image list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>

      <Card>
          <div class="flex justify-between mb-2">
              <div class="bg-green-700 border-1 border-gray-800 px-2 py-1 rounded-lg">
                 <div>
                      <form @submit.prevent="submitProvince">
                        <div class="flex flex-row">
                            <div class=" p-0 w-56">
                              <input type="file"
                                class=" px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                @change="previewImage" ref="province"/>
                            </div>
                            <div class="flex items-center mt-0">
                              <button class="px-2 py-1 text-white bg-gray-900  rounded">Import Tỉnh/ Thành</button>
                            </div>
                        </div>
                      </form>
                  </div>
              </div>
              <div class="bg-blue-600 border-1 border-gray-800 px-2 py-1 rounded-lg">
               <div>
                      <form @submit.prevent="submitDistrict">
                        <div class="flex flex-row">
                            <div class=" p-0 w-56">
                              <input type="file"
                                class=" px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                ref="district"/>
                            </div>
                            <div class="flex items-center mt-0">
                              <button class="px-2 py-1 text-white bg-gray-900  rounded">Import Quận/ Huyện</button>
                            </div>
                        </div>
                      </form>
                  </div>
              </div>
              <div class="bg-yellow-400 border-1 border-gray-800 px-2 py-1 rounded-lg">
              <div>
                      <form @submit.prevent="submitWard">
                        <div class="flex flex-row">
                            <div class=" p-0 w-56">
                              <input type="file"
                                class=" px-2 py-0 mt-0 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                ref="ward"/>
                            </div>
                            <div class="flex items-center mt-0">
                              <button class="px-2 py-1 text-white bg-gray-900  rounded">Import Phường/ Xã</button>
                            </div>
                        </div>
                      </form>
                  </div>
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
     form: this.$inertia.form({
          file: '',
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
     submitProvince() {
            if (this.$refs.province) {
                this.form.file = this.$refs.province.files[0];
            }
            //this.form.post('/dashboard/importcustommers/');
            this.form.post(route('importProvince'));
            this.$refs.province=null;
            this.form.file = ""
        },
     submitDistrict() {
            if (this.$refs.district) {
                this.form.file = this.$refs.district.files[0];
            }
            //this.form.post('/dashboard/importcustommers/');
            this.form.post(route('importDistrict'));
            this.$refs.district=null;
            this.form.file = ""
        },
     submitWard() {

            if (this.$refs.ward) {
                this.form.file = this.$refs.ward.files[0];
            }
            //this.form.post('/dashboard/importcustommers/');
            this.form.post(route('importWard'));
            this.$refs.ward=null;
            this.form.file = ""
        },
     formatDate(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY (hh:mm)')}
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
    uploadDistrict(event) {
            for (let file of event.target.files) {
                  try {
                      let reader = new FileReader();
                      reader.readAsDataURL(file); // Not sure if this will work in this context.
                      this.form.files.push(file);
                    } catch {}
                }
            },
    submitDistrict(){
            this.form.post(route('district'),{
                preserveScroll:true
            });
           this.$refs.district.value = null;
           this.form.files="";
      },

  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
