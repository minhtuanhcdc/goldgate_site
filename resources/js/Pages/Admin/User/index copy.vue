<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="">
          <JetButton  class="mb-1 float-right" @click="openModalAdd" >Add User</JetButton>
          <!-- <JetButton :href="route('users.create')" class="mb-1 justify-self-end"
           v-show="$page.props.user.can.create" >Add User</JetButton> -->
           
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr v-for="(user, i) in users.data" :key="i">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>
                <AppImageView
                  class="mt-2"  
                  :image-url="`${user.profile_photo_path}`"
                  label="Image"
                />
            </td>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>
               <span v-for="(role,i) in user.permissionroles" :key="i" class="ml-2 bg-blue-500 px-1 rounded-lg text-white">
                  {{role.name}}  
              </span>
            
            </td>
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                      @click="editUser(user)"         
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
                <!-- <EditBtn
                  :href="route('menupermision.edit',`${user.id }`)"
               
                  title="Cấp quyền Menu"
                  class="text-green-800"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"
                    />
                  </svg>
                </EditBtn> -->

               
                <!-- <EditBtn  v-show="$page.props.user.can.update" :href="route('users.edit', { user: user.id })" title="Edit"> 
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
                    ></path></svg
                ></EditBtn> -->
                <DeleteBtn
                 v-show="$page.props.user.can.delete"
                  :url="route('users.destroy', { user: user.id })"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="user"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <!-- <CompSimplePage :prevUrl="users.links.prev" :nextUrl="users.links.next" /> -->
        </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700">
         
             <template v-slot:title>
               <div class="flex justify-between">
                <h3 class="text-white font-bold">{{titleHeader}}</h3>
                <button  @click="closeModal" class="text-white bg-yellow-500 px-4 py-1 rounded-md hover:bg-yellow-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg" 
                     @submit.prevent="saveUser(form)"
                  >
                  +
                    <div class="grid grid-cols-2">
                      <div class="mt-4">
                        <jet-label for="name" value="Name" />
                        <jet-input
                          id="name"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.name"
                          autocomplete="title"
                        />
                          
                      </div>

                      <div class="ml-4 mt-4">
                            <jet-label for="username" value="Uer Name" />
                            <jet-input
                              id="username"
                              type="text"
                              class="mt-1 block w-full"
                              v-model="form.username"
                              autocomplete="username"
                            />
                            
                      </div>
                    </div>
                       
                    <div class="mt-4 grid grid-cols-1">
                      <div class="mt-1 w-full rounded-sm">
                        <jet-label
                            for="role_id"
                            value="Choose Role"
                            class="w-full block rounded-sm"
                        />
                        <Multiselect
                            v-model="form.role_id"
                            v-bind="example4"
                            selected
                        ></Multiselect>
                       
                      </div>
                    </div>
          
                    <div class="mt-4 grid grid-cols-2">
                      <div class="mt-2">
                        <jet-label for="email" value="Email" />
                        <jet-input
                          id="email"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.email"
                          autocomplete="email"
                        />
                      </div>
                      <div class="ml-4 mt-2">
                        <jet-label for="phone" value="Phone" />
                        <jet-input
                          id="phone"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.phone"
                          autocomplete="phone"
                        />
                      
                      </div>
                    </div>
                    <div class="mt-4">
                      <AppImage
                        class="mt-2"
                        v-model="form.image"
                        :image-url="imageUrl"
                        label="Image"
                      />
                    </div> 
           <!--Action-->
                    <div class="mt-4 text-center mb-1" >
                       <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        v-show="!editMode"
                      >
                        Save
                      </jet-button>   
                        <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        v-show="editMode"
                      >
                        Update
                      </jet-button> 
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



export default defineComponent({
  
  name: "Users",
  props: {
    edit: Boolean,
    users: {},
    roles: {},
    roleOfUser: [1],
  
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
    AppImageView
  },
data(){
  return{
    userEdit:'',
    showModal:'',
    editMode: false,
    //titleModal:'Them user',
    maxWidth:"2xl",
    titleHeader:'Edit user',
    example4: {
        mode: "tags",
        value: "value",
        label: "name",
        options: this.roles.data,
        searchable: true,
        createTag: true,
    },

    form: this.$inertia.form({
         // "_method": this.edit ? 'PUT' : "",
          name: "",
          username: "",
          status: "",
          email: "",
          //role: '',
          image: "",
          role_id: [],
          selected:'',
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
          label: "User",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Name" },
        { name: "Image" },
        { name: "Username" },
        { name: "Email" },
        { name: "Phone" },
        { name: "Roles" },
        { name: "Action", class: "text-right" },
      ];
    },
    addClass() {
      return "bg-gray-300";
      },
    },
  mounted() {
    if (this.edit) {
    
      this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      this.form.name = this.user.data.name;
      this.form.username =this.user.data.username;
      this.form.email = this.user.data.email;
      this.form.phone = this.user.data.phone;
      this.imageUrl = this.user.data.profile_photo_path;
    }
  },
  methods:{
    closeModal(){
      this.showModal=false;
      this.editMode=false;
    },
    openModal(){
      this.showModal=true;
    },
     reset() {
                this.form = {
                    name: null,
                    icon: null,
                }
            },
      openModalAdd(){
              this.openModal();
            },
     openModalEdit(user) {
             this.userEdit=user;
             //console.log(this.userEdit.id);
              this.showModal = true;
            },
      editUser(user) {
              //alert(user.id);  
        this.form = Object.assign({}, user);
        this.editMode = true;
       this.openModalEdit(user);
        },
      saveUser(data) {
        //alert(123);
         let obj = {
                   //roles:this.selected,
                   //user_id:user_id,
                 }
                this.$inertia.post('/dashboard/users',data)
                this.reset();
                this.closeModal();
                this.showModal=false;
                this.editMode = false;
    },
    updateUser(data){
      alert(data.id);
       data._method = 'PATCH';
        this.$inertia.post('/dashboard/users' + data.id, data)
        this.reset();
            this.closeModal();
    }
    
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
