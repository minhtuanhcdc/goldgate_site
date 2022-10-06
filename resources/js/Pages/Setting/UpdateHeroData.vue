<template>
    <jet-form-section @submitted="updateHeroInformation">
        <template #title>
        Hero Information
        </template>

        <template #description>
            Update the hero section data.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <AppImage :image-url="settings.data.hero_image_url" label="Photo" :error-message="form.errors.photo"
                v-model="form.hero_image"/>
            <!-- Current Profile Photo -->
            </div>

            <!-- Description -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="description" value="Description" />
                <AppTextarea id="description" type="text" class="mt-1 block w-full" v-model="form.hero_description" autocomplete="description"/>
               <!--  <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" /> -->
                <jet-input-error :message="form.errors.hero_description" class="mt-2" />
            </div> 

            <!-- Email -->
           
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetFormSection from '@/Jetstream/FormSection.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetInputError from '@/Jetstream/InputError.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetActionMessage from '@/Jetstream/ActionMessage.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import AppTextarea from '@/Components/Textarea'

    import AppImage from '@/Components/Image'

    export default defineComponent({
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            AppTextarea,
            
            AppImage,
        },

        props: ['settings'],

        data() {
            return {
                form: this.$inertia.form({
                    //_method: 'PUT',
                    hero_description: this.settings.data.hero_description,
                    hero_image: null,
                },{
                    resetOnSuccess:false,
                }
                ),

               // photoPreview: null,
            }
        },

        methods: {
            updateHeroInformation() {
                // if (this.$refs.photo) {
                //     this.form.hero_image = this.$refs.photo.files[0]
                // }

                this.form.post(route('setting.store'), {
                    errorBag: 'updateHeroInformation',
                    preserveScroll: true,
                    onSuccess: () => (this.clearPhotoFileInput()),
                });
            },

           

         

            /*deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.photoPreview = null;
                        this.clearPhotoFileInput();
                    },
                });
            },*/

            clearPhotoFileInput() {
                if (this.$refs.photo?.value) {
                    this.$refs.photo.value = null;
                }
            },
        },
    })
</script>
