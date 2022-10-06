<template>
    <jet-form-section @submitted="updateHeroInformation">
        <template #title>
       About us Information
        </template>

        <template #description>
            Update about us data.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <AppImage :image-url="settings.data.about_image_url" label="Photo" :error-message="form.errors.photo"
                v-model="form.about_image"/>
            <!-- Current Profile Photo -->
            </div>

            <!-- Description -->
             <div class="col-span-6 sm:col-span-12">
                <jet-label for="description" value="Description123" />
                 <ckeditor :editor="editor" v-model="form.about_description" :config="editorConfig"></ckeditor>
                <!-- <AppTextarea id="description" type="text" class="mt-1 block w-full" v-model="form.about_description" autocomplete="description"/> -->
               <!--  <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" /> -->
                <jet-input-error :message="form.errors.about_description" class="mt-2" />
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
            ClassicEditor,
        },

        props: ['settings'],

        data() {
            return {
                form: this.$inertia.form({
                    //_method: 'PUT',
                   about_description: this.settings.data.about_description,
                    about_image: null,
                },{
                    resetOnSuccess:false,
                }
                ),
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                }

               // photoPreview: null,
            }
        },

        methods: {
            updateHeroInformation() {
                // if (this.$refs.photo) {
                //     this.form.hero_image = this.$refs.photo.files[0]
                // }
                this.form.post(route('setting.about'), {
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
