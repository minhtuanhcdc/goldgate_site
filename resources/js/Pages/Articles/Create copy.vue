<template>
  <app-layout title="Add Category">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <form @submit.prevent="saveArticle">
          <!--Name--->+
          <div class="">
            <jet-label for="title" value="Title" />
            <jet-input
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              autocomplete="title"
            />
            <jet-input-error :message="form.errors.title" class="mt-2" />
          </div>
          <!--Slug--->
          <div class="mt-2">
            <jet-label for="slug" value="Slug" />
            <jet-input
              id="slug"
              type="text"
              class="mt-1 block w-full"
              v-model="form.slug"
              autocomplete="slug"
            />
            <jet-input-error :message="form.errors.slug" class="mt-2" />
          </div>
          <!--Image--->
          <AppImage
            class="mt-2"
            v-model="form.image"
            :image-url="imageUrl"
            label="Image"
            :error-message="form.errors.image"
          />
          <!--Category--->
          <div class="mt-4">
            <jet-label for="category" value="Category" />
            <select
              name="category"
              id="category"
              class="block w-full form-input"
              v-model="form.id_category"
            >
              <option value="">===Select===</option>
              <option
                v-for="category in categories.data"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <jet-input-error :message="form.errors.id_category" class="mt-2" />
          </div>
          <!--Description--->
          <!--Slug--->
          <div class="col-span-6 sm:col-span-12">
            <jet-label for="description" value="Description" />
            <ckeditor
              :editor="editor"
              v-model="form.description"
              :config="editorConfig"
            ></ckeditor>
            <jet-input-error :message="form.errors.about_description" class="mt-2" />
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
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";
import AppImage from "@/Components/Image";

import { strSlug } from "@/helpers.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  name: "Add article",
  props: {
    edit: Boolean,
    article: Object,
    categories: {
      type: Object,
      default: function () {
        return {
          data: [],
        };
      },
    },
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
    ClassicEditor,
  },
  data() {
    return {
      imageUrl: "",
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          title: "",
          slug: "",
          id_category: "",
          description: this.edit ? this.article.data.description : "",
          image: "",
        },
        {
          resetOnSuccess: false,
        }
      ),
      editor: ClassicEditor,
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
    };
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Article",
          url: route("articles.index"),
        },
        {
          label: `${this.edit ? "Edit" : "Add"} Article`,
        },
      ];
    },
  },
  watch: {
    "form.title"(title) {
      this.form.slug = strSlug(title);
    },
  },
  methods: {
    saveArticle() {
      //alert(123);
      this.edit
        ? this.form.put(route("articles.update", { id: this.article.data.id }))
        : this.form.post(route("articles.store"));
    },
  },
  mounted() {
    if (this.edit) {
      this.form.title = this.article.data.title;
      this.form.slug = this.article.data.slug;
      this.form.id_category = this.article.data.id_category;
    }
    this.imageUrl = this.article.data.image_url;
  },
};
</script>
