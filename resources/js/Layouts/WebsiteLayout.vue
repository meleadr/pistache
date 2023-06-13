<script setup>
import NavigationMenu from "@/Components/NavigationMenu.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <NavigationMenu />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main
                class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100"
            >
                <div
                    class="w-full bg-white shadow-md overflow-hidden sm:rounded-lg"
                >
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
