<template>
    <jet-form-section @submitted="updateContactInformation">
        <template #title>
        Contact Us Information
        </template>

        <template #description>
            Update the contact data.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <AppImage :image-url="settings.data.contact_image_url" label="Photo" :error-message="form.errors.photo"
                v-model="form.contact_image"/>
            <!-- Current Profile Photo -->
            </div>
               <!-- Name -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="name" value="Name" />
                <jet-input id="name" type="text" class="mt-1 block w-3/4" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>
               <!-- Address -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="address" value="Address" />
                <jet-input id="address" type="text" class="mt-1 block w-3/4" v-model="form.address" autocomplete="address" />
                <jet-input-error :message="form.errors.address" class="mt-2" />
            </div>
               <!-- Phone -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="phone" value="Phone" />
                <jet-input id="phone" type="text" class="mt-1 block w-1/2" v-model="form.phone" autocomplete="phone" />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>
               <!-- Email -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-1/2" v-model="form.email" autocomplete="email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
            <!-- Google map -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="google_map_url" value="google_map_url" />
                <AppTextarea id="google_map_url" type="text" class="mt-1 block w-full" v-model="form.google_map_url" autocomplete="google_map_url"/>
               <!--  <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" /> -->
                <jet-input-error :message="form.errors.google_map_url" class="mt-2" />
            </div> 

         
           
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
                    google_map_url: this.settings.data.google_map_url,
                    contact_image: this.settings.data.contact_image,
                    address: this.settings.data.address,
                    phone: this.settings.data.phone,
                    email: this.settings.data.email,
                    name:  this.settings.data.name,
                },{
                    resetOnSuccess:false,
                }
                ),

               // photoPreview: null,
            }
        },

        methods: {
            updateContactInformation() {
                // if (this.$refs.photo) {
                //     this.form.hero_image = this.$refs.photo.files[0]
                // }

                this.form.post(route('setting.contact'), {
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
