<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Vous êtes connecté</div>
                </div>
            </div>
        </div>
        <!--Retour sur le siteweb-->
        <div class="mt-4 flex items-center justify-center">
            <Link href="/">
                <PrimaryButton class="p-5 font-bold">
                    Retour sur le site
                </PrimaryButton>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
