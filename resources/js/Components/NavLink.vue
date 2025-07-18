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
});

const activeClass = computed(() => (props.active ? "active" : ""));
</script>

<template>
    <Link :href="href" :class="activeClass" class="nav-link">
        <slot />
    </Link>
</template>

<style lang="css">
a.nav-link {
    color: var(--gray);
    position: relative;
    cursor: pointer;
}
a.nav-link.active > * {
    color: var(--blue) !important;
}
a.nav-link.active::after {
    content: "";
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background-color: var(--blue);
    border-radius: 8px 8px 0 0;
}
@media (min-width: 700px) {
    a.nav-link.active::after {
        bottom: -25px;
    }
}
</style>
