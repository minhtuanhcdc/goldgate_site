<template>
  <app-layout title="Add Category">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <form @submit.prevent="saveUser">
          <!--Name- User name-->+
          <div class="grid grid-cols-2">
            <div class="mt-2">
              <jet-label for="name" value="name" />
              <jet-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                autocomplete="name"
              />
              <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
            <div class="ml-4 mt-2">
              <jet-label for="username" value="User name" />
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
          <!--mail--->
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
          <!--Image--->
          <AppImage
            class="mt-2"
            v-model:modelValue="form.profile_photo_path"
            :image-url="user.data.profile_photo_path"
            label="Image"
            :error-message="form.errors.image"
          />

          <!--Action--->
          <div class="text-center mt-2">
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              <span v-if="edit">Updated.</span>
              <span v-else>Saved.</span>
            </jet-action-message>
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              <span v-if="edit">Update</span>
              <span v-else>Save</span>
            </jet-button>
          </div>
        </form>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import Multiselect from "@vueform/multiselect";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import AppTable from "@/Components/Table";

import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";
import AppImage from "@/Components/Image";

export default {
  name: "Add User",
  props: {
    edit: Boolean,
    user: Object,
    roles: {},
    roleOfUser: "",
  },
  components: {
    AppLayout,
    Container,
    Card,
    Breadcrumb,
    AppImage,
    DeleteBtn,
    CompSimplePage,
    AppTable,
    JetButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
    Multiselect,
  },
  data() {
    return {
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
          role_id: [],
          profile_photo_path: null,
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
          label: "User",
          url: route("users.index"),
        },
        {
          label: `${this.edit ? "Edit" : "Add"} User`,
        },
      ];
    },
  },
  watch: {},
  methods: {
    saveUser() {
      this.edit
        ? this.form.put(route("users.update", { id: this.user.data.id }))
        : this.form.post(route("users.store"));
    },
  },
  mounted() {
    if (this.edit) {
      this.form.role_id = this.roleOfUser !== "" ? this.roleOfUser : "";
      this.form.name = this.user.data.name;

      this.form.username = this.user.data.username;
      this.form.email = this.user.data.email;
      this.form.phone = this.user.data.phone;
      //this.form.profile_photo_path = this.user.data.profile_photo_path;
    }
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
