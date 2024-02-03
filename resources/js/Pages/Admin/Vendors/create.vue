<script setup>
    import adminLayout from '@/Layouts/AdminLayout.vue'
    import { Head, useForm, router } from '@inertiajs/vue3';
    import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
    import Editor from '@tinymce/tinymce-vue'


    const form = useForm({
        name: null,
        url: null,
        description: null,
        publishStatus: null,
        icon: null
    })

    const createVendor = () => {
        router.post('/admin/vendors', {
            //_method: 'put',
            data: form,
            icon: form.icon,
            preserveScroll: true,
            onSuccess: () => form.reset('password'),
        })
    }



</script>

<template>
    <Head title="Snippets" />

    <adminLayout>
        <!-- header -->

        <form @submit.prevent="createVendor">
            <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add vendor</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">snippets.testtheweb.page/vendor/</span>
                            <input v-model="form.name" type="text" name="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="vue" />
                        </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                        <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                            <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">https://</span>
                            <input v-model="form.url" type="text" name="url" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="www.vue.com" />
                        </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                        <select v-model="form.publishStatus" name="status" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option>Published</option>
                            <option>pending</option>
                            <option>unpublish</option>
                        </select>
                        </div>
                    </div>
                

                    <div class="col-span-full">
                        <Editor
                        v-model="form.description"
                        api-key="gbhfv1qinvis0h3rx8ks9y0osdv0vfdsrsbfr3418odtzyx9"
                        :init="{
                            plugins: 'lists link image table code help wordcount codesample',
                            toolbar: 'undo redo | casechange blocks | bold italic backcolor | \ alignleft aligncenter alignright alignjustify | \ bullist numlst checklist outdent indent | removeformat | a11ycheck code table help | codesample'
                        }"
                        />
                    </div>
                    

                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Icon</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <PhotoIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input @input="form.icon = $event.target.files[0]" id="file-upload" name="file-upload" type="file" class="sr-only" />
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            </label>
                            <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </form>
    </adminLayout>
</template>