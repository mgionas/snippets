<script setup>
  import adminLayout from '@/Layouts/AdminLayout.vue'
  import { ref, computed } from 'vue'
  import { Head, useForm } from '@inertiajs/vue3';
  import { CheckIcon, ChevronUpDownIcon, ChevronDownIcon } from '@heroicons/vue/20/solid'
  import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
  import Editor from '@tinymce/tinymce-vue'


  const props = defineProps({
      vendors:Object
  })
  
  const publishingOptions = [
    { title: 'Published', description: 'This job posting can be viewed by anyone who has the link.', id: 1, current: true },
    { title: 'Draft', description: 'This job posting will no longer be publicly accessible.', id: 2, current: false },
  ]


  const selectedVendor = ref(props.vendors[0]);
  
  const selectedStatus = ref(publishingOptions[0])

  const form = useForm({
      title: null,
      description: null,
      vendor: computed(() => selectedVendor.value.id),
      publishStatus: computed(() => selectedStatus.value.id),
  })

  const createVendor = () => {
      form.post('/admin/snippets', {
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
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add snippet</h2>
                <div class="w-full border-t border-gray-300 mt-6" />

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                        <input v-model="form.title" type="text" name="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Snippet title" />
                        </div>
                    </div>
                    <Listbox as="div" v-model="selectedVendor" class="sm:col-span-2">
                      <ListboxLabel class="block text-sm font-medium leading-6 text-gray-900">Vendor</ListboxLabel>
                      <div class="relative mt-2">
                        <ListboxButton class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6">
                          <span class="flex items-center">
                            <img :src="`/storage/` + selectedVendor.img" alt="" class="h-5 w-5 flex-shrink-0 rounded-full" />
                            <span class="ml-3 block truncate">{{ selectedVendor.title }}</span>
                          </span>
                          <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                          </span>
                        </ListboxButton>

                        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                          <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="vendor in vendors" :key="vendor.id" :value="vendor" v-slot="{ active, selectedVendor }">
                              <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                <div class="flex items-center">
                                  <img :src="`/storage/` + vendor.img" alt="" class="h-5 w-5 flex-shrink-0 rounded-full" />
                                  <span :class="[selectedVendor ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">{{ vendor.title }}</span>
                                </div>

                                <span v-if="selectedVendor" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                </span>
                              </li>
                            </ListboxOption>
                          </ListboxOptions>
                        </transition>
                      </div>
                    </Listbox>

                    <Listbox as="div" v-model="selectedStatus" class="sm:col-span-2 place-self-end">
                      <ListboxLabel class="sr-only">Change published status</ListboxLabel>
                      <div class="relative">
                        <div class="inline-flex divide-x divide-indigo-700 rounded-md shadow-sm">
                          <div class="inline-flex items-center gap-x-1.5 rounded-l-md bg-indigo-600 px-3 py-2 text-white shadow-sm">
                            <CheckIcon class="-ml-0.5 h-5 w-5" aria-hidden="true" />
                            <p class="text-sm font-semibold">{{ selectedStatus.title }}</p>
                          </div>
                          <ListboxButton class="inline-flex items-center rounded-l-none rounded-r-md bg-indigo-600 p-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:ring-offset-gray-50">
                            <span class="sr-only">Change published status</span>
                            <ChevronDownIcon class="h-5 w-5 text-white" aria-hidden="true" />
                          </ListboxButton>
                        </div>

                        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                          <ListboxOptions class="absolute right-0 z-10 mt-2 w-72 origin-top-right divide-y divide-gray-200 overflow-hidden rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <ListboxOption as="template" v-for="option in publishingOptions" :key="option.title" :value="option" v-slot="{ active, selectedStatus }">
                              <li :class="[active ? 'bg-indigo-600 text-white' : 'text-gray-900', 'cursor-default select-none p-4 text-sm']">
                                <div class="flex flex-col">
                                  <div class="flex justify-between">
                                    <p :class="selectedStatus ? 'font-semibold' : 'font-normal'">{{ option.title }}</p>
                                    <span v-if="selectedStatus" :class="active ? 'text-white' : 'text-indigo-600'">
                                      <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                    </span>
                                  </div>
                                  <p :class="[active ? 'text-indigo-200' : 'text-gray-500', 'mt-2']">{{ option.description }}</p>
                                </div>
                              </li>
                            </ListboxOption>
                          </ListboxOptions>
                        </transition>
                      </div>
                    </Listbox>

                

                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <Editor
                        v-model="form.description"
                        api-key="gbhfv1qinvis0h3rx8ks9y0osdv0vfdsrsbfr3418odtzyx9"
                        :init="{
                            menubar: false,
                            plugins: 'lists link image table code help wordcount codesample',
                            toolbar: 'bold italic codesample backcolor | \ alignleft aligncenter alignright alignjustify | \ bullist | removeformat a11ycheck code'
                        }"
                        />
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
