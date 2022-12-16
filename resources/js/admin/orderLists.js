import { Head, Link } from "@inertiajs/inertia-vue3"
import Master from "../Pages/Admin/Layout/Master.vue";
import axios from "axios";
import toastr from "../Components/toastr.vue"
import paginate from "../Components/paginate.vue"
import SeeMore from "../Components/SeeMore.vue"
export default {
    name: "OrderLists",
    components: {
        Head,
        Link,
        Master,
        toastr,
        paginate,
        SeeMore
    },
    data() {
        return {
            filterValue: '',
            filterStatus: false,
            searchKey: "",
        }
    },
    props: {
        orders: {},
        ziggy: {}
    },
    methods: {
        changeStatus(index, orderCode, e) {
            let data = {
                status: e.target.value,
                orderCode: orderCode
            }
            axios.post(this.route('admin#changeStatus'), data)
                .then(res => {
                    if (res.data.success) {
                        this.orders.data[index].order_status = e.target.value
                    }
                })
        },
        filterByStatus(e) {
            if (this.filterValue == "") {
                this.$inertia.get(this.route('admin#orderListPage'));
            } else {
                this.filterStatus = true
                let data = {
                    status: this.filterValue
                }
                axios.post(this.route('admin#filterOrder'), data).then(
                    res => {
                        if (res.data.success) {
                            this.orders.data = res.data.order
                        }
                    }
                )
            }

        },
        search() {
            let data = {
                searchKey: this.searchKey
            }
            this.$inertia.get(this.route('admin#orderListPage'), data);
        },
        setSearchKey() {
            if (this.ziggy.query.searchKey != null) {
                this.filterStatus = true
            }
            this.searchKey = this.ziggy.query.searchKey;
        },
    },
    mounted() {
        this.setSearchKey();
    },
};
