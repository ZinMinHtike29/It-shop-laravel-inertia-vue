import Master from "../Pages/Admin/Layout/Master.vue";
import { Head, Link } from "@inertiajs/inertia-vue3"
import SeeMore from "../Components/SeeMore.vue"
import paginate from "../Components/paginate.vue"
export default {
    name: "ContactLists",
    components: {
        Master,
        Head,
        Link,
        SeeMore,
        paginate
    },
    props: {
        contacts: {},
    },
};
