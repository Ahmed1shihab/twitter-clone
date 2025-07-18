<script setup>
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Tweet from "@/Components/Tweet.vue";
import MiniSidebar from "@/Components/MiniSidebar.vue";

defineProps({ tweets: Object });

const sidebarOptions = [
    { name: "top", link: "/" },
    { name: "lastest", link: "/" },
    { name: "people", link: "/" },
    { name: "media", link: "/" },
];
</script>

<template>
    <Head title="Explore" />

    <div class="content-wrapper">
        <section class="main-content">
            <!-- <div class="search-container">
                <font-awesome-icon
                    icon="fa-solid fa-magnifying-glass"
                    class="search-ic"
                />
                <input type="search" name="" id="" placeholder="Search" />
                <PrimaryButton>Search</PrimaryButton>
            </div> -->

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
}

.main-content {
    display: flex;
    flex-direction: column;
    row-gap: 20px;
}
@media (min-width: 700px) {
    .main-content {
        width: 80%;
    }
    .sidebar {
        width: 30%;
    }
}
.main-content .search-container {
    display: flex;
    align-items: center;
    position: relative;
    width: 100%;
    height: 54px;
    background-color: var(--white);
    border-radius: 8px;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    padding: 10px;
}
.main-content .search-container input {
    width: 100%;
    height: 100%;
    text-indent: 20px;
    margin-right: 5px;
}
.main-content .search-container .search-ic {
    position: absolute;
    left: 8px;
}
</style>
