<template>
  <app-layout title="Add Peemission">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <form @submit.prevent="savePermission">
          <!--Name--->+

          <!--Id Parent--->
          <div class="mt-4">
            <jet-label for="parent_id" value="Parent menu" />
            <select
              name="parent_id"
              id="parent_id"
              class="block w-full form-input"
              v-model="form.menu_id"
            >
              <option value="" disabled>--Choose Permission Parent--</option>
              <option :value=0>Không</option>
              <option
                v-for="permission in permissions.data"
                :key="permission.id"
                :value="permission.id"
              >
                {{ permission.name }}
              </option>
            </select>

          </div>
          <!--Url--->

          <!--Status--->
          <div class="px-4 w-full grid grid-cols-5">
            <div v-for="chilemenu in chilemenus.data" :key="chilemenu.id">
              <Checkbox
                    :checked="checkededit"
                      class="form-checkbox text-pink-600 h-4 w-4"
                      id="menuselected.id"
                      v-model:checkedChile="form.menuchile_id"
                      :value="chilemenu.id"
                    />
                    <span class="ml-2">{{chilemenu.name}}</span>
          </div>

          </div>
            <div class="">
            <jet-label for="display_name" value="Display name" />
            <jet-input
              id="display_name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.display_name"
              autocomplete="display_name"
            />
            <jet-input-error :message="form.errors.display_name" class="mt-2" />
          </div>
          <!--Action--->
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
import Checkbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";
import AppImage from "@/Components/Image";

import { strSlug } from "@/helpers.js";

export default {
  name: "Add permission",
  props: {
    edit: Boolean,
    permissions: Object,
    chilemenus: "",
    Permission:"",
    test:''

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
      checkededit: "",
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          menu_id:"",
          display_name: "",
          menuchile_id:[],
          display_nameChile:[],

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
          label: "Permission",
          url: route("permissions.index"),
        },
        {
          label: `${this.edit ? "Edit" : "Add"} Permission`,
        },
      ];
    },
  },

  methods: {
    savePermission() {
      //alert(123);
      this.edit
        ? this.form.put(route("permissions.update", { id: this.Permission.data.id }))
        : this.form.post(route("permissions.store"));
    },
     scrollToView(element){
    var offset = element.offset().top;
    if(!element.is(":visible")) {
        element.css({"visibility":"hidden"}).show();
        var offset = element.offset().top;
        element.css({"visibility":"", "display":""});
    }
     }
  },
  mounted() {
    if (this.edit) {
    // this.form.menu_id = this.Permission.data.menu_id;
    //  this.form.id_parent = this.Permission.data.id_parent;
    // this.form.menuchile_id = this.Permission.data.menuchile_id;
      // this.form.icon = this.permissiondit.data.icon;
      // this.form.status = this.permissiondit.data.status;
      // this.checkededit = this.permissiondit.data.status == 1 ? true : false;
    }
  },
};
</script>
