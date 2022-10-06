<template>
    <div class="mt-2" v-show="!photoPreview">
      <img :src="imageUrl" class="rounded-full h-20 w-20 object-cover" />
  </div>
 
</template>

<script>


export default {
 
  props: {
    modelValue: "",
    imageUrl: {},
    label: {},
    errorMessage: {},
  },
  emits: ["update:modelValue"],

  data() {
    return {
      photoPreview: null,
    };
  },

  computed: {},

  methods: {
    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.photo.files[0]);
      //this.$emit("input", this.$refs.photo.files[0]);
      this.$emit("update:modelValue", this.$refs.photo.files[0]);
    },

    selectNewPhoto() {
      this.$refs.photo.click();
    },
  },

  watch: {},

  mounted() {},
};
</script>
