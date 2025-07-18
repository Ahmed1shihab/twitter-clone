<script>
import EmptyLayout from "@/Layouts/emptyLayout.vue";

export default {
    layout: EmptyLayout,
};
</script>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "ahmed@gmail.com",
    password: "password",
    remember: true,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

defineOptions({ layout: GuestLayout });
</script>

<template>
    <Head title="Log in" />

    <div v-if="status" class="status">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <label class="input-label" for="email">Email</label>

            <input
                class="text-input"
                id="email"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
            />

            <p class="input-error" v-show="form.errors.email">
                {{ form.errors.email }}
            </p>
        </div>

        <div style="margin-top: 1rem">
            <label class="input-label" for="password">Password</label>

            <input
                class="text-input"
                id="password"
                type="password"
                v-model="form.password"
                required
            />

            <p class="input-error" v-show="form.errors.password">
                {{ form.errors.password }}
            </p>
        </div>

        <div class="remember-me-container">
            <label>
                <input
                    type="checkbox"
                    name="remember"
                    v-model="form.remember"
                />

                <span>Remember me</span>
            </label>
        </div>

        <div class="reset-passowrd">
            <Link :href="route('register')" class="forgot-password">
                Create a new account?
            </Link>

            <PrimaryButton
                class="login-btn"
                :style="{ 'opacity: 0.25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </PrimaryButton>
        </div>
        <div style="text-align: left; margin-top: 20px">
            <Link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="forgot-password"
            >
                Forgot your password?
            </Link>
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
.reset-passowrd {
    display: flex;
    margin-top: 20px;
    justify-content: flex-end;
    align-items: center;
}
.forgot-password {
    border-radius: 0.375rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #4b5563;
    text-decoration: underline;
}
.forgot-password:hover {
    color: #111827;
}
.login-btn {
    margin-left: 1rem;
}
</style>
