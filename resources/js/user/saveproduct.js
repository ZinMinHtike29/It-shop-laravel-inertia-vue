import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import paginate from "../Components/paginate.vue"
import axios from "axios";
export default {
    name: "SaveProduct",
    components: {
        Head,
        Link,
        Master,
        paginate
    },
    props: {
        product: {},
    },
    methods: {
        removeProduct(id, index) {
            let data = {
                id: id
            }
            axios.post(this.route('user#removeSaveProduct'), data)
                .then(res => {
                    if (res.data.success) {
                        this.product.data.splice(index, 1);
                    }
                })
        }
    }
};