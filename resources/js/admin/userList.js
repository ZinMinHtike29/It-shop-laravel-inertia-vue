import Master from "../Pages/Admin/Layout/Master.vue";
import { Head, Link } from "@inertiajs/inertia-vue3"
import paginate from "../Components/paginate.vue"
import axios from "axios";
import SeeMore from "../Components/SeeMore.vue"
export default {
    name: "UserList",
    components: {
        Master,
        Head,
        Link,
        paginate,
        SeeMore
    },
    props: {
        users: {
            type: Object
        },
        flash: {},
    },
    data() {
        return {
            userLists: [],
            key: ""
        }
    },
    methods: {
        userChangeRole(userid, index) {
            let data = {
                id: userid
            }
            axios.post(this.route('admin#userChangeRole'), data).then(res => {
                if (res.data.success) {
                    this.userLists.splice(index, 1);
                }
            });
        },
        banUser(userId, index) {
            let data = {
                id: userId
            }
            axios.post(this.route('admin#deleteUser'), data)
                .then(res => {
                    if (res.data.success) {
                        this.userLists.splice(index, 1);
                    }
                });
        },
        search() {
            this.$inertia.get(this.route('admin#userList'), {
                key: this.key
            })
        },
        setSearchKey() {
            if (this.$page.props.ziggy.query.key != null) {
                this.key = this.$page.props.ziggy.query.key
            }
        }
    },
    mounted() {
        this.userLists = this.users.data
        this.setSearchKey();
    }
};