<template>
  <app-layout title="Role list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton  class="mb-1 justify-self-end"
            >Add <router-link></router-link
          ></JetButton>
        </div>
        <Table :headers="headers" >
          <tr v-for="(post, index) in posts" :key="index">
            <td>{{post.id}}</td>
            <td>{{post.title}}</td>
            <td>{{post.user_id}}</td>
            <td>
              <span v-if="post.status == 1" class="text-blue-800">Enable</span>
              <span v-else class="text-gray-400">Disable</span>
            </td>
            <td class="text-right">
               <EditBtn :href="route('show', post.id)" title="Edit">
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
  name: "Post",
  props: {
    posts: {},
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
          label: "Danh sach post bai",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Title" },
        { name: "Tac gia" },
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
