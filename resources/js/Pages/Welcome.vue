<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import NavLink from "@/Components/NavLink.vue";

// Hero data
const heroImage = ref("/img/hero.jpg");
const heroTitle = ref("Bienvenue chez Pistache");

// About data
const aboutText = ref(
    "Bienvenue chez Pistache, l'oasis gastronomique où la France embrasse la Méditerranée. Chez nous, chaque plat est une célébration des saveurs, alliant la sophistication de la cuisine française à la chaleur de la Méditerranée. Nous mettons l'accent sur des ingrédients de qualité supérieure, des techniques culinaires raffinées et une véritable passion pour la gastronomie. Dès l'instant où vous franchissez notre porte, vous êtes invité à vivre une expérience culinaire inoubliable. Découvrez l'ambiance chaleureuse, savourez des plats exceptionnels et partagez notre amour pour la cuisine franco-méditerranéenne chez Pistache."
);

// Inspiration data
const inspirationImages = ref([
    "/img/repas1.webp",
    "/img/repas3.jpg",
    "/img/repas2.jpg",
]);
</script>

<template>
    <Head title="Accueil" />

    <WebsiteLayout>
        <!-- Section Banner / Hero -->
        <section
            class="hero bg-center bg-cover h-screen flex items-center justify-center"
            :style="{ 'background-image': `url(${heroImage})` }"
        >
            <div
                class="hero-content text-white text-center flex flex-col items-center"
            >
                <h1 class="text-5xl mb-8">{{ heroTitle }}</h1>

                <!-- Call to Action button -->
                <NavLink
                    :href="route('menu')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Découvrez notre menu
                </NavLink>
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
            <NavLink
                :href="route('contact')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Contactez-nous
            </NavLink>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
