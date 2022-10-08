<template>
  <app-layout title="Đơn vị gửi mẫu">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card :AddClassCard="AddClassCard">
        <div class="flex justify-between">
          <div>
            <Button
              class="mb-1 float-right cursor-pointer px-4 py-2"
              @click="addOu"
              >+ Add</Button
            >
          </div>
          <div class="py-2 ml-8 px-3">
            <a
              :href="route('ousentexport')"
              class="
                flex
                justify-center
                bg-green-600
                text-white
                w-32
                rounded-md
                text-center
                py-2
                px-2
                hover:bg-green-400
              "
            >
              <svg
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                />
              </svg>
              <span class="w-full p-0">Export Excel </span>
            </a>
          </div>
          <div class="flex justify-between mt-2">
            <div class="bg-blue-100">
              <div class="text-right">
                <div class="flex mb-2 text-right h-8 px-2 w-full">
                  <jet-input
                    placeholder="..."
                    id="search"
                    type="text"
                    class="mt-1 block w-full h-8 mr-2"
                    autocomplete="search"
                    v-model="termSearch"
                    @keyup="search"
                  />
                  <span
                    class="
                      justify-center justify-items-center
                      mt-2
                      cursor-pointer
                    "
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                      />
                    </svg>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="">
            <div class="p-0 text-right rounded-sm">
              <div class="flex flex-row justify-end">
                <jet-label
                  class="text-right text-bold text-lg pr-1"
                  for="testgroup"
                  value="perPage:"
                />
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
                </select>
              </div>
            </div>
          </div>
        </div>
        <Table :headers="headers" :addClass="addClass" :tableClass="tableClass">
          <tr
            v-for="(ou, i) in ousents.data"
            :key="i"
            class="hover:bg-blue-300 align-middle"
          >
            <td class="border-r-2 py-1 text-center">{{ ou.id }}</td>
            <td class="border-r-2 py-1 text-center" width="15%">{{ ou.name }}</td>
            <td class="border-r-2 py-1 text-center" width="15%">{{ ou.title }}</td>
            <td class="border-r-2 py-1 text-center" width="15%">{{ ou.address }}</td>
            <td class="border-r-2 text-center font-bold" width="5%">
              {{ ou.form_group }}
            </td>
            <td class="border-r-2 py-1 text-center">{{ ou.phone_contact }}</td>
            <td class="border-r-2 py-1 text-center">{{ ou.person_contact }}</td>
            <td class="border-r-2">{{ ou.phone }}</td>
            <td class="border-r-2 py-1 text-center">
              <span v-if="ou.asign_view" class="text-blue-900 font-bold">V</span>
              <span v-else></span>
            </td>
            <td class="border-r-2 py-1 text-center w-56">
              <div class="flex w-full" v-if="ou.logo">
                <span>
                  <img
                    class="w-full rounded-full"
                    :src="pathImage + `${ou.logo}`"
                  />
                </span>
                <DeleteX
                  :url="route('deletelogo', ou.id)"
                  class="w-4 p-0 cursor-pointer text-red-700"
                  :moduleName="'Logo ' + `${ou.name}`"
                />
              </div>
              <div v-else></div>
            </td>
            <td class="border-r-2 py-1 w-72">
              <div class="flex" v-if="ou.image_header">
                <span class="border-1 border-gray-700">
                  <img
                    class="w-full"
                    :src="pathHeader + `${ou.image_header}`"
                  />
                </span>
                <DeleteX
                  :url="route('deleteheader', ou.id)"
                  class="w-4 p-0 cursor-pointer text-red-700"
                  :moduleName="'Header Image ' + `${ou.name}`"
                />
              </div>
              <div v-else></div>
            </td>
            <td class="border-r-2 py-1 w-72">
              <div class="flex" v-if="ou.image_footer">
                <span class="border-1 border-gray-700">
                  <img
                    class="w-full"
                    :src="pathFooter + `${ou.image_footer}`"
                  />
                </span>
                <DeleteX
                  :url="route('deletefooter', ou.id)"
                  class="w-4 p-0 cursor-pointer text-red-700"
                  :moduleName="'Header Image ' + `${ou.name}`"
                />
              </div>

              <div v-else></div>
            </td>
            <td class="border-r-2 py-1">{{ ou.website }}</td>
            <td class="border-r-2 py-1">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn
                  title="Edit"
                  class="text-green-800"
                  @click="editOu(ou)"
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
                    ></path>
                  </svg>
                </EditBtn>
                <DeleteBtn
                  :url="route('ousents.destroy', ou.id)"
                  class="p-0 cursor-pointer text-red-700"
                  module-name="ou"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <div class="flex">
            <Pagination :links="ousents.links" />
          </div>
        </div>
        <DialogModal
          :show="showModal"
          class="mb-0 pb-0 bg-green-700"
          :bgHeader="editMode ? bgEdit : bgSave"
        >
          <template v-slot:title class="">
            <div class="flex justify-between ">
              <h3 v-show="!editMode" class="text-green-800 font-bold">Thêm đơn vị gửi mẫu</h3>
              <h3 v-show="editMode" class="text-green-800 font-bold">Thay đổi thông tin đơn vị</h3>
              <button
                @click.prevent="closeModal"
                class="
                  text-white
                  bg-green-500
                  px-4
                  py-1
                  rounded-md
                  hover:bg-green-300
                "
              >
                Close
              </button>
            </div>
          </template>
          <template v-slot:content class="mt-0">
            <div class="px-1 pb-0 bg-blue-800">
              <form
                class="
                  py-1
                  px-2
                  sm:p-1 sm:px-2
                  bg-white
                  overflow-hidden
                  shadow-xl
                  sm:rounded-lg
                "
                @submit.prevent="saveOu(form)"
              >
                <div class="flex">
                  <jet-label
                    for="name"
                    class="text-bold text-lg text-blue-800 w-24"
                    value="Tên đơn vị: "
                  />
                  <jet-input
                    required
                    id="name"
                    type="text"
                    class=" h-8 flex-1"
                    v-model="form.name"
                    autocomplete="name"
                  />
                  <div class="ml-4 text-red-800" v-if="errors.name">
                    * {{ errors.name }}
                  </div>
                </div>
                <div class="flex flex-1 mt-2">
                  <jet-label
                    for="name"
                    class="text-bold text-lg text-blue-800"
                    value="Tên hiển thị: "
                  />
                  <jet-input
                    id="title"
                    type="text"
                    class=" h-8 flex-1"
                    v-model="form.title"
                    autocomplete="name"
                  />
                </div>
                <div class="flex mt-2">
                  <div class="flex-1 mr-2">
                    <jet-label
                      for="address"
                      class="text-bold text-lg text-blue-800"
                      value="Địa chỉ"
                    />
                    <jet-input
                      required
                      id="address"
                      type="text"
                      class="h-8 w-full"
                      v-model="form.address"
                      autocomplete="address"
                    />
                    <!-- <div class="ml-4 text-red-800" v-if="errors.username"> * {{ errors.username }}</div>  -->
                  </div>
                  <div class="">
                    <jet-label
                      for="form_group"
                      class="text-bold text-lg text-blue-800"
                      value="Form group"
                    />
                    <select
                      name="form_group"
                      id="form_group"
                      class="h-8 w-full form-input rounded-lg py-1"
                      v-model="form.form_group"
                    >
                      <option v-for="(eg, i) in 20" :key="i" :value="i">
                        {{ i }}
                      </option>
                    </select>
                    <!-- <div class="ml-4 text-red-800" v-if="errors.username"> * {{ errors.username }}</div>  -->
                  </div>
                </div>
