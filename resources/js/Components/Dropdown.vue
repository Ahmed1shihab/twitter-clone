<script setup>
import { computed, onMounted, onUnmounted, ref } from "vue";

const props = defineProps({
    align: {
        type: String,
        default: "right",
    },
    width: {
        type: String,
        default: "192px",
    },
    contentStyle: {
        type: String,
        default: "background-color: white; padding: 5px;",
    },
});

const closeOnEscape = (e) => {
    if (open.value && e.key === "Escape") {
        open.value = false;
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));

const alignmentStyle = computed(() => {
    if (props.align === "left") {
        return "transform-origin: top left;left:0;";
    } else if (props.align === "right") {
        return "transform-origin: top right;right:0;";
    } else {
        return "transform-origin: top";
    }
});

const open = ref(false);
</script>

<template>
    <div class="dropdown-container">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="dropdown-overlay" @click="open = false"></div>

        <Transition>
            <div
                v-show="open"
                class="options-container"
                :style="`${alignmentStyle};width: ${width};`"
                style="display: none"
                @click="open = false"
            >
                <div :style="contentStyle">
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>

<style lang="css" scoped>
.dropdown-container {
    position: relative;
}
.dropdown-overlay {
    position: fixed;
    inset: 0;
    z-index: 40;
}
.v-enter-active {
    transition-property: opacity, transform;
    transition-duration: 200ms;
    transition-timing-function: ease-out;
}
.v-enter-from,
.v-leave-to {
    opacity: 0;
    transform: scale(0.95);
}
.v-enter-to,
.v-leave-from {
    opacity: 1;
    transform: scale(1);
}
.v-leave-active {
    transition: opacity, transform ease-in 75ms;
}
.options-container {
    position: absolute;
    z-index: 50;
    margin-top: 8px;
    border-radius: 6px;
    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1),
        0 4px 6px -4px rgb(0 0 0 / 0.1);
}
.options-container > div {
    border-radius: 6px;
    box-shadow: 0 0 0 1px rgba(0 0 0 / 0.05);
}
</style>
