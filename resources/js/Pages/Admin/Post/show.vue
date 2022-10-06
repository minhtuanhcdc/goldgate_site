<template>
  <app-layout title="Role list">
    <template #header>
      <breadcrumb :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <div class="grid justiry-items-stretch">
          <JetButton :href="route('posts')"  class="mb-1 justify-self-end">
            Return
          </JetButton>
        </div>
        <Table >
        <h3>show Bai viet</h3>
        <p >{{post.title}}</p>
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
  name: "post bai",
  props: {
    post: '',
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
          label: "post bai",
          class: "text-white",
        },
      ];
    },
    headers() {
      return [
        { name: "#" },
        { name: "Name" },
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
