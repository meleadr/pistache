<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    isStyled: {
        type: Boolean,
        default: true,
    },
});

const classes = computed(() => {
    if (!props.isStyled) {
        return "";
    }

    return props.active
        ? "inline-flex items-center px-1 pt-1 border-b-2 border-amber-400 text-lg font-medium leading-5 text-gray-900 focus:outline-none focus:border-amber-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-amber-300 focus:outline-none focus:text-gray-700 focus:border-amber-300 transition duration-150 ease-in-out";
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
