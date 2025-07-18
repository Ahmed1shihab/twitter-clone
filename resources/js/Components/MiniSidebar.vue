<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

defineProps({
    options: {
        type: Array,
        required: true,
    },
});

// onMounted(() => {
//     const observer = new IntersectionObserver(
//         (entries) => {
//             entries.forEach((entry) => {
//                 entry.target.classList.toggle("glass");
//             });
//         },
//         { rootMargin: "0px 0px -95% 0px" }
//     );
//     observer.observe(document.querySelector(".sidebar"));
// });

// const meactive = ref(true);
</script>

<template>
    <aside class="sidebar glass">
        <ul class="options-container">
            <li v-for="option in options" :key="option">
                <slot :option="option">
                    <Link
                        :href="option.link"
                        :class="{ active: option.isActive || false }"
                    >
                        {{ option.name }}
                    </Link>
                </slot>
            </li>
        </ul>
    </aside>
</template>

<style lang="css" scoped>
.sidebar {
    position: sticky;
    top: 0px;
    width: 100%;
    height: fit-content;
    flex-shrink: 0;
    background: var(--white);
    border-radius: 8px;
    margin-bottom: 20px;
    z-index: 10;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.05);
    transition: background 200ms ease-in-out;
}

@media (min-width: 700px) {
    .sidebar {
        max-width: 310px;
        top: 20px;
        margin-bottom: 0;
    }
}

@media (max-width: 800px) and (min-width: 700px) {
    .sidebar {
        width: fit-content;
    }
}

.sidebar .options-container {
    position: relative;
    display: flex;
    justify-content: space-around;
    padding-inline: 0;
}
@media (min-width: 700px) {
    .sidebar .options-container {
        display: block;
        padding-inline: 20px;
    }
}
.sidebar .options-container li {
    position: relative;
    color: var(--gray);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: -0.49px;
    padding-block: 15px;
}
@media (min-width: 700px) {
    .sidebar .options-container li {
        position: static;
    }
}
.sidebar .options-container li a {
    text-transform: capitalize;
    vertical-align: sub;
}
.sidebar .options-container li a.active {
    color: var(--blue);
}
.sidebar .options-container li a.active::after {
    content: "";
    height: 3px;
    width: 60.3px;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    background: var(--blue);
    border-radius: 8px 8px 0 0;
}
@media (min-width: 700px) {
    .sidebar .options-container li a.active::after {
        width: 3px;
        height: 32px;
        left: 1.5px;
        bottom: auto;
        border-radius: 0 8px 8px 0;
    }
}
.glass {
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.1),
        rgba(255, 255, 255, 0)
    );
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}
@media (min-width: 700px) {
    .glass {
        background-color: var(--white);
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
    }
}
</style>
