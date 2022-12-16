import Master from "../Pages/Admin/Layout/Master.vue";
import { Head, Link } from "@inertiajs/inertia-vue3"
import axios from "axios"

export default {
    name: "adminList",
    props: {
        admins: {},
    },
    components: {
        Master,
        Head,
        Link
    },
    data() {
        return {
            adminLists: [],
            searchKey: {
                key: ""
            },
        }
    },
    methods: {
        getAdminList() {
            this.adminLists = this.admins
        },
        removeFromAdmin(userId, index) {
            let data = {
                "id": userId
            }
            axios.post(this.route("admin#removeAcc"), data).then((res) => {
                if (res.data.success) {
                    this.adminLists.splice(index, 1);
                }
            })
        },
        search() {

            this.$inertia.get(this.route("admin#listPage"), {
                key: this.searchKey.key
            });
        },
        setSearchKey() {
            if (this.$page.props.ziggy.query.key != null) {
                this.searchKey.key = this.$page.props.ziggy.query.key
            }
        }
    },
    mounted() {
        this.getAdminList();
        this.setSearchKey();
    }
};
