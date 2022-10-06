<template>
  <app-layout title="Add Category">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <span v-for="u in userRole" :key="u.i"
          >Cấp quyền cho: <i class="font-bold">{{ u.name }}</i></span
        >

        <form @submit.prevent="saveRole(`${userRole[0].id}`)">
          <div class="bg-white px-4 pt-1 pb-1 sm:p-2 sm:pb-1">
            <ul
              v-for="(menu, index) in menus.data"
              :key="index"
              class="grid gap-4 grid-cols-2"
            >
              <li v-if="menu.id_parent == 0" style="list-style: none">
                <label class="inline-flex items-center">
                  <input
                    type="checkbox"
                    class="form-checkbox text-pink-600 h-3 w-3"
                    id="menu.id"
                    v-model="form.menuSelected"
                    v-bind:value="menu.id"
                  />
                  <span class="ml-2">{{ menu.name }}</span>
                </label>
                <ul class="ml-6" v-for="(menucon, index) in menus.data" :key="index">
                  <li v-if="menu.id == menucon.id_parent" style="list-style: none">
                    <label class="inline-flex items-center">
                      <input
                        type="checkbox"
                        class="form-checkbox text-pink-600 h-3 w-3"
                        id="menucon.id"
                        v-model="form.menuSelected"
                        v-bind:value="menucon.id"
                      />
                      <span class="ml-2"> {{ menucon.name }}</span>
                    </label>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <div class="text-right mt-2">
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

import Checkbox from "@/Jetstream/Checkbox";

export default {
  name: "Add Role",
  props: {
    edit: Boolean,
    userRole: Object,
    menus: Object,
    menuedits: Object,

    // users: {
    //     type: Object,
    //     default: function () {
    //         return {
    //         data: [],
    //         };
    //     },
    //     },
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
    Checkbox,
  },
  data() {
    return {
      checkededit: [],
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          menuSelected: [],
          id_user: `${this.userRole[0].id}`,
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
    saveRole($id) {
      //alert($id);
      this.edit
        ? this.form.put(route("menupermision.update", { id: $id }))
        : this.form.post(route("users.store"));
    },
  },
  mounted() {
    if (this.edit) {
      //this.checkededit = this.menuedits;
      this.form.menuSelected = this.menuedits;
      // this.form.email = this.user.data.email;
      // this.form.phone = this.user.data.phone;
      // this.form.profile_photo_path = this.user.data.profile_photo_path;
    }
  },
};
</script>
