<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="layout-container">
        <div>
            <Link href="/">
                <ApplicationLogo class="logo" />
            </Link>
        </div>

        <div class="content-wrapper">
            <slot />
        </div>
    </div>
</template>

<style scoped>
.layout-container {
    display: flex;
    padding-top: 1.5rem;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    background-color: #f3f4f6;
}
@media (min-width: 640px) {
    .layout-container {
        padding-top: 0;
        justify-content: center;
    }
}
.logo {
    width: 5rem;
    height: 5rem;
    color: #6b7280;
    color: currentColor;
}
.content-wrapper {
    overflow: hidden;
    padding-top: 1rem;
    padding-bottom: 1rem;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    margin-top: 1.5rem;
    width: 100%;
    background-color: #ffffff;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
@media (min-width: 640px) {
    .content-wrapper {
        border-radius: 0.5rem;
        max-width: 28rem;
    }
}
</style>
