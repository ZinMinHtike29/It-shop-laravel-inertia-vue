import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
    name: "Register",
    components: {
        Head,
        Link,
    },
    props: {
        errors: {}
    },
    data() {
        return {
            userData: this.$inertia.form({
                name: '',
                email: '',
                phone: "",
                password: '',
                image: '',
                address: '',
                password_confirmation: '',
                terms: false,
            }),
            registerStatus: false,
        }
    },
    methods: {
        setImage(e) {
            this.userData.image = e.target.files[0];
        },
        register() {
            this.registerStatus = true;
            this.userData.post("/register", {
                onSuccess: () => this.registerStatus = false,
                onError: () => {
                    this.registerStatus = false
                    this.userData.password = ""
                },
            });
        }
    },
};