<template>
<div class="">
  <button title="Delete" @click.prevent="show=true">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 p-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
      </svg>
  </button>
  <JetConfirmationModal :show="show">
    <template #title>
      Delete {{moduleName}}
    </template>
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