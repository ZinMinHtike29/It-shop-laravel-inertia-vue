import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import { Vue3Lottie } from "vue3-lottie";
import contactAnimation from "../../animation/76038-contact-mail.json"
import sendSuccess from "../../animation/91068-message-sent-successfully-plane.json"
import axios from "axios";
export default {
    name: "ContactPage",
    components: {
        Head,
        Link,
        Master,
        Vue3Lottie
    },
    props: {},
    data() {
        return {
            contactAnimation,
            sendSuccess,
            contact: this.$inertia.form({
                userName: "",
                email: "",
                message: "",
            }),
            contactValidation: {
                userName: false,
                email: false,
                message: false
            },
            clickStatus: false,
            sendMesSuccess: false
        }
    },
    methods: {
        sendMessage() {
            this.contactValidation.userName = this.contact.userName == "" ? true : false
            this.contactValidation.email = this.contact.email == "" ? true : false
            this.contactValidation.message = this.contact.message == "" ? true : false
            if (!this.contactValidation.userName && !this.contactValidation.email && !this.contactValidation.message) {
                this.clickStatus = true
                this.contact.post(this.route('user#sendMessage'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.contact.reset()
                        this.clickStatus = false
                        this.sendMesSuccess = true
                        setTimeout(() => {
                            this.sendMesSuccess = false
                        }, 1500)
                    }

                })
            }
        },
    },
    mounted() {}
};

