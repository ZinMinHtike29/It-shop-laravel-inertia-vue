import Master from "../Pages/User/Layout/Master.vue"
import ImageCarousel from "../Components/ImageCarousel.vue"
import { Head, Link } from "@inertiajs/inertia-vue3"

export default {
    name: "OrderDetails",
    components: {
        Master,
        ImageCarousel,
        Head,
        Link
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