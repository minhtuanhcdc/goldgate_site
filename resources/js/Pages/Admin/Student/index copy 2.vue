<template>
  <app-layout title="Student list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <!-- <Card>
        <div class="flex justify-end mb-4">
          <JetButton  class="mb-1 float-right"  @click="create">Select All</JetButton>
              
        </div>
        <div class="flex mb-4">
         <div>
            <div>
                <label class="ml-2">Per Page:</label>
                <select v-model="paginate" class="px-4 py-1 w-16 rounded-md border-indigo-600 ml-1">
                    <option class="" value=5>5</option>
                    <option value=10>10</option>
                    <option value=15>15</option>
                </select>
            </div>
         </div>
         <div class="ml-2">
            <div>
                <label class="ml-4"><span class="text-blue-500 font-bold">Fille by</span> Class:</label>
                <select v-model="selectedClass" class="px-4 py-1 w-28 rounded-md border-indigo-600 ml-1"
                
                >
                  <option >All class</option>
                    <option  v-for="(cl, i) in classes.data" :key="i" :value="cl.id">  {{cl.name}}</option>  
                </select>
            </div>
         </div>
         <div v-if="selectedClass" class="ml-2">
            <div>
                <label class="ml-4">Section:</label>
               <select v-model="selectedSection" class="px-4 py-1 w-32 rounded-md border-indigo-600 ml-1">
                    <option>All section</option>
                    <option  v-for="(section,i) in sections.data" :key="i" :value="section.id">{{section.name}}</option>
                   
                </select>
            </div>
         </div>
         <div class="ml-2">
            <div>
               <Dropdown>
                 <template v-slot:trigger >
                   <button class="bg-green-400 px-2 py-1 rounded-md border-indigo-600">With Select({{checked.length}})</button>
                  </template>
                 <template v-slot:content >
                  <ul class="bg-green-200 text-green-800">
                   
                    <li class="hover:bg-gray-300 cursor-pointer px-2 py-1" @click.prevent="deleteRecords">Delete</li>
                   
                    <li class="hover:bg-gray-300 cursor-pointer px-2 py-1" @click.prevent="exportRecords">Export</li>
                   
                  </ul>
                 
                  </template>
              </Dropdown>
            </div>
         </div>
         <div class="ml-6">
            <div>
               <label>Search: </label>
              
               <input v-model.lazy="search" type="search" placeholder="name, email, phone..." class="px-4 py-1 w-60 rounded-md border-indigo-600 mr-0"/>
            
            </div>
         </div>
       
              
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr><td colspan="3">Check All <input type="checkbox" v-model="checkedAll"/></td></tr>
          <tr v-for="(student, i) in students.data" :key="i">
           <td class="text-center"><input type="checkbox" v-model="checked" :value="student.id"/></td>
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
                :url="route('destroystudent', { student: student.id })"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="student"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="">
            <div class="flex justify-center">
              <template v-for="(link, key) in students.meta.links" :key="key">
                  <jet-nav-link @click="getStudent(link.label)">
                      <b v-if="link.active === false" v-html="link.label" class="mb-1 mr-1 px-4 py-3 text-gray-800 text-sm leading-4 border rounded"></b>
                      <b v-else v-html="link.label" class="mb-1 mr-1 px-4 py-3 text-white text-bold text-sm leading-4 border rounded bg-blue-500"></b>
                  </jet-nav-link>
              </template>
            </div>
        </div>  
     
      </Card> -->
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
import Dropdown from "@/Jetstream/Dropdown";

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
    tags:{},
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
    Dropdown,
  
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
   search:'',
   paginate:2,
   page:2,
  title:'hello world',
   selectedClass:'All class',
   selectedSection:'',
   checked:[],
   checkedAll:false,
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
        { name: 'Check All <input v-model="selectedAll" type="checkbox" class="bg-blue-400"/>', class:"w-18 text-center" },
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
  watch: {
     paginate: function(value){
       this.getStudent();
     },
     search: function(value){
       this.getStudent();
     },
     selectedClass: function(value){
       this.getStudent();
     },
     selectedSection: function(value){
       this.getStudent();
     },
     checkedAll: function(value){
       if(value){
         this.students.data.forEach(student =>{
           this.checked.push(student.id);
         });
       }else{
         this.checked=[];
       }
     }
  },
  beforeUpdate() {
    
    //this.getStudent();
    //this.getClasses();
      
  },
  methods:{ 
    beforeCreate(){
      console.log('beforeCreate', this.title);
    },
    create(){
      console.log('Create',this.title);
    },
    beforeMount(){
      console.log('beforeMount',this.title);
    },
    mounted(){
      console.log('mounted',this.title);
    },
    beforeDestroy(){
      console.log('beforeDestroy',this.title);
    },
    destroyed(){
      console.log('destroyed',this.title);
    },




    deleteRecords(){
        if(this.checked.length>0)
        {
            this.$inertia.delete('massdetroy/'+this.checked);
        }else {
          alert('Chon record');
      }
    
      
    },
    exportRecords(){
      alert('Export Record!');
    },
    getStudent($label){  
      this.$inertia.get('student?page='
      +$label
      +'&paginate='+this.paginate
      +'&q='+this.search
      +'&selectedClass='+this.selectedClass
      +'&selectedSection='+this.selectedSection
      );
		},
    
  },
  mounted(){
   //this.getStudent();
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
