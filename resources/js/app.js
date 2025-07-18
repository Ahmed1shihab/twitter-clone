import "./bootstrap";
import "../css/app.css";
// import "../css/app2.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faRepeat,
    faEarthAmericas,
    faUserGroup,
    faUserPlus,
    faHouse,
    faCompass,
    faBookmark as fasBookmark,
    faCaretDown,
    faCircleUser,
    faGear,
    faArrowRightFromBracket,
    faMagnifyingGlass,
    faTrashCan,
    faXmark,
    faUserMinus,
    faHeart as fasHeart,
} from "@fortawesome/free-solid-svg-icons";
import {
    faMessage,
    faHeart,
    faBookmark,
    faImage,
} from "@fortawesome/free-regular-svg-icons";

library.add(
    faRepeat,
    faMessage,
    faHeart,
    fasHeart,
    faBookmark,
    faEarthAmericas,
    faUserGroup,
    faImage,
    faUserPlus,
    faHouse,
    faCompass,
    fasBookmark,
    faCaretDown,
    faCircleUser,
    faGear,
    faArrowRightFromBracket,
    faMagnifyingGlass,
    faTrashCan,
    faXmark,
    faUserMinus
);

createInertiaApp({
    title: (title) => `${title} - Twitter`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );
        page.then((module) => {
            module.default.layout = module.default.layout || DefaultLayout;
        });

        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: "#2f80ed",
    },
});