<!--========================================================================================================================================================-->
                <div class="grid grid-cols-2">
                   <div class="ml-2 mt-2 border-1 border-gray-700">
                  <div class="flex flex-col">
                    <div class="pl-2">
                        <input
                          type="checkbox"
                          :checked="asignView"
                          v-model="form.asign_view"
                          />
                        <span class="text-bold text-lg text-blue-800">Asign view</span>
                    </div>
                    </div>
                  </div>
<!--========================================================================================================================================================-->
<!--========================================================================================================================================================-->
                  <div class="ml-2 mt-2 border-1 border-gray-700">
                  <div class="">
                   <input type="file" class="hidden" ref="logo" @change="updatePhotoLogo()" />
                      <jet-label for="logo" value="Logo" class="text-blue-800"/>
                      <!-- Current Profile Photo   @change="updatePhotoPreview"-->
                      <div class="mt-2" v-show="!logoPreview">
                        <img :src="pathImage + logoUrl" class="mx-auto h-16" />
                      </div>
                      <!-- New Profile Photo Preview -->
                      <div class="mt-2 text-center" v-show="logoPreview">
                        <span class="w-full  justify-center">
                        <img :src="logoPreview" class="mx-auto  h-16" />
                        </span>
                      </div>
                      <jet-secondary-button
                        class="mt-2 mr-2 bg-red-400"
                        type="button"
                        @click.native.prevent="selectNewLogo"
                      >
                        Chọn Logo
                      </jet-secondary-button>
                      <jet-input-error :message="errorMessage" class="mt-2" />
                      <span class="cursor-pointer" @click="removeLogo()">Remove Logo</span>
                    </div>
                  </div>
