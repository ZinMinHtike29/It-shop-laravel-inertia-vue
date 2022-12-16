import { Head, Link } from "@inertiajs/inertia-vue3"
import Master from "../Pages/Admin/Layout/Master.vue";
import axios from "axios";
import doubleClickInput from "../Components/doubleClickInput.vue"
import toastr from "../Components/toastr.vue"
import paginate from "../Components/paginate.vue"
export default {
    name: "CategoryPage",
    components: {
        Head,
        Link,
        Master,
        doubleClickInput,
        toastr,
        paginate
    },
    props: {
        errors: {},
        categories: {
            type: Object
        },
    },
    data() {
        return {
            categoryTitle: "",
            clickStatus: false,
            updateStatus: false,
            searchKey: "",
        }
    },
    methods: {
        createCategory() {
            let data = {
                title: this.categoryTitle
            }
            this.$inertia.post(this.route('admin#createCategory'), data, {
                onSuccess: () => {
                    this.categoryTitle = ''
                }
            });
        },
        dateFormat(date) {
            var mL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var date = new Date(date);
            var day = date.getDate();
            var year = date.getFullYear();
            var month = mL[date.getMonth() + 1];
            var changeDate = `${year}-${month}-${day}`
            return changeDate
        },
        updateCategory(value) {
            axios.post(this.route('admin#updateCategory', value))
                .then(res => {
                    if (res.data.success) {
                        this.categories.data[value.index].title = value.title
                        this.updateStatus = true
                        setTimeout(() => {
                            this.updateStatus = false
                        }, 1500);
                    }
                })
        },
        search() {
            let data = {
                key: this.searchKey
            }
            this.$inertia.get(route('admin#categoryPage'), data);
        },
        deleteCategory(id, index) {
            let data = { id: id }
            axios.post(this.route('admin#deleteCategory'), data)
                .then(res => {
                    if (res.data.success) {
                        this.categories.data.splice(index, 1)
                    }
                });
        },

        setSearchKey() {
            if (this.$page.props.ziggy.query.key != null) {
                this.searchKey = this.$page.props.ziggy.query.key
            }
        }
    },
    mounted() {
        this.setSearchKey();
    },
};