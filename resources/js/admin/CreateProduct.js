 import { Head, Link } from "@inertiajs/inertia-vue3"
 import Master from "../Pages/Admin/Layout/Master.vue";
 import axios from "axios";
 import toastr from "../Components/toastr.vue"
 import paginate from "../Components/paginate.vue"

 export default {
     name: "CreateProduct",
     components: {
         Head,
         Link,
         Master,
         toastr,
         paginate
     },
     props: {
         category: {
             type: Array,
         },
         brand: {
             type: Array
         },
         errors: {
             type: Object
         },
     },
     data() {
         return {
             productName: "",
             description: "",
             categoryValue: "",
             brandVal: "",
             productColor: [
                 { color: "" }
             ],
             productSpec: [
                 { price: "", specification: "" }
             ],
             image: [],
             createStatus: false,
         }
     },
     methods: {
         addMoreColor() {
             this.productColor.push({ color: "" })
         },
         deleteColor(index) {
             this.productColor.splice(index, 1)
         },
         addMoreSpec() {
             this.productSpec.push({ price: "", specification: "" });
         },
         deleteSpec(index) {
             this.productSpec.splice(index, 1)
         },
         setImage(e) {
             this.image = e.target.files;
         },
         createProduct() {
             let data = {
                 productName: this.productName,
                 description: this.description,
                 categoryId: this.categoryValue,
                 brandId: this.brandVal,
                 productColors: this.productColor,
                 productSpecs: this.productSpec,
                 image: this.image,
             }
             this.createStatus = true;
             this.$inertia.post(this.route('admin#createProduct'), data, {
                 onSuccess: () => {
                     this.createStatus = false
                     this.clearForm();
                 },
                 onError: () => {
                     this.createStatus = false;
                 }
             });
         },
         getErrors(index, field) {
             let property = `productSpecs.${index}.${field}`
             return this.errors[property]
         },
         clearForm() {
             this.productName = ''
             this.description = ''
             this.categoryValue = ''
             this.brandVal = ''
             this.productColor = [{ color: "" }]
             this.productSpec = [{ price: "", specification: "" }]
             this.image = []
         }
     }
 };