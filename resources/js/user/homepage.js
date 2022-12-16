import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import paginate from "../Components/paginate.vue"
import axios from "axios";
export default {
    name: "Home",
    components: {
        Head,
        Link,
        Master,
        paginate
    },
    props: {
        category: {},
        brand: {},
        product: {},
        ziggy: {},
    },
    data() {
        return {
            currentCategory: null,
            currentBrand: null,
            searchKey: ''
        }
    },
    methods: {
        filterWithBrand(brand) {
            this.currentBrand = brand
        },
        filterwithCategory(category) {
            this.currentCategory = category
        },
        filterWithCategory(id) {
            let data = {
                'filterCategory': id
            }
            if (this.currentBrand != null) {
                data['filterBrand'] = this.currentBrand
            }
            this.$inertia.get(this.route('user#home'), data)
        },
        filterWithBrand(id) {
            let data = {
                'filterBrand': id,
            }
            if (this.currentCategory != null) {
                data['filterCategory'] = this.currentCategory
            }
            this.$inertia.get(this.route('user#home'), data)
        },
        search() {
            let data = {
                "searchKey": this.searchKey
            }
            this.$inertia.get(this.route('user#home'), data);
        },
        saveProduct(productId, index) {
            let data = {
                productId: productId
            }
            axios.post(this.route('user#saveProduct'), data)
                .then(res => {
                    if (res.data.success) {
                        this.product.data[index].is_save = true;
                    }
                })
        },
        setQueryData() {
            this.currentBrand = this.ziggy.query.filterBrand
            this.currentCategory = this.ziggy.query.filterCategory
            this.searchKey = this.ziggy.query.searchKey
        }
    },
    mounted() {
        this.setQueryData();
        axios.get(this.route('user#visitCount'))
    }
};
