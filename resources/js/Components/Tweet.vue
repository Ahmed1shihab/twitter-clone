<script setup>
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({ tweet: Object });

const form = useForm({
    comment: "",
});
function like() {
    form.post(`/like/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function unlike() {
    form.post(`/unlike/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function save() {
    form.post(`/save/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function unsave() {
    form.post(`/unsave/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function retweet() {
    form.post(`/retweet/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function unretweet() {
    form.post(`/unretweet/${props.tweet.id}`, {
        preserveScroll: true,
    });
}

function comment() {
    console.log(form.comment);

    form.post(`/comment/${props.tweet.id}`, {
        data: {
            comment: form.comment,
        },
        onSuccess: () => {
            form.reset("comment");
        },
        preserveScroll: true,
    });
}
</script>

<template>
    <div class="tweet-container">
        <div class="tweet-author">
            <Link
                :href="route('profile.index', tweet.user.username)"
                style="grid-row: span 2"
            >
                <img
                    :src="tweet.user.image"
                    alt="profile pic"
                    class="author-img"
                />
            </Link>

            <!-- <img :src="tweet.user.image" alt="profile pic" class="author-img" /> -->

            <Link
                class="author-name"
                :href="route('profile.index', tweet.user.username)"
            >
                {{ tweet.user.name }}
            </Link>
            <span class="tweet-date">{{ tweet.created_at }}</span>

            <Link
                v-if="
                    $page.props.isLoggedIn &&
                    $page.props.auth.user.id === tweet.user.id
                "
                :href="route('tweet.destroy', tweet.id)"
                method="delete"
                as="button"
                type="button"
                class="delete-btn"
                :preserve-scroll="true"
            >
                <font-awesome-icon icon="fa-solid fa-trash-can" />
            </Link>
        </div>
        <p class="tweet-content">
            {{ tweet.content }}
        </p>
        <img
            v-if="tweet.image"
            :src="tweet.image"
            alt="tweet image"
            class="tweet-image"
        />

        <div class="tweet-interaction-status">
            <span>{{ tweet.likes_count }}</span>
            <span>{{ tweet.comment_count }}</span>
            <span>{{ tweet.retweets_count }}</span>
            <span>{{ tweet.saves_count }}</span>
        </div>
        <hr />

        <div class="interaction-btns">
            <form @submit.prevent="like">
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon icon="fa-regular fa-message" />
                    <span class="hide">Comment</span>
                </button>
            </form>

            <!-- retweet -->

            <form @submit.prevent="retweet" v-if="!tweet.retweeted">
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon icon="fa-solid fa-repeat" />
                    <span class="hide">Retweet</span>
                </button>
            </form>

            <form @submit.prevent="unretweet" v-else>
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon
                        icon="fa-solid fa-repeat"
                        style="color: var(--blue)"
                    />
                    <span class="hide">Retweeted</span>
                </button>
            </form>

            <!-- Like -->

            <form @submit.prevent="like" v-if="!tweet.liked">
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon icon="fa-regular fa-heart" />
                    <span class="hide">Like</span>
                </button>
            </form>

            <form @submit.prevent="unlike" v-else>
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon
                        icon="fa-solid fa-heart"
                        style="color: red"
                    />
                    <span class="hide">Liked</span>
                </button>
            </form>

            <!-- save -->

            <form @submit.prevent="save" v-if="!tweet.saved">
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon icon="fa-regular fa-bookmark" />
                    <span class="hide">Save</span>
                </button>
            </form>

            <form @submit.prevent="unsave" v-else>
                <button type="submit" :disabled="form.processing">
                    <font-awesome-icon
                        icon="fa-solid fa-bookmark"
                        style="color: var(--blue)"
                    />
                    <span class="hide">Saved</span>
                </button>
            </form>
        </div>
        <hr />

        <div class="add-comment">
            <img
                :src="tweet.user.image"
                alt="profile pic"
                class="profile-img"
            />
            <textarea
                id="comment"
                placeholder="Tweet your reply"
                v-model="form.comment"
            ></textarea>
            <button
                class="comment-btn"
                @click="comment"
                :disabled="form.processing"
            >
                Comment
            </button>
        </div>

        <hr v-if="tweet.comments" />

        <div
            v-if="tweet.comments"
            class="featured-comments"
            v-for="comment in tweet.comments"
            :key="comment.id"
        >
            <img
                :src="comment.author.image"
                alt="profile pic"
                class="profile-img"
            />
            <Link
                class="user-name"
                :href="route('profile.index', comment.author.username)"
                >{{ comment.author.name }}</Link
            >
            <span class="comment-date">{{ comment.created_at }}</span>
            <p class="comment-content">
                {{ comment.content }}
            </p>
            <div class="interaction">
                <font-awesome-icon icon="fa-regular fa-heart" /><span
                    >Like · {{ comment.like_count }}</span
                >
            </div>
        </div>
    </div>
</template>

<style lang="css" scoped>
.tweet-container {
    background-color: var(--white);
    border-radius: 8px;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    padding: 20px;
}
.tweet-author {
    display: grid;
    grid-template-columns: min-content 1fr;
    column-gap: 10px;
}
.author-img {
    display: block;
    width: 40px;
    aspect-ratio: 1;
    grid-row: span 2;
    border-radius: 8px;
}
.author-name {
    grid-area: 1/2;
    align-self: center;
    color: var(--black);
    font-weight: 500;
    letter-spacing: -0.56px;
    width: fit-content;
}
.tweet-date {
    grid-area: 2/2;
    font-size: 12px;
    font-family: var(--noto-font);
    font-weight: 500;
    color: #bdbdbd;
    letter-spacing: -0.42px;
}
.delete-btn {
    grid-area: 1/2;
    justify-self: right;
    border: none;
    background-color: transparent;
    cursor: pointer;
}
.delete-btn > svg {
    color: red;
}
.tweet-content {
    color: var(--dark-gray);
    font-weight: 400;
    font-family: var(--noto-font);
    letter-spacing: -0.56px;
    margin-block: 15px;
}
.tweet-image {
    width: 100%;
    border-radius: 8px;
}
.tweet-interaction-status {
    color: #bdbdbd;
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
    text-align: right;
    margin-block: 10px;
}
.tweet-interaction-status span:not(:first-of-type) {
    margin-left: 15px;
}
.interaction-btns {
    width: 100%;
    display: flex;
    justify-content: space-evenly;
}
@media (min-width: 700px) {
    .interaction-btns span {
        display: inline;
        color: var(--dark-gray);
        font-size: 14px;
        font-family: var(--noto-font);
        font-weight: 500;
        letter-spacing: -0.49px;
        margin-left: 10px;
    }
}
@media (max-width: 800px) and (min-width: 700px) {
    .interaction-btns span {
        margin-left: 0;
    }
}
.interaction-btns button {
    cursor: pointer;
    text-align: center;
    padding: 10px 20px;
}
.interaction-btns button:hover {
    background-color: var(--light-gray);
    border-radius: 8px;
}
.interaction-btns button svg {
    vertical-align: middle;
}
.add-comment {
    display: flex;
    align-items: center;
    position: relative;
    column-gap: 15px;
}
.add-comment .profile-img {
    width: 40px;
    aspect-ratio: 1;
    border-radius: 8px;
}
.add-comment textarea {
    width: 100%;
    border: 1px solid var(--light-gray);
    color: #bdbdbd;
    font-family: var(--noto-font);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: -0.49px;
    border-radius: 5px;
}
.add-comment .comment-btn {
    background-color: var(--blue);
    color: var(--white);
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
}
.add-comment .comment-btn:hover {
    opacity: 0.9;
}
.add-comment .comment-btn:disabled {
    background-color: gray;
    cursor: not-allowed;
}
.featured-comments {
    display: grid;
    grid-template-columns: min-content 1fr;
    grid-template-rows: repeat(2, min-content) max-content auto;
    column-gap: 10px;
}
.featured-comments:not(:last-of-type) {
    margin-bottom: 15px;
}
@media (min-width: 700px) {
    .featured-comments {
        grid-template-rows: min-content max-content auto;
        grid-template-columns: min-content auto 1fr;
        align-items: center;
    }
}
.featured-comments .profile-img {
    width: 40px;
    aspect-ratio: 1;
    border-radius: 8px;
    grid-row: span 2;
}
@media (min-width: 700px) {
    .featured-comments .profile-img {
        grid-row: auto;
    }
}
.featured-comments .user-name {
    color: var(--black);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: -0.49px;
    grid-area: 1/2;
}
.featured-comments .comment-date {
    color: #bdbdbd;
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
    grid-area: 2/2;
}
@media (min-width: 700px) {
    .featured-comments .comment-date {
        grid-area: 1/3;
    }
}
.featured-comments .comment-content {
    grid-area: 3/2;
    color: var(--dark-gray);
    font-family: var(--noto-font);
    font-weight: 400;
    letter-spacing: -0.56px;
    margin-block-end: 10px;
    width: min(544.148px, 100%);
}
@media (min-width: 700px) {
    .featured-comments .comment-content {
        grid-column-end: span 2;
    }
}
.featured-comments .interaction {
    grid-area: 4/2;
    display: flex;
    align-items: center;
    column-gap: 4px;
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: -0.42px;
    color: #bdbdbd;
}
.featured-comments .interaction svg {
    width: 16px;
    height: 16px;
}
button {
    border: none;
    background-color: transparent;
}
button:disabled {
    cursor: progress;
}
</style>
