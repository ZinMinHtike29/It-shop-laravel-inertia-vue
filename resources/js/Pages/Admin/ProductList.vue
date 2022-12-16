<template>
    <Head>
        <title>Product Lists</title>
    </Head>
    <Master currentTab="productList">
        <!-- toastr  -->
        <transition
            enter-active-class="animate__animated animate__slideInDown"
            leave-active-class="animate__animated animate__zoomOutDown"
        >
            <div
                class="fixed-top d-flex justify-content-center"
                v-if="deleteStatus"
            >
                <toastr success="Delete Success" class="w-50"></toastr>
            </div>
        </transition>
        <!-- toastr  -->
        <div
            class="d-flex justify-content-between mt-2 align-items-center py-1"
        >
            <h1 class="font-weight-bold fs-4">Product Lists</h1>
            <div class="d-flex align-items-center">
                <input
                    type="text"
                    class="form-control rounded-l-full"
                    placeholder="Search Here ..."
                    v-model="key"
                />
                <button
                    class="btn btn-sm btn-success py-2 rounded-r-full"
                    @click="search"
                >
                    <i class="fa-solid fa-magnifying-glass fs-4"></i>
                </button>
            </div>
        </div>
        <div
            class="d-flex justify-content-center"
            v-if="products.data.length == 0"
        >
            <h1 class="alert alert-info">There Is No Prodcut !</h1>
        </div>
        <div class="table-responsive">
            <table
                class="table align-middle mb-0 bg-white my-3 text-nowrap"
                v-if="products.data.length > 0"
            >
                <thead class="bg-light">
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th></th>
                    </tr>
                </thead>
                <transition-group
                    tag="tbody"
                    enter-active-class="animate__animated animate__jackInTheBox"
                    leave-active-class="animate__animated animate__hinge"
                >
                    <tr
                        v-for="(product, index) in products.data"
                        :key="product"
                    >
                        <td>{{ product.id }}</td>
                        <td class="col-2">
                            <div class="d-flex align-items-center">
                                <img
                                    :src="/storage/ + product.images[0].image"
                                    alt=""
                                    class="w-100"
                                    style="
                                        object-fit: cover;
                                        object-position: center;
                                    "
                                />
                            </div>
                        </td>
                        <td>
                            {{ product.product_name }}
                        </td>
                        <td>
                            {{ product.category.title }}
                        </td>
                        <td>{{ product.brand.title }}</td>
                        <td>
                            <Link
                                class="btn btn-sm btn-success me-2"
                                :href="
                                    route(
                                        'admin#productDetailsAndUpdatePage',
                                        product.id
                                    )
                                "
                            >
                                View and Update
                            </Link>
                            <button
                                class="btn btn-sm btn-danger"
                                @click="deleteProduct(product.id, index)"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </transition-group>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <paginate :links="products.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../admin/productlist.js"></script>

<style lang="stylus" scoped></style>
