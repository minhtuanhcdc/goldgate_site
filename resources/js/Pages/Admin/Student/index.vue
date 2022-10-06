<template>
  <app-layout title="Student list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="flex justify-end mb-4">
          <JetButton  class="mb-1 float-right" >Add Student</JetButton>
              
        </div>
         <div class="flex mb-4">
       
         <div class="ml-2">
            <div>
                <label class="ml-4">FillterBy Class:</label>
                <select v-model="selectedClass" class="px-4 py-1 w-28 rounded-md border-indigo-600 ml-1">
                    <option :checked="true">All</option>
                    <option v-for="(cla,i) in classes.data" :key="i" :value="cla.id">{{cla.name}}</option>
                   
                </select>
            </div>
         </div>
         <div class="ml-2">
            <div>
                <label class="ml-4">FillterBy Section:</label>
               <select class="px-4 py-1 w-28 rounded-md border-indigo-600 ml-1">
                    <option>Section 1</option>
                    <option>Section 2</option>
                    <option>Section 3</option>
                </select>
            </div>
         </div>
         <div class="ml-2">
            <div>
               <select class="px-2 py-1 w-36 rounded-md border-indigo-600 ml-1 bg-blue-400">
                    <option class="">Checked(3)</option>
                    <option class="bg-white">Delete</option>
                    <option class="bg-white">Export</option>
                  
                </select>
            </div>
         </div>
       
        </div>
        <Table :headers="headers" :addClass="addClass">
        
          <tr v-for="(student, i) in students.data" :key="i">
           <td><input type="checkbox"/></td>
           <td>{{student.id}}</td>
           <td>{{student.name}}</td>
           <td>{{student.email}}</td>
           <td>{{student.address}}</td>
           <td>{{student.phone_number}}</td>
           <td>{{student.create_at}}</td>
           <td>{{student.class.name}}</td>
           <td>{{student.section.name}}</td>
           
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                      @click="editUser()"         
                  title="Edit"
                  class="text-green-800"
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
                
                  
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="user"
                />
              </div>
            </td>
          </tr>
        </Table>
      
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
import Table from "@/Components/TableData";
import CompSimplePage from "@/Components/SimplePage";
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
import JetNavLink from "@/Jetstream/NavLink.vue";


export default defineComponent({
  
  name: "Student",
  props: {
    students: {},
    classes:{},
    sections:{},
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    CompSimplePage,
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
    JetNavLink

   
 },
data(){
  return{
  selectedClass:'All',
   

  form: this.$inertia.form({
         // "_method": this.edit ? 'PUT' : "",
        //   name: "",
        //   username: "",
        //   status: "",
        //   email: "",
        //   //role: '',
        //   image: "",
        //   role_id: [],
        //   selected:'',
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
          label: "Student list",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: 'Select', class:"w-10 text-center" },
        { name: "#" },
        { name: "Student's Name", class:"w-38" },
        { name: "Email" },
        { name: "Address", class:"w-60" },
        { name: "Phone number" },
        { name: "Create At" },
        { name: "Class" },
        { name: "Section" },
        { name: "Action", class: "text-right" },
      ];
    },
    addClass() {
      return "bg-gray-300";
      },
      bgSave(){
        return "bg-gray-600 text-white";
      },
      bgEdit(){
        return "bg-green-500 text-white";
      },
    },
  mounted() {
    
  },
  watch:{
    selectedClass:function(value){
      this.getStudent();
    }

  },
  methods:{ 
     getStudent(page=1){  
     //alert(this.paginate);
      this.$inertia.get('student?page='
      +page
     
      +'&selectedClass='+this.selectedClass
    //  +'&selectedSection='+this.selectedSection
      );
		},
    
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
