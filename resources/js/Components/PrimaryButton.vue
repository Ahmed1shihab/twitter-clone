<template>
    <button class="btn primary-btn">
        <slot />
    </button>
</template>

<style lang="css">
.btn {
    font-size: 14px;
    font-family: var(--noto-font);
    font-weight: 500;
    letter-spacing: -0.42px;
    border-radius: 4px;
    padding: 8px 24px;
    outline: 2px solid transparent;
    outline-offset: 1px;
    border: none;
    cursor: pointer;
}
button.primary-btn {
    background-color: var(--blue);
    color: var(--white);
}
button.primary-btn > svg {
    color: var(--white) !important;
}
.btn:focus {
    outline-color: var(--blue);
}
.btn:disabled {
    cursor: not-allowed;
}
</style>
