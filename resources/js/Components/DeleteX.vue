<template>
<div class="">
  <button title="Delete" @click.prevent="show=true">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>

  </button>
  <JetConfirmationModal :show="show">
    <!-- <template #title>
       {{moduleName}}
    </template> -->
    <template #content>
      Are you delete {{moduleName}}
    </template>
     <template #footer>
      <SecondaryButton @click.prevent="show=false">
        Cancel
      </SecondaryButton>
       <DangerButton
        @click.native="deleteItem"
        :class="{'opacity-25':form.processing}"
        :disabled="form.processing">
          Delete
      </DangerButton>
    </template>
  </JetConfirmationModal>
  </div>
</template>

<script>
//import Button from '@/Jetstream/Button.vue'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue'
import SecondaryButton from '@/Jetstream/SecondaryButton'
import DangerButton from '@/Jetstream/DangerButton'
export default {
    props:{
        url:{
            type:String,
            require:true
        },
        moduleName:{
          type:String,
          require:true,
        }
    },
    components:{
      JetConfirmationModal,
      SecondaryButton,
      DangerButton,

    },
    data(){
      return{
        show:false,
        form: this.$inertia.form({

        })
      }
    },
    methods:{

      deleteItem(){
       this.form.delete(this.url);
       this.show=false;
      }
    }


}
</script>

<style>

</style>