import Master from "../Pages/Admin/Layout/Master.vue";
import { Head, Link } from "@inertiajs/inertia-vue3"
export default {
    name: "Home Page",
    components: {
        Master,
        Head,
        Link
    },
    props: {
        newProduct: {},
        newComment: {},
        newUser: {},
        totalProduct: {},
        totalComments: {},
        totalSale: {},
        totalVisit: {}
    },
    computed: {},

    mounted() {}
};
