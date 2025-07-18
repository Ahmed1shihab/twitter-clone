<script setup>
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>

<template>
    <aside class="hide sidebar">
        <div class="trends">
            <span class="sidebar-el-title">Trends for you</span>
            <ul>
                <li>
                    <Link href="/" class="trend-title">#programming</Link>
                    <span class="tweets-count">213k Tweets</span>
                </li>
                <li>
                    <Link href="/" class="trend-title">#devchallenges</Link>
                    <span class="tweets-count">123k Tweets</span>
                </li>
                <li>
                    <Link href="/" class="trend-title">#programming</Link>
                    <span class="tweets-count">213k Tweets</span>
                </li>
                <li>
                    <Link href="/" class="trend-title">#programming</Link>
                    <span class="tweets-count">213k Tweets</span>
                </li>
                <li>
                    <Link href="/" class="trend-title">#programming</Link>
                    <span class="tweets-count">213k Tweets</span>
                </li>
                <li>
                    <Link href="/" class="trend-title">#programming</Link>
                    <span class="tweets-count">213k Tweets</span>
                </li>
            </ul>
        </div>
        <div class="who-to-follow">
            <span class="sidebar-el-title">Who to follow</span>
            <div class="profile">
                <div class="profile-details">
                    <img src="@/images/profile-pic.jpeg" alt="profile image" />
                    <div>
                        <p class="profile-name">Mikael Stanley</p>
                        <span class="profile-followers">230k followers</span>
                    </div>
                    <Link href="/">
                        <PrimaryButton class="follow-btn">
                            <font-awesome-icon icon="fa-solid fa-user-plus" />
                            Follow
                        </PrimaryButton>
                    </Link>
                </div>
                <p class="profile-description">
                    Photographer & Filmmaker based in Copenhagen, Denmark ✵ 🇩🇰
                </p>
                <img src="@/images/banner.jpeg" alt="" class="profile-banner" />
            </div>
            <div class="profile">
                <div class="profile-details">
                    <img src="@/images/profile-pic.jpeg" alt="profile image" />
                    <div>
                        <p class="profile-name">Mikael Stanley</p>
                        <span class="profile-followers">230k followers</span>
                    </div>
                    <Link href="/">
                        <PrimaryButton class="follow-btn">
                            <font-awesome-icon icon="fa-solid fa-user-plus" />
                            Follow
                        </PrimaryButton>
                    </Link>
                </div>
                <p class="profile-description">
                    Photographer & Filmmaker based in Copenhagen, Denmark ✵ 🇩🇰
                </p>
                <img src="@/images/banner.jpeg" alt="" class="profile-banner" />
            </div>
        </div>
    </aside>
</template>

<style lang="css" scoped>
@media (min-width: 700px) {
    .sidebar {
        display: flex;
    }
}

.sidebar {
    flex-direction: column;
    row-gap: 25px;
    max-width: 306px;
    position: sticky;
    top: -486px;
}
.trends,
.who-to-follow {
    width: 100%;
    background-color: var(--white);
    border-radius: 12px;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    padding: 10px 20px;
}
.sidebar-el-title {
    display: block;
    color: var(--dark-gray);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: -0.42px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
.trends > ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.trends > ul > li:not(:last-of-type) {
    margin-bottom: 25px;
}
.trends > ul > li .trend-title {
    display: block;
    color: #333;
    font-family: var(--noto-font);
    font-size: 16px;
    font-weight: 600;
    letter-spacing: -0.56px;
    margin: 0;
}
.trends > ul > li .tweets-count {
    color: var(--gray);
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
}
.who-to-follow > .profile {
    display: flex;
    flex-direction: column;
}
.profile:not(:last-of-type) {
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.who-to-follow > .profile > .profile-details {
    display: flex;
    flex-direction: row;
    align-items: center;
    column-gap: 15px;
    margin-bottom: 20px;
}
@media (max-width: 960px) and (min-width: 700px) {
    .who-to-follow > .profile > .profile-details {
        flex-wrap: wrap;
        justify-content: center;
    }
}
.who-to-follow > .profile > .profile-details > img {
    width: 40px;
    height: 40px;
    border-radius: 7px;
}
@media (max-width: 900px) and (min-width: 700px) {
    .who-to-follow > .profile > .profile-details > div {
        text-align: center;
    }
}
.who-to-follow > .profile > .profile-details > div > .profile-name {
    color: var(--black);
    font-size: 16px;
    font-weight: 500;
    letter-spacing: -0.56px;
    margin-bottom: 5px;
}
.who-to-follow > .profile > .profile-details > div > .profile-followers {
    color: var(--gray);
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
    vertical-align: top;
}
.follow-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    height: fit-content;
    pointer-events: none;
    padding: 5px 13px;
}
.follow-btn > .fa-user-plus {
    color: white;
    margin-right: 5px;
    width: 14px;
    height: 14px;
}
.profile-description {
    color: var(--gray);
    font-family: var(--noto-font);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: -0.49px;
    margin-bottom: 30px;
}
.profile-banner {
    border-radius: 8px;
    width: 100%;
    /* width: 265.937px; */
    height: 77.771px;
}
</style>
