<script setup>
    import { ref, reactive } from 'vue';
    import adminLayout from '@/Layouts/AdminLayout.vue';
    import { Head, router, useForm } from '@inertiajs/vue3';
    import { CheckIcon, ChevronUpDownIcon, PlusIcon, BookmarkSquareIcon } from '@heroicons/vue/20/solid';
    import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue';
    import Editor from '@tinymce/tinymce-vue';

    const props = defineProps({
        vendors: Array,
        instructions: Object
    });

    const publishingOptions = [
        { title: 'Published', description: 'This job posting can be viewed by anyone who has the link.', id: 1, current: true },
        { title: 'Draft', description: 'This job posting will no longer be publicly accessible.', id: 2, current: false },
    ];

    const snippets = reactive(props.instructions.snippets);

    const addForm = () => {
        snippets.push({
            title: '',
            description: '',
            vendorId: props.vendors[0]?.id,
            statusId: publishingOptions[0].id
        });
    };

    const instructions = useForm({
        title: props.instructions.title,
        description: props.instructions.description,
    })

    const submitForms = () => {
        router.put(`/admin/instructions/${props.instructions.id}`, {
            snippets,
            instruction:instructions
        });
    };

    const removeSnippet = (e) => {
        snippets.splice(e, 1)
    }

</script>

<template>
    <Head title="Snippets" />
    
    <adminLayout>
        <div class="mb-6">
            <form @submit.prevent="submitForms">
                <div class="">
                    <div class="">
                        <div class="w-full" />
                        
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            
                            <div class="sm:col-span-2">
                                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Instruction itle</label>
                                <div class="mt-2">
                                    <input v-model="instructions.title" type="text" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Instruction title" />
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Instruction description</label>
                                <Editor
                                v-model="instructions.description"
                                api-key="gbhfv1qinvis0h3rx8ks9y0osdv0vfdsrsbfr3418odtzyx9"
                                :init="{
                                    menubar: false,
                                    height: 200,
                                    plugins: 'lists link code wordcount codesample',
                                    toolbar: 'codesample | bold italic backcolor | \ bullist link'
                                }"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <ul role="list" class="divide-y">
            <div class="overflow-hidden bg-white border-2 border-dashed border-blue-200 sm:rounded-md">
                <TransitionGroup name="list" tag="ul" class="">
                    <li v-for="(snippetForm, index) in snippets" :key="index" class="px-4 py-4 sm:px-6 even:bg-gray-100 relative">
                        <div class="absolute text-[92px] font-black text-gray-200 -right-3 -top-2">
                            {{ index + 1 }}
                        </div>
                        
                        <form @submit.prevent="submitForms">
                            <div class="">
                                <div class="">
                                    <div class="w-full" />
                                    
                                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                        
                                        <div class="sm:col-span-2">
                                            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Snippet title</label>
                                            <div class="mt-2">
                                                <input v-model="snippetForm.title" type="text" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Snippet title" />
                                            </div>
                                        </div>
                                        
                                        <div class="sm:col-span-2">
                                            <Listbox v-model="snippetForm.vendorId" as="div" class="sm:col-span-2">
                                                <ListboxLabel class="block text-sm font-medium leading-6 text-gray-900">Vendor</ListboxLabel>
                                                <div class="relative mt-2">
                                                    <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                                                        <span class="flex items-center">
                                                            <img :src="`/storage/` + props.vendors.find(v => v.id === snippetForm.vendorId)?.img" alt="" class="h-5 w-5 flex-shrink-0 rounded-full" />
                                                            <span class="ml-3 block truncate">{{ props.vendors.find(v => v.id === snippetForm.vendorId)?.title }}</span>
                                                        </span>
                                                        <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                                        </span>
                                                    </ListboxButton>

                                                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                                        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                                            <ListboxOption as="template" v-for="vendor in props.vendors" :key="vendor.id" :value="vendor.id">
                                                                <li :class="['relative cursor-default select-none py-2 pl-3 pr-9']">
                                                                    <div class="flex items-center">
                                                                        <img :src="`/storage/` + vendor.img" alt="" class="h-5 w-5 flex-shrink-0 rounded-full" />
                                                                        <span class="ml-3 block truncate">{{ vendor.title }}</span>
                                                                    </div>
                                                                </li>
                                                            </ListboxOption>
                                                        </ListboxOptions>
                                                    </transition>
                                                </div>
                                            </Listbox>

                                        </div>
                                        <div class="sm:col-span-2 place-self-end z-[20]">
                                            <button @click="removeSnippet(index)" type="button" class="rounded-md bg-red-50/50 px-3.5 py-2.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100">Remove</button>
                                        </div>

                                        <div class="col-span-full">
                                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                            <Editor
                                            v-model="snippetForm.description"
                                            api-key="gbhfv1qinvis0h3rx8ks9y0osdv0vfdsrsbfr3418odtzyx9"
                                            :init="{
                                                menubar: false,
                                                height: 200,
                                                plugins: 'lists link code wordcount codesample',
                                                toolbar: 'codesample | bold italic backcolor | \ bullist link'
                                            }"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                </TransitionGroup>

            </div>
        </ul>
        <div class="flex justify-between">
            <div class="flex justify-center">
                <div @click="addForm" class="cursor-pointer bg-gray-300 px-8 py-4 mt-4 rounded flex items-center gap-2 text-gray-600 hover:bg-gray-400 hover:text-gray-50"><PlusIcon class="h-4"/>Add Snippet</div>
            </div>
            <div class="flex justify-center">
                <div @click="submitForms" class="cursor-pointer bg-green-300 px-8 py-4 mt-4 rounded flex items-center gap-2 text-green-600 hover:bg-green-400 hover:text-green-50"><BookmarkSquareIcon class="h-4"/>Save instruction</div>
            </div>
        </div>

        
    </adminLayout>
</template>

<style scoped>
    .list-enter-active,
    .list-leave-active {
    transition: all 0.5s ease;
    }
    .list-enter-from,
    .list-leave-to {
    opacity: 0;
    transform: translateY(-30px);
    }
</style>





