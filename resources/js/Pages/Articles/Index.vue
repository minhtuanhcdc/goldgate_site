<template>
  <app-layout title="Add Article">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton v-show="$page.props.can.create" :href="route('articles.create')" class="mb-1 justify-self-end"
            >Add Article</JetButton
          >
        </div>
        <AppTable :headers="headers" :addClass="addClass">
          <tr v-for="(article, i) in articles.data" :key="i">
            <td>{{ article.id }}</td>
            <td>{{ article.title }}</td>
            <td>{{ article.category.name }}</td>
            <td>
              <div class="flex-shrink-0 h-20 w-20 m-0">
                <img
                  class="h-20 w-20 rounded-full"
                  :src="`${article.image_url}`"
                  :alt="`${article.image}`"
                />
              </div>
            </td>
            <td>{{ article.slug }}</td>
            <td>{{ article.description }}</td>
            <td>{{ article.created_at_for_humans }}</td>
            <td>
              <div class="flex items-center justify-end space-x-2">
                <EditBtn v-show="$page.props.can.edit" :href="route('articles.edit', { article: article.id })">
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
                ></EditBtn>
                <DeleteBtn
                  v-show="$page.props.can.delete"
                  :url="route('articles.destroy', { article: article.id })"
                  class="p-0 cursor-pointer"
                  module-name="article"
                />
              </div>
            </td>
          </tr>
          <tr v-if="articles.data.length == 0" :aria-colspan="headers.length">
            <td colspan="4" class="p-4">Not data available</td>
          </tr>
        </AppTable>
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
import EditBtn from "@/Components/EditButton";

import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import CompSimplePage from "@/Components/SimplePage";

import { strSlug } from "@/helpers.js";

export default {
  name: "Add Category",
  props: {
    edit: Boolean,
    articles: Object,
  },
  components: {
    AppLayout,
    Container,
    Card,
    Breadcrumb,
    EditBtn,

    DeleteBtn,
    CompSimplePage,
    AppTable,
    JetButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
  },
  computed: {
    breadcrumbs() {
      return [{ label: "Article", class: "text-red-800" }];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Title" },
        { name: "Category" },
        { name: "Image" },
        { name: "Slug" },
        { name: "Description" },
        { name: "created_at_for_humans" },
        { name: "Actions", class: "text-right pr-2" },
        { classHeader: "bg-yellow-500" },
      ];
    },
    addClass() {
      return "bg-red-500 text-white";
    },
  },
};
</script>
