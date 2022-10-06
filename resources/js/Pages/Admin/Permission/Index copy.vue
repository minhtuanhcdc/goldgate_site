<template>
  <app-layout title="Menu list">
    <template #header>
      <Breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('permissions.create')" class="mb-1 justify-self-end"
            >Add Permission(Menu_hasUrl)</JetButton
          >
        </div>
        <AppTable :headers="headers">
          <tr v-for="(permission, i) in permissions.data" :key="i">
            <td>{{ i + 1 }}</td>
            <td>{{ permission.id }}</td>
            <td>
              <span v-if="permission.parent_id==0" class="font-bold text-blue-800">{{permission.menus.name}}</span>
              <span v-else class="pl-8">{{permission.menuchiles.name}}</span>            
            </td>
            <td>{{ permission.display_name }}</td>
            <td>{{ permission.parent_id }}</td>
            <td>{{ permission.key_code }}</td>
            <td>{{ permission.created_at_for_human }}</td>
            <td class="text-right">
              <div class="flex items-center justify-end space-x-3" >
                <EditBtn v-show="permission.parent_id==0"
                  :href="route('permissions.edit', { permission: permission.id })"
                  title="Edit"
                >
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
                 v-show="permission.parent_id==0"
                  title="Xóa"
                  class="p-0 cursor-pointer text-red-800"
                  module-name="Permission"
                />
              </div>
            </td>
          </tr>
        </AppTable>
        <div class="mt-4">
          <!-- <CompSimplePage
            :prevUrl="permissions.links.prev"
            :nextUrl="permissions.links.next"
          /> -->
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
    permissions: {},
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
          label: "Permission",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Id" },
        { name: "Name" },
        { name: "Display name" },
        { name: "Parent Id" },
        { name: "Key code" },
        { name: "Date create" },
        { name: "Action", class: "text-right" },
      ];
    },
  },
});
</script>
