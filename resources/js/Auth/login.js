import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
    name: "Login",
    props: {
        errors: {}
    },
    components: {
        Head,
        Link,
    },
    data() {
        return {
            loginData: this.$inertia.form({
                email: '',
                password: '',
                remember: false,
            }),
            loginStatus: false,
        }
    },
    methods: {
        login() {
            this.loginStatus = true;
            this.loginData.post("/login", {
                onSuccess: () => this.loginStatus = false,
                onError: () => {
                    this.loginStatus = false
                    this.loginData.password = ""
                },
            });
        }
    },
};