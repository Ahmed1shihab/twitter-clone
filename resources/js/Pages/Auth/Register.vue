<script>
import EmptyLayout from "@/Layouts/emptyLayout.vue";

export default {
    layout: EmptyLayout,
};
</script>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

defineOptions({ layout: GuestLayout });
</script>

<template>
    <Head title="Register" />

    <form @submit.prevent="submit">
        <div>
            <label class="input-label" for="username">Username</label>

            <input
                class="text-input"
                id="username"
                type="text"
                v-model="form.username"
                required
                autofocus
                autocomplete="username"
            />

            <p class="input-error" v-show="form.errors.username">
                {{ form.errors.username }}
            </p>
        </div>

        <div class="margin">
            <label class="input-label" for="email">Email</label>

            <input
                class="text-input"
                id="email"
                type="email"
                v-model="form.email"
                required
                autocomplete="username"
            />

            <p class="input-error" v-show="form.errors.email">
                {{ form.errors.email }}
            </p>
        </div>

        <div class="margin">
            <label class="input-label" for="password">Password</label>

            <input
                class="text-input"
                id="password"
                type="password"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <p class="input-error" v-show="form.errors.password">
                {{ form.errors.password }}
            </p>
        </div>

        <div class="margin">
            <label class="input-label" for="password_confirmation"
                >Confirm Password</label
            >

            <input
                class="text-input"
                id="password_confirmation"
                type="password"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <p class="input-error" v-show="form.errors.password_confirmation">
                {{ form.errors.password_confirmation }}
            </p>
        </div>

        <div class="form-submit-container">
            <Link :href="route('login')" class="already-registered">
                Already registered?
            </Link>

            <PrimaryButton
                class="register-btn"
                :class="{ 'opacity: 0.25': form.processing }"
                :disabled="form.processing"
            >
                Register
            </PrimaryButton>
        </div>
    </form>
</template>

<style scoped>
.status {
    margin-bottom: 1rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 500;
    color: #059669;
}
.margin {
    margin-top: 1rem;
}
.text-input {
    display: block;
    margin-top: 0.25rem;
    width: 100%;
    height: 33px;
    border-radius: 0.375rem;
    border: 1px solid #d1d5db;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.text-input:focus {
    border-color: #6366f1;
}
.input-label {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    font-weight: 500;
    color: #374151;
}
.input-error {
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #dc2626;
    margin-top: 0.5rem;
}
.remember-me-container {
    display: block;
    margin-top: 1rem;
}
.remember-me-container input[type="checkbox"] {
    border-radius: 0.25rem;
    border: 1px solid #d1d5db;
    color: #4f46e5;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    outline: 2px solid transparent;
    outline-offset: 1px;
}
.remember-me-container input:focus {
    outline-color: #6366f1;
}
.remember-me-container label {
    display: flex;
    align-items: center;
}
.remember-me-container span {
    margin-left: 0.5rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #4b5563;
}
.form-submit-container {
    display: flex;
    margin-top: 20px;
    justify-content: flex-end;
    align-items: center;
}
.already-registered {
    display: block;
    border-radius: 0.375rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #4b5563;
    text-decoration: underline;
}
.forgot-password:hover {
    color: #111827;
}
.register-btn {
    margin-left: 1rem;
}
</style>
