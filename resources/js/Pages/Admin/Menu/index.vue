<template>
  <app-layout title="Nhập thông tin">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('menus.create')" class="mb-1 justify-self-end bg-indigo-600"
            >Add Menu</JetButton
          >
        </div>
        <AppTable :headers="headers">
          <tr v-for="(menu, i) in menus.data" :key="i">
            <td>{{ i + 1 }}</td>
            <td>{{ menu.id }}</td>
            <td>{{ menu.name }}</td>
            <td>{{ menu.id_parent }}</td>
            <td>{{ menu.url }}</td>
            <td>{{ menu.icon }}</td>

            <td>
              <svg
                v-if="menu.status == 1"
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
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
              <svg
                v-else
                class="w-6 h-6 text-gray-200"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                ></path>
              </svg>
            </td>
            <td class="text-right">
              <div class="flex items-center justify-end space-x-3">
                <EditBtn :href="route('menus.edit', { menu: menu.id })" title="Edit">
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
                  :url="route('menus.destroy', { menu: menu.id })"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="Menu"
                />
              </div>
            </td>
          </tr>
        </AppTable>
        <div class="mt-4">
          <CompSimplePage :prevUrl="menus.links.prev" :nextUrl="menus.links.next" />
        </div>
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
    menus: {},
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
          label: "Menu",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Id" },
        { name: "Menu Name" },
        { name: "Id Parent" },
        { name: "Url" },
        { name: "Icon" },
        { name: "Hiển thị" },
        { name: "Action", class: "text-right" },
      ];
    },
  },
});
</script>
