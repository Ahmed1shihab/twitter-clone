<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link, usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

function removeAlert() {
    usePage().props.flash.message = null;
}
</script>

<template>
    <nav>
        <div class="top-nav">
            <Link :href="route('home')">
                <ApplicationLogo class="logo" />
            </Link>

            <Dropdown class="dropdown-container" v-if="$page.props.isLoggedIn">
                <template #trigger>
                    <div class="user-info">
                        <img
                            :src="$page.props.auth.user.image"
                            alt="person"
                            class="user-img"
                        />
                        <p class="user-name hide">
                            {{ $page.props.auth.user.username }}
                        </p>
                        <font-awesome-icon
                            icon="fa-solid fa-caret-down"
                            class="dropdown-ic"
                        />
                    </div>
                </template>

                <template #content>
                    <DropdownLink
                        class="dropdown-option"
                        :href="
                            route(
                                'profile.index',
                                $page.props.auth.user.username
                            )
                        "
                    >
                        <font-awesome-icon icon="fa-solid fa-circle-user" />
                        <span>My Profile</span>
                    </DropdownLink>
                    <DropdownLink href="/dashboard" class="dropdown-option">
                        <font-awesome-icon icon="fa-solid fa-gear" />
                        <span>Settings</span>
                    </DropdownLink>
                    <hr />
                    <DropdownLink
                        class="dropdown-option logout-option"
                        :href="route('logout')"
                        method="post"
                        as="button"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-arrow-right-from-bracket"
                        />
                        <span>logout</span>
                    </DropdownLink>
                </template>
            </Dropdown>

            <div v-else>
                <Link href="/login">
                    <PrimaryButton>Login</PrimaryButton>
                </Link>

                <Link href="register" class="register-link">Register</Link>
            </div>
        </div>

        <div class="bottom-nav">
            <NavLink :href="route('home')" :active="route().current('home')">
                <font-awesome-icon icon="fa-solid fa-house" class="nav-icon" />
                <p class="hide">Home</p>
            </NavLink>

            <NavLink
                :href="route('explore')"
                :active="route().current('explore')"
            >
                <font-awesome-icon
                    icon="fa-solid fa-compass"
                    class="nav-icon"
                />
                <p class="hide">Explore</p>
            </NavLink>

            <NavLink
                :href="route('bookmarks')"
                :active="route().current('bookmarks')"
            >
                <font-awesome-icon
                    icon="fa-solid fa-bookmark"
                    class="nav-icon"
                />
                <p class="hide">Bookmarks</p>
            </NavLink>
        </div>
    </nav>

    <main>
        <!-- v-if="$page.props.flash.message" -->
        <div
            class="alert alert-success"
            @click="removeAlert"
            v-if="$page.props.flash.message"
        >
            {{ $page.props.flash.message }}

            <button class="alert-close-btn">
                <font-awesome-icon icon="fa-solid fa-xmark" />
            </button>
        </div>
        <slot />
    </main>

    <footer>
        <p>
            created by <a href="https://github.com/Ahmed1shihab">Ahmed</a> -
            devChallenges.io
        </p>
    </footer>
</template>

<style scoped>
@media (min-width: 700px) {
    nav {
        position: relative;
    }
}

.top-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: var(--white);
    padding: 15px var(--mobile-padding);
}

@media (min-width: 768px) {
    .top-nav {
        padding: 15px var(--desktop-padding);
    }
}

.logo {
    width: 41px;
}

.user-info {
    display: flex;
    align-items: center;
    column-gap: 5px;
    cursor: pointer;
}

.user-img {
    width: 35px;
    height: 35px;
    border-radius: 10px;
}

.dropdown-ic {
    display: block;
    width: 10px !important;
    height: auto !important;
    color: #333 !important;
}
.dropdown-container {
    display: block;
}
.dropdown-option {
    display: flex;
    align-items: center;
    color: var(--dark-gray);
}
.dropdown-option > span {
    color: var(--dark-gray);
    font-family: var(--noto-font);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: -0.42px;
    margin-left: 10px;
}
.logout-option {
    border: none;
    background-color: transparent;
    cursor: pointer;
}
.logout-option > * {
    color: #eb5757 !important;
}

@media (min-width: 700px) {
    .user-name {
        display: block;
        color: #333;
        font-size: 12px;
        font-weight: 700;
        padding: 0 5px 0 11px;
        font-family: var(--noto-font);
    }
}

.register-link {
    color: var(--blue);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: -0.49px;
    text-decoration: none;
    margin-left: 1rem;
}

.bottom-nav {
    display: flex;
    justify-content: space-around;
    position: fixed;
    bottom: 0;
    width: 100vw;
    background-color: var(--white);
    padding: 5px;
    z-index: 9999;
}
.bottom-nav > a {
    padding: 22px 50px;
}
.bottom-nav > a:hover {
    border-radius: 8px;
    background-color: var(--light-gray);
}
.bottom-nav > a > .nav-icon {
    display: block;
    width: 24px;
    height: 24px;
    color: #828282;
}

@media (min-width: 700px) {
    .bottom-nav {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: auto;
        height: fit-content;
        background-color: transparent;
        padding: 0;
    }
    .bottom-nav > a {
        padding: 0;
        margin-left: 50px;
    }
    .bottom-nav > a:hover {
        background-color: transparent;
        border-radius: 0px;
    }
    .bottom-nav > a > .nav-icon {
        display: none;
    }
    .bottom-nav > a > p {
        display: block;
        color: var(--gray);
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }
}

.alert {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: transparent;
    font-size: 16px;
    padding: 15px;
    margin: 10px;
    border-radius: 8px;
}
.alert-close-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
}
.alert-primary {
    color: #004085;
    background-color: #cce5ff;
}
.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
}

footer {
    text-align: center;
    margin-block: 15px;
}
footer p {
    color: #a9a9a9;
    font-family: Montserrat;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}
footer p a {
    font-weight: 700;
    text-decoration-line: underline;
}
</style>
