<script setup>
import MiniSidebar from "@/Components/MiniSidebar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Tweet from "@/Components/Tweet.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const props = defineProps({ user: Object, follows: Boolean });

const logedUserSidebarOptoins = [
    {
        name: "Tweets",
        link: `/profile/@${props.user.username}?tab=tweets`,
        isActive: window.location.search.split("=")[1]?.startsWith("tweets"),
    },
    {
        name: "Retweetes",
        link: `/profile/@${props.user.username}?tab=retweets`,
        isActive: window.location.search.includes("retweets"),
    },
    {
        name: "Likes",
        link: `/profile/@${props.user.username}?tab=likes`,
        isActive: window.location.search.includes("likes"),
    },
    {
        name: "Saves",
        link: `/profile/@${props.user.username}?tab=saves`,
        isActive: window.location.search.includes("saves"),
    },
];

const sidebarOptoins = [
    { name: "Tweets", link: `/profile/@${props.user.username}?tab=tweets` },
    { name: "Media", link: `/profile/@${props.user.username}?tab=media` },
];

const form = useForm({});

function followUser() {
    form.post(`/follow/${props.user.id}`, {
        preserveScroll: true,
    });
}

function unfollowUser() {
    form.post(`/unfollow/${props.user.id}`, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head :title="user.name" />

    <section class="profile-details">
        <img src="@/images/banner.jpeg" alt="banner" class="profile-banner" />

        <div class="profile-data-container">
            <div class="profile-img-container">
                <img :src="user.image" alt="profile picture" />
            </div>

            <div class="profile-data">
                <h3 class="profile-name">
                    {{ user.name }}
                </h3>

                <div class="profile-follwing-followers">
                    <p v-html="user.followers_count"></p>
                    <p v-html="user.followings_count"></p>
                </div>

                <p class="profile-description">
                    {{ user.bio }}
                </p>

                <form
                    @submit.prevent="followUser"
                    class="follow-unfollow-form"
                    v-if="!follows"
                >
                    <PrimaryButton
                        :disabled="form.processing"
                        v-if="
                            $page.props.isLoggedIn &&
                            $page.props.auth.user.id !== user.id
                        "
                    >
                        <font-awesome-icon icon="fa-solid fa-user-plus" />
                        <span>Follow</span>
                    </PrimaryButton>
                </form>

                <form
                    @submit.prevent="unfollowUser"
                    class="follow-unfollow-form"
                    v-else
                >
                    <PrimaryButton
                        :disabled="form.processing"
                        class="unfollow-btn"
                        v-if="
                            $page.props.isLoggedIn &&
                            $page.props.auth.user.id !== user.id
                        "
                    >
                        <font-awesome-icon icon="fa-solid fa-user-minus" />
                        <span>Unfollow</span>
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </section>

    <section class="tweets">
        <MiniSidebar
            :options="sidebarOptoins"
            class="sidebar"
            v-if="$page.props.auth.user.id !== user.id"
        />

        <MiniSidebar
            :options="logedUserSidebarOptoins"
            class="sidebar"
            v-else
        />

        <div class="profile-content-container">
            <div v-for="tweet in user.tweets" :key="tweet.id">
                <Tweet :tweet="tweet" />
            </div>
        </div>
    </section>
</template>

<style lang="css" scoped>
.profile-banner {
    width: 100%;
    height: 170px;
    object-fit: cover;
}
@media (min-width: 700px) {
    .profile-banner {
        height: 300px;
    }
}
.profile-data-container {
    position: relative;
    bottom: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;
    row-gap: 15px;
    background-color: var(--white);
    border-radius: 12px;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    margin-inline: 20px;
    padding: 10px;
}
@media (min-width: 700px) {
    .profile-data-container {
        flex-direction: row;
        margin-inline: 15vw;
        padding-inline: 20px;
    }
}
.profile-img-container {
    width: 120px;
    aspect-ratio: 1;
    border-radius: 8px;
    background-color: var(--white);
    padding: 3px;
    position: relative;
    bottom: 45px;
}
@media (min-width: 700px) {
    .profile-img-container {
        width: 152px;
        bottom: 65px;
    }
}
.profile-img-container img {
    width: 100%;
    aspect-ratio: 1;
    display: block;
    border-radius: 8px;
}
.profile-data {
    display: grid;
    grid-template-rows: repeat(4, auto);
    justify-items: center;
    text-align: center;
    margin-top: -45px;
}
@media (min-width: 700px) {
    .profile-data {
        grid-template-rows: repeat(2, auto);
        grid-template-columns: auto auto 1fr;
        margin-left: 20px;
        margin-block: 20px;
        width: 100%;
        align-items: center;
        row-gap: 23px;
    }
}
.profile-name {
    color: var(--Gray-1, #333);
    font-size: 24px;
    font-weight: 600;
    letter-spacing: -0.84px;
    margin: 0;
}
@media (max-width: 800px) and (min-width: 700px) {
    .profile-name {
        margin-left: 10px;
    }
}
.profile-follwing-followers {
    color: var(--gray);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
}
@media (min-width: 700px) {
    .profile-follwing-followers > p {
        display: inline;
    }
    .profile-follwing-followers > p:first-of-type {
        margin-right: 15px;
        margin-left: 25px;
    }
}

@media (max-width: 800px) and (min-width: 700px) {
    .profile-follwing-followers > p {
        display: block;
        margin-left: 15px !important;
    }
    .profile-follwing-followers > p:first-of-type {
        margin-right: 0;
    }
}

.profile-description {
    color: var(--gray);
    font-family: var(--noto-font);
    font-size: 18px;
    font-weight: 500;
    letter-spacing: -0.63px;
    margin-block-start: 15px;
    margin-block-end: 25px;
}
@media (min-width: 700px) {
    .profile-description {
        margin: 0;
        grid-area: 2 / span 3;
        justify-self: left;
    }
}

@media (min-width: 700px) {
    .follow-unfollow-form {
        justify-self: end;
    }
}
.unfollow-btn {
    background-color: #eb5757;
}
.fa-user-plus,
.fa-user-minus {
    margin-right: 5px;
    width: 14px;
    height: 14px;
    color: white;
}
.tweets {
    margin-inline: 20px;
}
.profile-content-container {
    display: flex;
    flex-direction: column;
    row-gap: 25px;
}
@media (min-width: 700px) {
    .tweets {
        display: flex;
        column-gap: 25px;
        margin-inline: 15vw;
    }
    .sidebar {
        width: 25%;
    }
    .profile-content-container {
        width: 75%;
    }
}
</style>

<style>
.profile-follwing-followers p span {
    font-weight: 600;
    color: #333;
}
</style>
