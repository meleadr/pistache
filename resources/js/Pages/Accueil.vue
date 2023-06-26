<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

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
            <article
                class="hero-content flex flex-col items-center text-center text-white"
            >
                <h1 class="mb-8 text-5xl">{{ heroTitle }}</h1>

                <!-- Call to Action button -->
                <PrimaryButton>
                    <NavLink :href="route('menu')" :isStyled="false">
                        Découvrez nos menus
                    </NavLink>
                </PrimaryButton>
            </article>
        </section>

        <!-- Section À propos -->
        <section class="about mx-auto w-8/12 py-10">
            <h2 class="mb-10 text-center text-4xl">Notre histoire</h2>
            <p class="text-center">{{ aboutText }}</p>
        </section>

        <!-- Section Photos d'inspirations -->
        <section class="inspiration grid grid-cols-1 gap-4 py-5 lg:grid-cols-3">
            <article class="aspect-w-2 aspect-h-1 col-span-1 lg:col-span-2">
                <img
                    :src="inspirationImages[0]"
                    :alt="`Inspiration image 1`"
                    class="h-full w-full object-cover"
                />
            </article>
            <article
                class="col-span-1 gap-4 lg:col-span-1 lg:grid lg:grid-rows-2"
            >
                <div class="aspect-w-1 aspect-h-1">
                    <img
                        :src="inspirationImages[1]"
                        :alt="`Inspiration image 2`"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="aspect-w-1 aspect-h-1">
                    <img
                        :src="inspirationImages[2]"
                        :alt="`Inspiration image 3`"
                        class="h-full w-full object-cover"
                    />
                </div>
            </article>
        </section>

        <!-- Section Call To Action -->
        <section class="cta bg-amber-500 py-20 text-center text-white">
            <h2 class="mb-6 text-4xl">Prêt à passer votre commande?</h2>
            <p class="mb-8 text-lg">
                Contactez-nous et nous serons ravis de vous aider.
            </p>
            <SecondaryButton>
                <NavLink :href="route('contact')" :isStyled="false">
                    Contactez-nous
                </NavLink>
            </SecondaryButton>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>
