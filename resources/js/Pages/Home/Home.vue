<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import inputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Tweet from "@/Components/Tweet.vue";
import {
    faEarthAmericas,
    faUserGroup,
} from "@fortawesome/free-solid-svg-icons";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Sidebar from "./Partials/Sidebar.vue";

defineProps({ tweets: Object });

const form = useForm({
    tweetContent: "",
    whoCanReply: "Everyone can reply",
    image: "",
});

const replyIcon = ref("earth");
const uploadedFileName = ref(null);

function chageWhoCanReply(newValue) {
    form.whoCanReply = newValue;
    if (newValue === "Everyone can reply") {
        replyIcon.value = faEarthAmericas;
    } else {
        replyIcon.value = faUserGroup;
    }
}

function uploadFile(event) {
    form.image = event.target.files[0];
    uploadedFileName.value = event.target.files[0].name;
}

function submitForm() {
    form.post("/tweet", {
        onSuccess: () => {
            form.reset();
            uploadedFileName.value = null;
        },
    });
}
</script>

<template>
    <Head title="Home" />

    <div class="content-wrapper">
        <section class="main-content">
            <div class="quick-tweet" v-if="$page.props.isLoggedIn">
                <span class="tweet-st">Tweet something</span>

                <div class="tweet-contnet">
                    <img
                        :src="$page.props.auth.user.image"
                        alt="profile picture"
                    />
                    <textarea
                        v-model="form.tweetContent"
                        placeholder="What’s happening?"
                    ></textarea>
                </div>

                <div class="tweet-submit">
                    <!-- <div>
                        <label for="tweet-image" class="tweet-img-input-label">
                            <font-awesome-icon
                                icon="fa-regular fa-image"
                                class="image-ic"
                            />
                            <span
                                v-if="uploadedFileName"
                                class="uploaded-file-name"
                                >{{ uploadedFileName }}</span
                            >
                        </label>
                        <input
                            id="tweet-image"
                            type="file"
                            accept="image/*"
                            hidden="true"
                            @input="uploadFile"
                        />

                        <Dropdown align="left">
                            <template #trigger>
                                <div class="dropdown-trigger">
                                    <font-awesome-icon
                                        :icon="replyIcon"
                                        class="reply-privacy-ic"
                                    />
                                    <span class="privacy-status">{{
                                        form.whoCanReply
                                    }}</span>
                                </div>
                            </template>

                            <template #content>
                                <div class="dropdown-content">
                                    <p class="dropdown-title">Who can reply?</p>
                                    <p>Choose who can reply to this Tweet.</p>

                                    <button
                                        type="button"
                                        class="dropdown-option"
                                        @click="
                                            chageWhoCanReply(
                                                'Everyone can reply'
                                            )
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-earth-americas"
                                        />
                                        <span>Everyone</span>
                                    </button>

                                    <button
                                        type="button"
                                        class="dropdown-option"
                                        @click="
                                            chageWhoCanReply(
                                                'People you follow'
                                            )
                                        "
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-user-group"
                                        />
                                        <span>People you follow</span>
                                    </button>
                                </div>
                            </template>
                        </Dropdown>
                    </div> -->
                    <PrimaryButton
                        @click="submitForm"
                        :disabled="form.processing"
                        >Tweet</PrimaryButton
                    >
                </div>
                <inputError :message="$page.props.errors.tweetContent" />
            </div>

            <div v-for="tweet in tweets" :key="tweet.id">
                <Tweet :tweet="tweet" />
            </div>
        </section>

        <Sidebar class="sidebar" />
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
        margin: 25px 14vw;
        padding: 0;
    }
}

section.main-content {
    /* max-width: 745px; */
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    row-gap: 25px;
}
@media (min-width: 700px) {
    section.main-content {
        width: 70%;
    }
}
.quick-tweet {
    display: flex;
    flex-direction: column;
    /* max-width: 745px; */
    /* height: 161px; */
    background-color: var(--white);
    border-radius: 12px;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    padding: 11px 14px;
}
/* @media (min-width: 700px) {
    .quick-tweet {
        height: 155px;
    }
} */
.tweet-st {
    color: var(--dark-gray);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: -0.42px;
    border-bottom: 1px solid var(--light-gray);
    padding-bottom: 7px;
    margin-bottom: 9px;
}
.tweet-contnet {
    display: flex;
}
.tweet-contnet img {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    margin-right: 12px;
}
.tweet-contnet textarea {
    width: 100%;
    height: 50px;
    resize: none;
    font-family: var(--noto-font);
    font-size: 16px;
    font-weight: 500;
    letter-spacing: -0.56px;
    margin-bottom: 10px;
}
.tweet-contnet textarea:focus {
    outline: 1px auto var(--light-gray);
}
.tweet-submit {
    display: flex;
    justify-content: end;
    align-items: center;
}
.tweet-submit > div {
    display: flex;
    column-gap: 7px;
    color: var(--blue);
}
.tweet-submit .reply-privacy-ic {
    margin: 0 7px;
    color: var(--blue);
}
.tweet-img-input-label {
    display: flex;
    align-items: center;
    column-gap: 5px;
    cursor: pointer;
}
.tweet-submit .image-ic {
    color: var(--blue);
}
.uploaded-file-name {
    font-size: 10px;
}
.tweet-submit .privacy-status {
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
}
.dropdown-trigger {
    display: flex;
    align-items: center;
    cursor: pointer;
}
.dropdown-content {
    padding: 5px 10px;
}
.dropdown-option {
    display: flex;
    align-items: center;
    width: 100%;
    padding-inline: 16px;
    padding-block: 8px;
    text-align: left;
    font-size: 14px;
    line-height: 20px;
    color: rgb(55 65 81);
    border-radius: 5px;
    transition: background-color 200ms ease-out;
    cursor: pointer;
    border: none;
    background-color: transparent;
    margin-bottom: 5px;
}
.dropdown-option:hover {
    background-color: rgb(243 244 246);
}
.dropdown-option:focus {
    background-color: rgb(243 244 246);
}

.dropdown-option > svg {
    color: var(--black);
    margin-inline-end: 8px;
}
.dropdown-option > span {
    color: var(--dark-gray);
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
}
.dropdown-title {
    color: var(--dark-gray);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: -0.42px;
}
.dropdown-title + p {
    color: var(--gray);
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 400;
    letter-spacing: -0.42px;
    margin-bottom: 10px;
}
@media (min-width: 700px) {
    .sidebar {
        width: 30%;
    }
}
</style>
