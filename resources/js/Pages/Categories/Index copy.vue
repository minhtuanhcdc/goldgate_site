<template>
  <app-layout title="Category list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('categories.create')" class="mb-2 justify-self-end"
            >Add Category</JetButton
          >
        </div>
        <div v-for="(role, i) in $page.props.user.roles"
                    :key="i">
            <p >View key_code:{{role.name}}</p>
        </div>
        <AppTable :headers="headers">
       
          <tr v-for="(category, index) in categories.data" :key="index">
            <td>{{ category.id }}</td>
            <td>{{ category.name }}</td>
            <td>{{ category.slug }}</td>
            <td>{{ category.created_at_for_human }}</td>
            <td with="10%">
              <div class="flex items-center justify-end space-x-4">
             <div v-for="(role, i) in $page.props.user.roles" :key="i">
               <span  v-for="(keycode ,index) in role.permissions" :key="index">
                <EditButton v-if="keycode.key_code=='1_3'"  :href="route('categories.edit', { category: category.id })" >
                  <svg
                    class="w-6 h-6 text-blue-800"
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
                ></EditButton>
               </span>
             </div>
                <DeleteBtn
                  :url="route('categories.destroy', { category: category.id })"
                  class="p-0 cursor-pointer"
                  module-name="category"
                />
              </div>
            </td>
          </tr>
        </AppTable>
        <div class="mt-4">
          <CompSimplePage
            :prevUrl="categories.links.prev"
            :nextUrl="categories.links.next"
          />
        </div>
      </Card>
    </Container>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import Container from "@/Components/Container";
import Card from "@/Components/Card";

import EditButton from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import CompSimplePage from "@/Components/SimplePage";
import AppTable from "@/Components/Table";
import JetButton from "@/Jetstream/Button";

export default {
  name: "Category",
  props: {
    categories: {},
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    AppTable,

    JetButton,
    EditButton,
    DeleteBtn,
    CompSimplePage,
  },
  computed: {
    headers() {
      return [
        { name: "#" },
        { name: "Name" },
        { name: "Slug" },
        { name: "Created at" },
        { name: "Actions", class: "text-right pr-2" },
      ];
    },
    breadcrumbs() {
      return [{ label: "Category", class: "text-red-600" }];
    },
  },
};
</script>
