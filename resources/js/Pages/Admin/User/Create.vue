<template>
  <app-layout>
    <template #header>
      <Breadcrumbs :items="breadcrumbs" />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form
          class="p-4 sm:p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg"
          @submit.prevent="saveUser"
        >
          <!--Name- User name-->+
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
              <jet-input-error :message="form.errors.name" class="mt-2" />
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
              <jet-input-error :message="form.errors.username" class="mt-2" />
            </div>
          </div>
          <!--Role-->
          <!--Role--->
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
              <!-- <jet-input-error :message="form.errors.role_id" class="mt-2" /> -->
            </div>
          </div>
          <!--Email Phone-->
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
              <jet-input-error :message="form.errors.email" class="mt-2" />
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
              <jet-input-error :message="form.errors.phone" class="mt-2" />
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
          <div class="mt-4">
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Save
            </jet-button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Breadcrumbs from "@/Components/Breadcrumb";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
//import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import AppImage from "@/Components/Image";
import AppCkeditor from "@/Components/Ckeditor";
import { strSlug } from "@/helpers.js";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    AppLayout,
    JetInput,
    JetInputError,
    JetLabel,
    Breadcrumbs,
    //JetSecondaryButton,
    JetButton,
    AppImage,
    AppCkeditor,
    Multiselect,
  },

  props: {
    edit: Boolean,
    user: Object,
    roles: {},
    roleOfUser: "",
  },

  data() {
    return {
      imageUrl: "",
      example4: {
        mode: "tags",

        value: "value",
        label: "name",
        options: this.roles.data,

        searchable: true,
        createTag: true,
      },
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          name: "",
          username: "",
          email: "",
          phone: "",
          role_id: [1,2],
          image: "",
        },
        {
          resetOnSuccess: false,
        }
      ),
    };
  },

  computed: {
    breadcrumbs() {
      return [
        {
          label: "Users",
          url: this.route("users.index"),
        },
        {
          label: "Add User",
        },
      ];
    },
  },

  methods: {
    saveUser() {
      this.edit
        ? this.form.post(route("users.update", { id: this.user.data.id }))
        : this.form.post(route("users.store"));
    },
  },

  watch: {},

  mounted() {
    if (this.edit) {
      this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      this.form.name = this.user.data.name;
      this.form.username = this.user.data.username;
      this.form.email = this.user.data.email;
      this.form.phone = this.user.data.phone;
      this.imageUrl = this.user.data.profile_photo_path;
    }
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
