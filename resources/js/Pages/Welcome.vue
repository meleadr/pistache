<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";

// Hero data
const heroImage = ref("/img/hero.jpg");
const heroTitle = ref("Bienvenue sur notre site");

// About data
const aboutText = ref("Ceci est un texte à propos de nous.");

// Inspiration data
const inspirationImages = ref([
    "/path/to/image1.jpg",
    "/path/to/image2.jpg",
    "/path/to/image3.jpg",
]);
</script>

<template>
    <Head title="Welcome" />

    <WebsiteLayout>
        <!-- Section Banner / Hero -->
        <section
            class="hero bg-center bg-cover h-screen flex items-center justify-center"
            :style="{ 'background-image': `url(${heroImage})` }"
        >
            <div class="hero-content text-white text-center">
                <h1 class="text-5xl">{{ heroTitle }}</h1>
            </div>
        </section>

        <!-- Section À propos -->
        <section class="about py-20">
            <h2 class="text-4xl text-center mb-10">Notre histoire</h2>
            <p class="text-center">{{ aboutText }}</p>
        </section>

        <!-- Section Photos d'inspirations -->
        <section class="inspiration py-20 grid grid-cols-3 gap-4">
            <div v-for="(image, index) in inspirationImages" :key="index">
                <img
                    :src="image"
                    :alt="`Inspiration image ${index + 1}`"
                    class="w-full"
                />
            </div>
        </section>

        <!-- Section Call To Action -->
        <section class="cta py-20 text-center">
            <router-link
                to="/contact"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Contactez-nous
            </router-link>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
