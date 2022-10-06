<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="rounded bg-gray-100 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
  />
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  emits: ["update:checked"],

  props: {
    checkedChile: {
      type: [Array, Boolean],
      default: false,
    },
    value: {
      type: Array,
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checkedChile;
      },

      set(val) {
        this.$emit("update:checkedChile", val);
      },
    },
  },
});
</script>
