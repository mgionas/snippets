<script setup>
    import adminLayout from '@/Layouts/AdminLayout.vue'
    import { Head, Link } from '@inertiajs/vue3';
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { EllipsisVerticalIcon, BarsArrowUpIcon, ChevronDownIcon, MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
    import { onMounted } from 'vue';

    const props = defineProps({
        snippets:Object
    })

    // import Prism and its components 

    import Prism from "prismjs";
    import "prismjs/themes/prism-okaidia.css";

    // Import Toolbar plugin and its CSS
    import 'prismjs/plugins/toolbar/prism-toolbar';
    //import '@/css/prismCustom.css';
    // Import Copy to clipboard Plugin
    import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard';
    // Import Show Language Plugin
    import 'prismjs/plugins/show-language/prism-show-language';
    // Import Line numbers Plugin
    import 'prismjs/plugins/line-numbers/prism-line-numbers';
    import 'prismjs/plugins/line-numbers/prism-line-numbers.css';

    onMounted(() => {
        Prism.highlightAll();
    });

    // end Prism

</script>
<template>
    <Head title="Snippets" />

    <adminLayout>

        <!-- header -->
        <div class="border-b border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Snippets</h3>
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
                <Link :href="route('snippets.create')" type="button" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add snippet</Link>
            </div>
        </div>

        <!-- list -->

        <TransitionGroup name="list" tag="ul">
            <li v-for="snippet in snippets" :key="snippet.id" class="flex items-center justify-between gap-x-6 py-5">
                <div class="w-full" >
                    <div class="flex items-start gap-x-3">
                        <Link :href="route('snippets.edit',snippet.id)" class="text-md font-semibold leading-6 text-gray-900">{{ snippet.title }}</Link>
                        <p v-if="snippet.statusId == 1" class="text-green-700 bg-green-50 ring-green-600/20 rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset">published</p>
                        <p v-else class="text-yellow-800 bg-yellow-50 ring-yellow-600/20 rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset">draft</p>
                    </div>
                    <div class="">
                        <div class="line-numbers" v-html="snippet.description"></div>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                        <p class="flex gap-2 justify-center items-center">
                            <img :src="'/storage/' + snippet.vendor.img" class="h-4 w-4">
                            <time :datetime="snippet.dueDateTime">{{ snippet.vendorTitle }}</time>
                        </p>
                        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                            <circle cx="1" cy="1" r="1" />
                        </svg>
                        <div class="flex items-center gap-2" v-if="snippet.instruction">
                            <p class="truncate"><Link :href="route('instructions.edit', snippet.instruction.id)" class="">{{ snippet.instruction.title }}</Link></p>
                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                <circle cx="1" cy="1" r="1" />
                            </svg>
                        </div>
                        <p class="truncate">Created by <Link :href="route('profile.edit',snippet.author.authorId)" class="">{{ snippet.author.name }}</Link></p>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                    <Menu as="div" class="relative flex-none">
                        <MenuButton class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900">
                            <span class="sr-only">Open options</span>
                            <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                        </MenuButton>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                            <MenuItem v-slot="{ active }">
                                <Link :href="route('snippets.edit',[snippet.id])" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']"
                                >Edit<span class="sr-only"></span></Link
                                >
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <Link :href="route('snippets.destroy',[snippet.id])" method="DELETE" as="button" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']" preserve-scroll
                                >Delete<span class="sr-only"></span></Link
                                >
                            </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </li>
        </TransitionGroup>
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
    }
</style>
