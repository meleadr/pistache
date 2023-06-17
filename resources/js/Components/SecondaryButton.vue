<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <button
        :type="type"
        class="focus:ring-purple -500 inline-flex items-center rounded-md border border-purple-300 bg-purple-700 px-4 py-2 text-base font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-25"
    >
        <slot />
    </button>
</template>
