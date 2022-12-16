import Master from "../Pages/User/Layout/Master.vue"
import { Head, Link } from "@inertiajs/inertia-vue3"
import SeeMore from "../Components/SeeMore.vue"
import paginate from "../Components/paginate.vue"
export default {
    name: "OrderHistory",
    components: {
        Master,
        Head,
        Link,
        SeeMore,
        paginate
    },
    props: {
        orders: {},
    },
};