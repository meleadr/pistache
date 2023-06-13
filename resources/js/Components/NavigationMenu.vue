<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link href="/">
                            <ApplicationLogo
                                class="block h-10 w-auto fill-current text-gray-800"
                            />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                            >Menu</NavLink
                        >
                        <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                            >A propos</NavLink
                        >
                        <NavLink
                            :href="route('dashboard')"
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
