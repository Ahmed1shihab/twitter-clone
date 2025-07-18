<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href" class="dorpdown-link">
        <slot />
    </Link>
</template>

<style lang="css" scoped>
.dorpdown-link {
    display: block;
    width: 100%;
    padding-inline: 16px;
    padding-block: 8px;
    text-align: left;
    font-size: 14px;
    line-height: 20px;
    color: rgb(55 65 81);
    border-radius: 5px;
    transition: background-color 200ms ease-out;
}
.dorpdown-link:hover {
    background-color: rgb(243 244 246);
}
.dorpdown-link:focus {
    background-color: rgb(243 244 246);
}
</style>
