<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Tweet from "@/Components/Tweet.vue";
import MiniSidebar from "@/Components/MiniSidebar.vue";

defineProps({ tweets: Object });
</script>

<template>
    <Head title="Bookmark" />

    <div class="content-wrapper">
        <section class="main-content">
            <div v-for="tweet in tweets" :key="tweet.id">
                <Tweet :tweet="tweet" />
            </div>
        </section>
    </div>
</template>

<style lang="css" scoped>
.content-wrapper {
    padding: var(--mobile-padding);
}

@media (min-width: 700px) {
    .content-wrapper {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        column-gap: 25px;
        margin: 25px 15vw;
        padding: 0;
    }
    .sidebar {
        width: 30%;
    }
    .main-content {
        width: 80%;
    }
}

.main-content {
    display: flex;
    flex-direction: column;
    row-gap: 20px;
}
</style>
