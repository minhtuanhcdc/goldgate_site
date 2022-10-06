<template>
  <app-layout title="Chile menu">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('chilemenus.create')" class="mb-1 justify-self-end"
            >Add Chile Menu</JetButton
          >
        </div>
        <AppTable :headers="headers">
          <tr v-for="(chilemenu, i) in chilemenus.data" :key="i">
            <td>{{ i + 1 }}</td>
            <td>{{ chilemenu.id }}</td>
            <td>{{ chilemenu.name }}</td>
            <td>{{ chilemenu.created_at_forhuman }}</td>
            <td class="text-right">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn :href="route('chilemenus.edit', { chilemenu: chilemenu.id })" title="Edit">
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
                :url="route('chilemenus.destroy', { chilemenu: chilemenu.id })"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="chileMenu"
                />
              </div>
            </td>
          </tr>
        </AppTable>
        <!-- <div class="mt-4">
          <CompSimplePage :prevUrl="menus.links.prev" :nextUrl="menus.links.next" />
        </div> -->
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumb from "@/Components/Breadcrumb";
import Container from "@/Components/Container";
import Card from "@/Components/Card";
import AppTable from "@/Components/Table";
import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import CompSimplePage from "@/Components/SimplePage";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
  props: {
    chilemenus: {},
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    AppTable,
    CompSimplePage,
    EditBtn,
    DeleteBtn,

    JetButton,
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Chile menu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Id" },
        { name: "Name" },
        { name: "Created" },
        { name: "Action", class: "text-right" },
      ];
    },
  },
});
</script>
