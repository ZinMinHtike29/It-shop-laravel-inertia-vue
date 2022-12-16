 import { Head, Link } from "@inertiajs/inertia-vue3"
 import Master from "../Pages/Admin/Layout/Master.vue";
 import axios from "axios";
 import doubleClickInput from "../Components/doubleClickInput.vue"
 import toastr from "../Components/toastr.vue"
 import paginate from "../Components/paginate.vue"
 export default {
     name: "ProductBrand",
     components: {
         Head,
         Link,
         Master,
         doubleClickInput,
         toastr,
         paginate
     },
     props: {
         errors: {
             type: Object
         },
         brands: {
             type: Object
         }
     },
     data() {
         return {
             brand: "",
             updateStatus: false,
             searchKey: ""
         }
     },
     methods: {
         createBrand() {
             let data = {
                 title: this.brand
             }
             this.$inertia.post(this.route('admin#createBrand'), data, {
                 onSuccess: () => {
                     this.brand = ''
                 }
             });
         },
         dateFormat(date) {
             var mL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
             var date = new Date(date);
             var day = date.getDate();
             var year = date.getFullYear();
             var month = mL[date.getMonth() + 1];
             var changeDate = `${year}-${month}-${day}`
             return changeDate
         },
         updatebrand(value) {
             axios.post(this.route('admin#updateBrand', value))
                 .then(res => {
                     if (res.data.success) {
                         this.brands.data[value.index].title = value.title
                         this.updateStatus = true
                         setTimeout(() => {
                             this.updateStatus = false
                         }, 1500);
                     }
                 })
         },
         search() {
             let data = {
                 key: this.searchKey
             }
             this.$inertia.get(route('admin#brandPage'), data);
         },
         setSearchKey() {
             if (this.$page.props.ziggy.query.key != null) {
                 this.searchKey = this.$page.props.ziggy.query.key
             }
         },
         deleteBrand(id, index) {
             let data = { id: id }
             axios.post(this.route('admin#deleteBrand'), data)
                 .then(res => {
                     if (res.data.success) {
                         this.brands.data.splice(index, 1)
                     }
                 });
         },
     },
     mounted() {
         this.setSearchKey();
     }
 }