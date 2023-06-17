<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

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
            class="hero flex h-screen items-center justify-center bg-cover bg-center"
            :style="{ 'background-image': `url(${heroImage})` }"
        >
            <div
                class="hero-content flex flex-col items-center text-center text-white"
            >
                <h1 class="mb-8 text-5xl">{{ heroTitle }}</h1>

                <!-- Call to Action button -->
                <PrimaryButton>
                    <NavLink :href="route('menu')" :isStyled="false">
                        Découvrez notre menu
                    </NavLink>
                </PrimaryButton>
            </div>
        </section>

        <!-- Section À propos -->
        <section class="about py-20">
            <h2 class="mb-10 text-center text-4xl">Notre histoire</h2>
            <p class="text-center">{{ aboutText }}</p>
        </section>

        <!-- Section Photos d'inspirations -->
        <section class="inspiration grid grid-cols-3 gap-4 py-20">
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
            <PrimaryButton>
                <NavLink :href="route('contact')" :isStyled="false">
                    Contactez-nous
                </NavLink>
            </PrimaryButton>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
