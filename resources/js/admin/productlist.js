import { Head, Link } from "@inertiajs/inertia-vue3"
import Master from "../Pages/Admin/Layout/Master.vue";
import axios from "axios";
import toastr from "../Components/toastr.vue"
import paginate from "../Components/paginate.vue"
export default {
    name: "ProductList",
    components: {
        Head,
        Link,
        Master,
        toastr,
        paginate
    },
    props: {
        products: {
            type: Object,
        },
    },
    data() {
        return {
            key: "",
            deleteStatus: false
        }
    },
    methods: {
        deleteProduct(id, index) {
            let data = {
                id: id
            }
            axios.post(this.route('admin#deleteProduct'), data)
                .then(res => {
                    if (res.data.success) {
                        this.products.data.splice(index, 1);
                        this.deleteStatus = true;
                        setTimeout(() => {
                            this.deleteStatus = false
                        }, 2500)
                    }
                });
        }
    }
}