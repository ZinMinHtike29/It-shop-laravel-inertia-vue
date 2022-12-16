import { Head, Link } from "@inertiajs/inertia-vue3"
import Master from "../Pages/Admin/Layout/Master.vue";
import axios from "axios";
import toastr from "../Components/toastr.vue"
import UpdateImage from "../Components/UpdateImage.vue"
import ShowRating from "../Components/ShowRating.vue"
export default {
    name: "productDetailsAndUpdate",
    components: {
        Head,
        Link,
        Master,
        toastr,
        UpdateImage,
        ShowRating
    },
    props: {
        product: {},
        category: {},
        brand: {},
        errors: {},
        flash: {}
    },
    data() {
        return {
            imageLink: this.product.images[0].image,
            updateProductData: {
                productName: this.product.product_name,
                description: this.product.description,
                categoryValue: this.product.category_id,
                brandVal: this.product.brand_id,
                productColor: this.product.colors,
                productSpec: this.product.specifications
            }
        }
    },
    methods: {
        changeImage(image) {
            this.imageLink = image
        },
        updateImage(value) {
            axios.post(this.route('admin#updateImage'), value, {
                    headers: {
                        'Content-Type': "multipart/form-data"
                    }
                })
                .then(res => {
                    if (res.data.success) {
                        if (this.imageLink == this.product.images[value.index].image) {
                            this.imageLink = res.data.newImage
                        }
                        this.product.images[value.index].image = res.data.newImage
                    }
                });
        },
        deleteColor(index, colorId) {
            axios.post(this.route('admin#deleteColor'), {
                'id': colorId
            }).then(res => {
                if (res.data.success) {
                    this.updateProductData.productColor.splice(index, 1);
                }
            })
            this.updateProductData.productColor.splice(index, 1);
        },
        addMoreColor() {
            this.updateProductData.productColor.push({ color: '' })
        },
        addMoreSpec() {
            this.updateProductData.productSpec.push({ price: "", specification: "" });
        },
        deleteSpec(index, psId) {
            axios.post(this.route('admin#deleteSpec'), {
                'id': psId
            }).then(res => {
                if (res.data.success) {
                    this.updateProductData.productSpec.splice(index, 1);
                }
            })
            this.updateProductData.productSpec.splice(index, 1);
        },
        getError(index, field) {
            let error = `productSpecs.${index}.${field}`
            return this.errors[error];
        },
        updateProduct() {
            let data = {
                productId: this.product.id,
                productName: this.updateProductData.productName,
                description: this.updateProductData.description,
                categoryId: this.updateProductData.categoryValue,
                brandId: this.updateProductData.brandVal,
                productSpecs: this.updateProductData.productSpec,
                productColors: this.updateProductData.productColor
            }
            this.$inertia.post(this.route('admin#updateProduct'), data, {
                onSuccess: () => {
                    setTimeout(() => {
                        this.flash.success = false
                    }, 2000)
                }
            });
        }
    },
};