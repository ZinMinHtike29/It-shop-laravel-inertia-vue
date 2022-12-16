import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import { mapState } from "vuex";
import axios from "axios";
import toastr from "../Components/toastr.vue"
import SeeMore from "../Components/SeeMore.vue"

export default {
    name: "CartPage",
    components: {
        Head,
        Link,
        Master,
        toastr,
        SeeMore
    },
    data() {
        return {
            successOrder: false,
            clickStatus: false
        }
    },
    computed: {
        ...mapState(['cart']),
        totalValue() {

            let total = 0
            this.cart.forEach(element => {
                total += element.specifications.price * element.count
            });
            return total
        }
    },
    methods: {
        addCount(c) {
            c.count++
        },
        reduceCount(c) {
            c.count--
        },
        addOrder() {
            let data = {
                orders: this.cart,
                totalPrice: this.totalValue,
                orderCode: "mdShop" + Math.floor(Math.random() * 2000000000)
            }
            axios.post(this.route('user#order'), data)
                .then(res => {
                    if (res.data.success) {
                        this.$store.dispatch('clearCart');
                        this.successOrder = true
                        setTimeout(() => {
                            this.successOrder = false
                        }, 3000)
                    }
                });
        }
    },
};
