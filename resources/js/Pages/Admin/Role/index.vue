<template>
  <app-layout title="Role list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('roles.create')" class="mb-1 justify-self-end"
            >Add <router-link></router-link
          ></JetButton>
        </div>
        <Table :headers="headers" :addClass="addClass">
          <tr v-for="(role, i) in roles.data" :key="i">
            <td>{{ role.id }}</td>
            <td>{{ role.name }}</td>
            <td>{{ role.display_name }}</td>
            <td>
              <svg
                v-if="role.status == 1"
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
            <td>
              <div class="flex items-center justify-end space-x-3">
                <EditBtn    :href="route('roles.edit', { role: role.id })" title="Edit">
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
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="user"
                  :url="route('roles.destroy', { role: role.id })"
                />
              </div>
            </td>
          </tr>
        </Table>
        <div class="mt-4">
          <!-- <CompSimplePage :prevUrl="users.links.prev" :nextUrl="users.links.next" /> -->
        </div>

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
import CompSimplePage from "@/Components/SimplePage";

import EditBtn from "@/Components/EditButton";
import DeleteBtn from "@/Components/DeleteBtn";
import JetButton from "@/Jetstream/Button";

export default defineComponent({
  name: "Roles Vai tro",
  props: {
    roles: {},
  },
  components: {
    AppLayout,
    Breadcrumb,
    Container,
    Card,
    Table,
    CompSimplePage,
    EditBtn,
    DeleteBtn,
    JetButton,
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Role",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Name " },
        { name: "Display Name" },
        { name: "Status" },
        { name: "Action", class: "text-right" },
      ];
    },
    addClass() {
      return "bg-gray-300";
    },
  },
});
</script>
