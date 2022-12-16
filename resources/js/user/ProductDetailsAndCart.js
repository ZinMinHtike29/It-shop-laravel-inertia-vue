import { Head, Link } from "@inertiajs/inertia-vue3";
import Master from "../Pages/User/Layout/Master.vue"
import { mapState } from "vuex";
import Rating from "../Components/Rating.vue"
import axios from "axios";
import ShowRating from "../Components/ShowRating.vue"
export default {
    name: "ProductDetailsAndCart",
    components: {
        Head,
        Link,
        Master,
        Rating,
        ShowRating
    },
    props: {
        product: {},
        user: {},
        ratings: {},
        comments: {}
    },
    data() {
        return {
            selectColor: "",
            currentImage: 0,
            productSpec: "",
            productCount: 1,
            ratingValue: 3,
            colorStatus: false,
            specStatus: false,
            arrayRating: Object.values(this.ratings),
            comment: "",
            commentStatus: false,
            commentValueStatus: false,
            commentValue: 3,
        }
    },
    computed: {
        ...mapState(['cart']),
        getRating() {
            let rating = []
            if (this.ratingValue > this.arrayRating.length) {
                this.ratingValue = this.arrayRating.length
            }
            for (let index = 0; index < this.ratingValue; index++) {
                rating.push(this.arrayRating[index])
            }
            return rating
        },
    },
    methods: {
        changeImage(index) {
            this.currentImage = index
        },
        addProduct() {
            this.productCount++
        },
        reduceProduct() {
            this.productCount--
        },
        addToCart() {
            if (this.product.colors.length != 0) {
                this.colorStatus = this.selectColor == "" ? true : false
            }
            this.specStatus = this.productSpec == "" ? true : false
            if (!this.colorStatus && !this.specStatus) {
                let Cartproduct = {}
                Cartproduct = Object.assign(Cartproduct, this.product)
                Cartproduct.colors = this.selectColor
                Cartproduct.specifications = this.productSpec
                Cartproduct["count"] = this.productCount
                this.$store.dispatch('addProduct', Cartproduct)
                this.selectColor = ''
                this.productCount = 1
                this.productSpec = ''
            }
        },
        //Rating
        addRating(value) {
            let data = {
                ratingValue: value,
                productId: this.product.id
            }
            axios.post(this.route('user#addRating'), data)
                .then(res => {
                    if (res.data.success) {
                        this.product.is_rating = true
                        this.product.currentUserRating = res.data.rating
                    }
                })
        },
        removeRating(id) {
            let data = {
                ratingId: id
            }
            axios.post(this.route('user#removeRating'), data)
                .then(res => {
                    if (res.data.success) {
                        this.product.is_rating = false
                        this.product.currentUserRating = null
                    }
                })
        },
        addRatingCount() {
            this.ratingValue += 3
        },
        removeRatingCount() {
            this.ratingValue = 3
        },

        //Comment
        addComment() {
            this.commentValueStatus = this.comment == "" ? true : false;
            if (!this.commentValueStatus) {
                this.commentStatus = true;
                let data = this.$inertia.form({
                    comment: this.comment,
                    productId: this.product.id
                })
                data.post(this.route('user#addComment'), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.comment = ""
                        this.commentStatus = false
                    }
                })
            }
        },
        removeComment(commentId, index) {
            let data = {
                commentId: commentId
            }
            axios.post(this.route('user#removeComment'), data)
                .then(res => {
                    if (res.data.success) {
                        this.comments.splice(index, 1)
                    }
                })
        },

    },
};
