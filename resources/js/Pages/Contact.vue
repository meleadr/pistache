<script setup>
import { Head } from "@inertiajs/vue3";
import WebsiteLayout from "@/Layouts/WebsiteLayout.vue";

// Contact information data
const contactInformation = {
    phone: "+33 1 23 45 67 89",
    email: "contact@pistache.com",
    address: "123 Rue de la Gastronomie, 75001 Paris, France",
    openingHours: "Ouvert tous les jours de 12h00 à 23h00",
};
</script>

<template>
    <Head title="Contactez-nous" />

    <WebsiteLayout class="mb-10 ml-10 mr-10">
        <template #header>
            <h2 class="mb-10 text-center text-4xl">Nous Contacter</h2>
        </template>
        <!-- Contact Information Section -->
        <section class="contact-info py-20">
            <div class="grid grid-cols-1 gap-6 text-center sm:grid-cols-2">
                <div>
                    <p class="text-xl">Adresse</p>
                    <p class="text-xl">{{ contactInformation.address }}</p>
                    <p class="text-xl">Horaires</p>
                    <p class="text-xl">{{ contactInformation.openingHours }}</p>
                </div>
                <div>
                    <p class="text-xl">Téléphone</p>
                    <p class="text-xl">{{ contactInformation.phone }}</p>
                    <p class="text-xl">Email</p>
                    <p class="text-xl">{{ contactInformation.email }}</p>
                </div>
            </div>
        </section>

        <!-- Google Map Section -->
        <section class="map w-full">
            <div class="h-80">
                <iframe
                    class="h-full w-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.761666666667!2d2.336761315674781!3d48.86272597928894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x4b9b0c1b0c0b0b0!2sPistache!5e0!3m2!1sfr!2sfr!4v1623349129129!5m2!1sfr!2sfr"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                ></iframe>
            </div>
        </section>
    </WebsiteLayout>
</template>

<style scoped></style>

<style scoped></style>