<!--========================================================================================================================================================-->
                </div>
                <div class="grid grid-cols-2 mt-2">
                  <div class="ml-2 border-1 border-gray-700">
                     <div>
                      <input type="file" class="hidden" ref="header" @change="updatePhotoHeader()" />
                      <jet-label for="header" value="Header image" class="text-blue-800"/>
                      <!-- Current Profile Photo   @change="updatePhotoPreview"-->
                      <div class="mt-2" v-show="!headerPreview">
                        <img :src="pathHeader + imageHeader" class="h-16 mx-auto" />
                      </div>
                      <!-- New Profile Photo Preview -->
                      <div class="mt-2" v-show="headerPreview">
                         <span class="w-full  justify-center">
                        <img :src="headerPreview" class="mx-auto  h-16" />
                        </span>
                      </div>
                      <jet-secondary-button
                        class="mt-2 mr-2 bg-red-400"
                        type="button"
                        @click.native.prevent="selectNewHeader"
                      >
                        Chọn Header
                      </jet-secondary-button>

                      <jet-input-error :message="errorMessage" class="mt-2" />
                      <span class="cursor-pointer" @click="removeHeader()">Remove header</span>
                    </div>
                  </div>
                  <div class="ml-2 border-1 border-gray-700">
                    <div>
                      <input type="file" class="hidden" ref="footer" @change="updatePhotoFooter()" />
                      <jet-label for="footer" value="Footer image" class="text-blue-800"/>
                      <!-- Current Profile Photo   @change="updatePhotoPreview"-->
                      <div class="mt-2" v-show="!footerPreview">
                        <img :src="pathFooter + imageFooter" class="mx-auto  h-16"/>
                      </div>
                      <!-- New Profile Photo Preview -->
                      <div class="mt-2" v-show="footerPreview">
                        <span class="w-full  justify-center">
                          <img :src="footerPreview" class="mx-auto  h-16" />
                        </span>
                      </div>
                      <jet-secondary-button
                        class="mt-2 mr-2 bg-red-400"
                        type="button"
                        @click.native.prevent="selectNewFooter"
                      >
                        Chọn Footer
                      </jet-secondary-button>
                      <jet-input-error :message="errorMessage" class="mt-2" />
                      <span class="cursor-pointer" @click="removeFooter()">Remove footer</span>
                    </div>
                  </div>
                </div>
                <div class="mt-2 grid grid-cols-2">
                  <div class="mt-1 w-full rounded-sm">
                    <jet-label
                      for="phone_contact"
                      value="Điện thoại Đơn vị"
                      class="w-full block rounded-sm font-bold"
                    />
                    <jet-input
                      id="person_contact"
                      type="text"
                      class="mt-1 h-8 w-full"
                      v-model="form.phone_contact"
                      autocomplete="phone_contact"
                    />
                  </div>

                  <div class="ml-2 mt-1 w-full rounded-sm">
                    <jet-label
                      for="address"
                      value="website"
                      class="w-full font-bold block rounded-sm"
                    />
                    <jet-input
                      id="person_contact"
                      type="text"
                      class="mt-1 h-8 w-full"
                      v-model="form.website"
                      autocomplete="person_contact"
                    />
                  </div>
                </div>
                <div class="mt-2 grid grid-cols-2">
                  <div class="mt-2">
                    <jet-label
                      for="person_contact"
                      class="font-bold"
                      value="Người liên hệ"
                    />
                    <jet-input
                      id="person_contact"
                      type="text"
                      class="mt-1 h-8 w-full"
                      v-model="form.person_contact"
                      autocomplete="person_contact"
                    />
                  </div>
                  <div class="ml-2 mt-2">
                    <jet-label for="phone" class="font-bold" value="Phone" />
                    <jet-input
                      id="phone"
                      type="text"
                      class="mt-1 h-8 w-full"
                      v-model="form.phone"
                      autocomplete="phone"
                    />
                  </div>
                </div>
                <div class="mt-2 grid grid-cols-4">
                  <div>
                    <input
                      type="checkbox"
                      :checked="logoView"
                      v-model="form.logo_view"
                    /><span class="text-bold text-lg text-blue-800">
                      Logo view</span
                    >
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      :checked="addressView"
                      v-model="form.address_view"
                    /><span class="text-bold text-lg text-blue-800">
                      Address view</span
                    >
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      :checked="headerView"
                      v-model="form.header_view"
                    /><span class="text-bold text-lg text-blue-800">
                      Header view</span
                    >
                  </div>
                  <div>
                    <input
                      type="checkbox"
                      :checked="footerView"
                      v-model="form.footer_view"
                    /><span class="text-bold text-lg text-blue-800">
                      Footer view</span
                    >
                  </div>
                </div>
                <div class="mt-2 text-center mb-1">
                  <span
                    class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                  >
                    <button
                      v-show="!editMode"
                      type="submit"
                      class="
                        bg-blue-900
                        text-white
                        inline-flex
                        justify-center
                        w-20
                        rounded-md
                        border border-gray-300
                        px-4
                        py-2
                        leading-6
                        font-medium
                        shadow-sm
                        hover:bg-gray-500
                        focus:outline-none
                        focus:border-blue-300
                        focus:shadow-outline-blue
                        transition
                        ease-in-out
                        duration-150
                        sm:text-sm sm:leading-5
                      "
                    >
                      Save
                    </button>
                  </span>
                  <span
                    class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                  >
                    <button
                      wire:click.prevent="store()"
                      type="button"
                      class="
                        inline-flex
                        justify-center
                        w-full
                        rounded-md
                        border border-transparent
                        px-4
                        py-2
                        bg-green-600
                        text-base
                        leading-6
                        font-medium
                        text-white
                        shadow-sm
                        hover:bg-green-500
                        focus:outline-none
                        focus:border-green-700
                        focus:shadow-outline-green
                        transition
                        ease-in-out
                        duration-150
                        sm:text-sm sm:leading-5
                      "
                      v-show="editMode"
                      @click.prevent="updateOu(form)"
                    >
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
import DeleteX from "@/Components/DeleteX";
import JetButton from "@/Jetstream/Button";
import Modal from "@/Components/Modal";
import DialogModal from "@/Components/DialogModal";
import Button from "@/Jetstream/Button";
import Multiselect from "@vueform/multiselect";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import AppImage from "@/Components/Image";
import { Link } from "@inertiajs/inertia-vue3";
import Checkbox from "@/Jetstream/Checkbox";

