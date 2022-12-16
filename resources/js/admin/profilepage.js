import Master from "../Pages/Admin/Layout/Master.vue";
import { Head, Link } from "@inertiajs/inertia-vue3"
import toastr from "../Components/toastr.vue"
export default {
    name: "ProfilePage",
    props: {
        auth: {},
        flash: {},
        errors: {}
    },
    data() {
        return {
            updateData: this.$inertia.form({
                name: this.auth.user.name,
                email: this.auth.user.email,
                address: this.auth.user.address,
                phone: this.auth.user.phone,
                profile: "",
            }),
            loadingStatus: false,
            changePasswordStatus: false,
            changePasswordValue: this.$inertia.form({
                oldPassword: "",
                newPassword: "",
                confirmPassword: "",
            })
        }
    },
    components: {
        Master,
        Head,
        Link,
        toastr
    },
    computed: {},
    methods: {
        dateFormat(date) {
            var mL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            var date = new Date(date);
            var day = date.getDate();
            var year = date.getFullYear();
            var month = mL[date.getMonth() + 1];
            var changeDate = `${year}-${month}-${day}`
            return changeDate
        },

        setImage(e) {
            this.updateData.profile = e.target.files[0];
        },
        updateUserData() {
            this.loadingStatus = true;
            this.updateData.post(this.route("admin#updateProfile"), {
                onSuccess: () => {
                    this.loadingStatus = false;
                    setTimeout(() => {
                        this.flash.success = false;
                    }, 2000);
                },
                onError: () => {
                    this.loadingStatus = false;
                }
            });
        },
        changePassword() {
            this.changePasswordStatus = true;
            this.changePasswordValue.post(this.route("admin#changePassword"), {
                onSuccess: () => {
                    this.changePasswordStatus = false;
                    this.changePasswordValue.reset();
                    setTimeout(() => {
                        this.flash.success = false;
                    }, 2000);
                },
                onError: () => {
                    this.changePasswordStatus = false;
                    this.changePasswordValue.reset();
                }
            });
        }

    },
    mounted() {

    }
}
