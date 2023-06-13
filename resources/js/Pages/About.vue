<script setup>
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";

// About data
const aboutText =
    "Pistache est un restaurant unique qui mêle les saveurs de la France et de la Méditerranée. Notre mission est de vous faire vivre une expérience culinaire inoubliable, tout en partageant notre passion pour l'art de la gastronomie. Que vous cherchiez un endroit pour un dîner romantique, une réunion d'affaires, ou un repas en famille, Pistache est l'endroit idéal.";

// Gallery data
const galleryImages = [
    "/img/repas1.webp",
    "/img/repas2.jpg",
    "/img/repas3.jpg",
    "/img/repas4.jpg",
];

// Team data
const teamMembers = [
    { name: "Jean Dupont", role: "Chef", image: "/img/chef.jpg" },
    { name: "Marie Leblanc", role: "Sommelière", image: "/img/sommelier.jpg" },
];

// Building data
const buildingImage = "/img/edifice.webp";
const buildingText =
    "Notre restaurant est situé dans un bel édifice historique en plein cœur de Paris. L'intérieur est décoré dans un style qui allie le charme traditionnel français et luxe.";
</script>

<template>
    <Head title="À propos de nous" />

    <WebsiteLayout class="m-10">
        <template #header>
            <h2 class="text-4xl text-center mb-10">À propos de nous</h2>
        </template>

        <!-- About Section -->
        <section class="about py-20">
            <p class="text-center">{{ aboutText }}</p>
        </section>

        <!-- Gallery Section -->
        <section class="gallery py-20 grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div v-for="(image, index) in galleryImages" :key="index">
                <img
                    :src="image"
                    :alt="`Gallerie image plat ${index + 1}`"
                    class="w-full"
                />
            </div>
        </section>

        <!-- Team Section -->
        <section class="team py-20">
            <h2 class="text-4xl text-center mb-10">Notre équipe</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-center">
                <div v-for="member in teamMembers" :key="member.name">
                    <img
                        :src="member.image"
                        :alt="`Image de ${member.name}`"
                        class="w-full"
                    />
                    <h3 class="text-xl">{{ member.name }}</h3>
                    <p>{{ member.role }}</p>
                </div>
            </div>
        </section>

        <!-- Building Section -->
        <section class="building py-20">
            <h2 class="text-4xl text-center mb-10">Notre édifice</h2>
            <div
                class="flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-6 text-center"
            >
                <img
                    :src="buildingImage"
                    alt="Image de notre édifice"
                    class="w-full sm:w-1/2"
                />
                <p class="sm:w-1/2">{{ buildingText }}</p>
            </div>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
