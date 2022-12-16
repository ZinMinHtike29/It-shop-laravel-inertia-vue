import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import toastr from "../Components/toastr.vue"
export default {
    name: "ProfilePage",
    components: {
        Head,
        Link,
        Master,
        toastr
    },
    props: {
        errors: {},
        user: {}
    },
    data() {
        return {
            loadingStatus: false,
            updateData: {
                name: this.user.name,
                email: this.user.email,
                address: this.user.address,
                phone: this.user.phone,
                profile: "",
            },
            changePasswordValue: {
                oldPassword: "",
                newPassword: "",
                confirmPassword: "",
            },
            changePasswordStatus: false
        }
    },
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
        updateProfile() {
            this.loadingStatus = true;
            this.$inertia.post(this.route("user#profileUpdate"), this.updateData, {
                onSuccess: () => {
                    this.loadingStatus = false;
                    setTimeout(() => {
                        this.$page.props.flash.success = false;
                    }, 2000);
                },
                onError: () => {
                    this.loadingStatus = false;
                }
            });
        },
        changePassword() {
            this.changePasswordStatus = true;
            this.$inertia.post(this.route("user#changePassword"), this.changePasswordValue, {
                onSuccess: () => {
                    this.changePasswordStatus = false;
                    this.clearPasswordForm()
                    setTimeout(() => {
                        this.$page.props.flash.success = false;
                    }, 2000);
                },
                onError: () => {
                    this.clearPasswordForm()
                    this.changePasswordStatus = false;
                }
            });
        },
        clearPasswordForm() {
            this.changePasswordValue.oldPassword = ""
            this.changePasswordValue.newPassword = ""
            this.changePasswordValue.confirmPassword = ""
        }
    },
};