import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInputError from "@/Jetstream/InputError";

export default defineComponent({
  name: "Danh sách đơn vị gửi mẫu",
  props: {
    ousents: "",
    filters: "",
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
    DeleteX,
    JetButton,
    AppImage,
    Modal,
    DialogModal,
    Button,
    Multiselect,
    JetLabel,
    JetInput,
    AppImageView,
    Checkbox,
    Link,
    JetSecondaryButton,
    JetInputError
  },
  data() {
    return {
      logoPreview:null,
      headerPreview:null,
      footerPreview:null,
      clearImage: null,
      formGroup: "",
      logoView: null,
      asignView: null,
      addressView: "",
      headerView: "",
      footerView: "",
      perPage: this.filters.perPage,
      termSearch: "",
      logoUrl: "",
      imageHeader: "",
      imageFooter: "",
      pathImage: "/storage/Image_Ousent/",
      pathHeader: "/storage/imageHeader_Ousent/",
      pathFooter: "/storage/imageFooter_Ousent/",
      userEdit: "",
      showModal: "",
      editMode: false,
      maxWidth: "4xl",
      titleHeader: "Edit",
      example4: {
      mode: "tags",
      value: "value",
      label: "name",
      searchable: true,
      createTag: true,
      },
      form: this.$inertia.form(
        {
          // "_method": this.edit ? 'PUT' : "",
          name: "",
          address: "",
          logo: "",
          image_header: "",
          file: "",
          website: "",
          person_contact: "",
          phone: "",
        },
        {
          resetOnSuccess: false,
        }
      ),
    };
  },
  computed: {
    addClassImage() {
      return " rounded-full w-20 object object-contain";
    },
    addClassImageHeader() {
      return " rounded-full h-14 w-44";
    },
    AddClassCard() {
      return "px-10 bg-blue-800";
    },
    breadcrumbs() {
      return [
        {
          label: "Đơn vị gửi mẫu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Tên đơn vị", class: "border-l-2 text-center" },
        { name: "Title header", class: "border-l-2 text-center" },
        { name: "Địa chỉ", class: "border-l-2 text-center" },
        { name: "Form group", class: "border-l-2 text-center" },
        { name: "Phone đơn vị", class: "border-l-2 text-center" },
        { name: "Người liên hệ", class: "text-center border-l-2" },
        { name: "Phone ", class: "border-l-2 text-center" },
        { name: "Hiện chữ ký", class: "border-l-2 text-center" },

        { name: "Logo", class: "border-l-2 text-center" },
        { name: "Image Header", class: "border-l-2 text-center" },
        { name: "Image Footer", class: "border-l-2 text-center" },

        { name: "Website", class: "border-l-2 text-center" },
        { name: "Action", class: "text-right border-l-2" },
      ];
    },
    addClass() {
      return "bg-gray-300 align-middle";
    },
    bgSave() {
      return "bg-gray-600 text-white";
    },
    bgEdit() {
      return "bg-green-600 text-white";
    },
    tableClass() {
      return "table table-reponsive";
    },
  },
  methods: {
    /*===============================================Imgage==================*/
      updatePhotoLogo() {
      const reader = new FileReader();
      // let file = this.$refs.photo.files[0]
      //   this.url = URL.createObjectURL(file
      reader.onload = (e) => {
        this.logoPreview = e.target.result;
        this.form.logo =  this.$refs.logo.files[0];
      };
      reader.readAsDataURL(this.$refs.logo.files[0]);
    },
    selectNewLogo() {
      this.$refs.logo.click();
    },
     removeLogo() {
        this.logoPreview = null;
      },
    //=========Header====================
    updatePhotoHeader() {
      const reader = new FileReader();
      reader.onload = (e) => {
      this.headerPreview = e.target.result;
      this.form.image_header =  this.$refs.header.files[0];
      };
      reader.readAsDataURL(this.$refs.header.files[0]);
    },
    selectNewHeader() {
      this.$refs.header.click();
    },
      removeHeader() {
        this.headerPreview = null;
      },
    //=========Footer====================
    updatePhotoFooter() {
      const reader = new FileReader();
      reader.onload = (e) => {
        this.footerPreview = e.target.result;
        this.form.image_footer =  this.$refs.footer.files[0];

      };
      reader.readAsDataURL(this.$refs.footer.files[0]);
    },
    selectNewFooter() {
      this.$refs.footer.click();
    },
      removeFooter() {
        this.footerPreview = null;
      },
    /*===================================================Modal==================*/
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.reset();
      this.showModal = false;
      this.editMode = false;
    },
    reset() {
          this.asignView = null;
          this.logoView = null;
          this.addressView = null;
          this.headerView = null;
          this.footerView = null;
          this.logoUrl = null;
          this.clearImage = null;
          this.logoPreview = null;
          this.headerPreview = null;
          this.footerPreview = null;
          this.imageHeader = null;
          this.imageFooter = null;
          this.form = {
            name: null,
            username: null,
            logo: null,
          };
        },
    /*===================================================Add Update Delete==================*/
    addOu() {
      this.showModal = true;
    },
    saveOu(data) {
      this.$inertia.post("/dashboard/ousents", data);
      this.closeModal();
    },
    editOu(ou) {
      const viewOu = (this.form = Object.assign({}, ou));

      this.logoUrl = viewOu.logo;

      this.imageHeader = viewOu.image_header;
      this.imageFooter = viewOu.image_footer;

      //console.log(viewOu.logo_view);
      if (viewOu.logo_view == 1) this.logoView = true;
      else this.logoView = false;

      if (viewOu.address_view == 1) this.addressView = true;
      else this.addressView = false;

      if (viewOu.header_view == 1) this.headerView = true;
      else this.headerView = false;
      if (viewOu.footer_view == 1) this.footerView = true;
      else this.footerView = false;
      if (viewOu.asign_view == 1) this.asignView = true;
      else this.asignView = false;

      this.editMode = true;

      this.showModal = true;
    },
    updateOu(data) {

      data._method = "PUT";
      this.$inertia.post("/dashboard/ousents/" + data.id, data);
      this.closeModal();
    },
    /*===================================================Search==================*/
    search() {
      this.$inertia.get(
        "/dashboard/ousents?",
        {
          //alert(ousentFill);
          term: this.termSearch,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    getfilePerpage() {
      this.$inertia.get(
        "ousents?",
        {
          //search:this.search,
          perPage: this.perPage,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    getFormgroup() {
      this.$inertia.get(
        "/dashboard/ousents?",
        {
          //search:this.search,
          formGroup: this.formGroup,
        },
        {
          preserveState: true,
          replace: true,
        }
      );
    },
    /*===================================================Upload file==================*/
    submitFile() {
      if (this.$refs.photo) {
        this.form.file = this.$refs.photo.files[0];
      }
      this.form.post(route("importOusent"));
      this.form.file = "";
    },
  },
});
</script>
 <style src="@vueform/multiselect/themes/default.css"></style>
