<template>
    <nav class="border-b border-gray-100 bg-white">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center">
                        <Link href="/">
                            <ApplicationLogo
                                class="h-15 block w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink
                            :href="route('menu')"
                            :active="route().current('menu')"
                            >Menus</NavLink
                        >
                        <NavLink
                            :href="route('about')"
                            :active="route().current('about')"
                            >A propos</NavLink
                        >
                        <NavLink
                            :href="route('contact')"
                            :active="route().current('contact')"
                            >Contact</NavLink
                        >
                    </div>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- Hamburger button code goes here -->
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <!-- Responsive links code goes here -->
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";

const showingNavigationDropdown = ref(false);
</script>
