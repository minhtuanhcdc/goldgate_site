<template>
  <div>
<div>{{clearTest}}</div>
    <input type="file" class="hidden" ref="photo" @change="updatePhotoPreview" />

    <jet-label for="photo" :value="label" />

    <!-- Current Profile Photo   @change="updatePhotoPreview"-->

    <div class="mt-2" v-show="!photoPreview">
      <img :src="imageUrl" :class="addClassImage" />
    </div>

    <!-- New Profile Photo Preview -->
     <div class="mt-2" v-show="photoPreview">
      <span
        class="block h-16 w-32"
        :style="
          'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
          photoPreview +
          '\');'
        "
      >
      </span>
    </div>

    <jet-secondary-button
      class="mt-2 mr-2 bg-red-400"
      type="button"
      @click.native.prevent="selectNewPhoto"
    >
      Chọn Image
    </jet-secondary-button>

    <jet-input-error :message="errorMessage" class="mt-2" />
     <span class="cursor-pointer" @click="removeImage()">Remove image</span>
  </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetInputError from "@/Jetstream/InputError";

export default {
  components: {
    JetLabel,
    JetSecondaryButton,
    JetInputError,
  },

  props: {
    addClassImage:'',
    modelValue: "",
    imageUrl: {},
    label: {},
    errorMessage: {},
    clearImage:{
    }

  },
  emits: ["update:modelValue"],
  data() {
    return {

      photoPreview:this.clearImage,

    };
  },
    watch:{

        },
  create(){
          this.photoPreview=this.clearImage;
        },

  computed: {
    clearTest(){
      return this.photoPreview = this.clearImage;
    }

  },

  methods: {
    updatePhotoPreview() {
      const reader = new FileReader();
      // let file = this.$refs.photo.files[0]
      //   this.url = URL.createObjectURL(file)

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
    removeImage(e) {

      var data = {
        title:'test',
        image:  this.photoPreview
            };

        this.$emit('eventRemoveImage',data);
    }
  },

  mounted() {
    this.photoPreview = this.clearImage;

  },
};
</script>
