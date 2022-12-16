import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/Admin/Layout/Master.vue";
import ImageCarousel from "../Components/ImageCarousel.vue"
export default {
    name: "OrderDetails",
    components: {
        Head,
        Link,
        Master,
        ImageCarousel
    },
    props: {
        orderProducts: {},
    },
    methods: {
        filterSpec(spec, id) {

            let result = spec.filter(
                (e) => e.id == id
            )

            let orderSpec = result[0].specification
            return orderSpec
        }
    },
};