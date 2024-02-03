<script setup>
    import adminLayout from '@/Layouts/AdminLayout.vue'
    import { Head, Link } from '@inertiajs/vue3';
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { EnvelopeIcon, PhoneIcon, BarsArrowUpIcon, ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'

    const props = defineProps({
        vendors:Object
    })

    const people = [
    {
        name: 'Jane Cooper',
        title: 'Paradigm Representative',
        role: 'Admin',
        email: 'janecooper@example.com',
        telephone: '+1-202-555-0170',
        imageUrl:
        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60',
    },
    // More people...
    ]

</script>
<template>
    <Head title="Vendors" />

    <adminLayout>
        <!-- header -->

        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Vendors</h3>
            <div class="flex gap-4 mt-3 sm:ml-4 sm:mt-0">
                <label for="mobile-search-candidate" class="sr-only">Search</label>
                <label for="desktop-search-candidate" class="sr-only">Search</label>
                <div class="flex rounded-md shadow-sm">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                        </div>
                        <input type="text" name="mobile-search-candidate" id="mobile-search-candidate" class="block w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:hidden" placeholder="Search" />
                        <input type="text" name="desktop-search-candidate" id="desktop-search-candidate" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search snippet" />
                    </div>
                    <button type="button" class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <BarsArrowUpIcon class="-ml-0.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                        Sort
                        <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true" />
                    </button>
                </div>
                <Link :href="route('vendors.create')" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add vendor</Link>
            </div>
        </div>


        <!-- list -->
        <ul role="list" class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <li v-for="vendor in vendors" :key="vendor.name" class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center border">
                <Link :href="route('vendors.edit',[`${vendor.id}`])" class="flex flex-1 flex-col p-8 hover:bg-gray-50">
                    <div class="flex mx-auto h-32 w-32 rounded-full bg-gray-100 justify-center items-center">
                        <img class="h-20 w-20" :src="`${'/storage/' + vendor.img}`" alt="" />
                    </div>
                    <dd class="text-xl text-gray-500 mt-6">{{ vendor.title }}</dd>
                    <h3 class="mt-6 text-sm font-medium text-gray-900" v-html="vendor.description"></h3>
                    <dl class="mt-1 flex flex-grow flex-col justify-between">

                    <dd class="mt-3">
                        <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">published</span>
                    </dd>
                    </dl>
                </Link>
            </li>
        </ul>
    </adminLayout>
</template>