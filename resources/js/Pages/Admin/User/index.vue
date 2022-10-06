<template>
  <app-layout title="User list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />

    </template>
    <Container>
      <Card>
           <!-- <Button v-show="$page.props.can.create"  class="mb-1 float-right cursor-pointer"  @click="addUser">Add User</Button> -->
           <Button   class="mb-1 float-right cursor-pointer"  @click="addUser">Add User</Button>
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
                   <!-- <EditBtn :href="route('users.edit', { user: user.id })" title="Edit">Edit </EditBtn> -->
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
                <DeleteBtn

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
         <CompSimplePage :prevUrl="users.links.prev" :nextUrl="users.links.next" />
        </div>
        <DialogModal :show="showModal" class="mb-0 pb-0 bg-green-700" :bgHeader="editMode ? bgEdit : bgSave">

             <template v-slot:title >
               <div class="flex justify-between">
                <h3 v-show="!editMode">Add user</h3>
                <h3 v-show="editMode">Edit user</h3>
                <button  @click.prevent="closeModal" class="text-white bg-yellow-500 px-4 py-1 rounded-md hover:bg-yellow-300">Close</button>
               </div>
            </template>
             <template v-slot:content>
               <div class="px-4 pb-0">
                   <form
                    class="py-1 px-6 sm:p-1 sm:px-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
                    @submit.prevent="saveUser(form)">
                   <div>
                     <span v-show="!editMode">+</span>
                     <p v-show="editMode" class="text-red-600" > Cập nhật cho user: <span class="font-bold">{{form.name}}</span></p>
                     <span class="ml-4 mr-2">Quyền đã chọn: </span><span v-for="(f,i) in form.permissionroles" :key="i"><span class="text-blue-900 font-bold">{{f.name}}; </span> </span>
                     </div>
                    <div class="grid grid-cols-2">
                      <div class="mt-4">
                        <jet-label for="name" value="Name" />
                        <jet-input
                          required
                          id="name"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.name"
                          autocomplete="title"
                        />
                            <div class="ml-4 text-red-800" v-if="errors.name"> * {{ errors.name }}</div>
                      </div>

                      <div class="ml-4 mt-4">
                            <jet-label for="username" value="Uer Name" />
                            <jet-input required
                              id="username"
                              type="text"
                              class="mt-1 block w-full"
                              v-model="form.username"
                              autocomplete="username"
                            />
                            <div class="ml-4 text-red-800" v-if="errors.username"> * {{ errors.username }}</div>

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
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                             <button v-show="!editMode"  type="submit" class="bg-blue-900 text-white inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2  leading-6 font-medium  shadow-sm hover:bg-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                Save
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button"
                               class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                v-show="editMode" @click.prevent="updateUser(form)">
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

  name: "Users List",
  props: {
    //role_id:[1],
    edit: Boolean,
    users: {},
    roles: {},
    roleOfUser: '',
     errors: Object,

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
          name: "123",
          username: "",
          status: "",
          email: "",
          //role: '',
          image: "",
          role_id: [1,2],
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
          label: "User List",
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
      bgSave(){
        return "bg-gray-600 text-white";
      },
      bgEdit(){
        return "bg-green-500 text-white";
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
      addUser(){

            this.showModal = true;
            },
    //  openModalEdit(user) {

    //          this.userEdit=user;
    //          console.log('roles_ididididid:',this.userEdit.name);
    //           this.showModal = true;
    //             this.editMode=true;
    //         },
      editUser(user) {
        this.form = Object.assign({}, user);

        //const rolesuser = this.form.permissionroles;
         var rolesuser = this.form.permissionroles.map(function(a) {return a.id;});
        //console.log('Tesst view Edđiiiiiiiiiiit',rolesuser);
         this.form.role_id=rolesuser;
        this.editMode = true;
        this.showModal=true;
        },
      saveUser(data) {
        //alert('Save');
        //  let obj = {
        //            //roles:this.selected,
        //            //user_id:user_id,
        //          }
                this.$inertia.post('/dashboard/users',data)
                this.closeModal();
    },
    updateUser(data){
      console.log('hehehe',data.phon);
       data._method = 'PUT';
        this.$inertia.post('/dashboard/users/'+data.id, data);
        this.reset();
        this.closeModal();
    }
  }
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
