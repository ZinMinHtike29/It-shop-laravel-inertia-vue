<template>
    <Head>
        <title>Product Brand</title>
    </Head>
    <Master currentTab="brand">
        <!-- Toastr  -->
        <transition
            enter-active-class="animate__animated animate__backInDown"
            leave-active-class="animate__animated animate__backOutDown"
        >
            <div class="position-relative z-50" v-if="updateStatus">
                <toastr
                    class="col-6 offset-3 mt-2"
                    success="Update Product Brand Success"
                ></toastr>
            </div>
        </transition>
        <!-- Toastr  -->
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="fw-bolder fs-5">Create Category</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group my-2">
                            <label for="">Brand Name</label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                placeholder=" Enter Brand"
                                v-model="brand"
                            />
                            <small class="text-danger" v-if="errors.title">{{
                                errors.title
                            }}</small>
                        </div>
                        <button
                            class="btn btn-success float-right"
                            @click="createBrand"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 bg-white rounded shadow-sm">
                <div
                    class="d-flex justify-content-between mt-2 align-items-center py-1"
                >
                    <h1 class="font-weight-bold fs-4">Category Lists</h1>
                    <div class="d-flex align-items-center">
                        <input
                            type="text"
                            class="form-control rounded-l-full"
                            placeholder="Search Here ..."
                            v-model="searchKey"
                        />
                        <button
                            @click="search"
                            class="btn btn-sm btn-success py-2 rounded-r-full"
                        >
                            <i class="fa-solid fa-magnifying-glass fs-4"></i>
                        </button>
                    </div>
                </div>
                <div class="text-end">
                    <small class="text-danger"
                        >Double Click The Brand Title To Edit !</small
                    >
                </div>
                <div
                    class="d-flex justify-content-center"
                    v-if="brands.data.length == 0"
                >
                    <h1 class="alert alert-info">There Is No Category !</h1>
                </div>
                <div class="table-responsive">
                    <table
                        class="table align-middle mb-0 bg-white my-3 text-nowrap"
                        v-if="brands.data.length > 0"
                    >
                        <thead class="">
                            <tr>
                                <th>Id</th>
                                <th>Brand Title</th>
                                <th>Created At</th>
                                <th>Product Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <transition-group
                            tag="tbody"
                            enter-active-class="animate__animated animate__backInDown"
                            leave-active-class="animate__animated animate__backOutDown"
                        >
                            <tr
                                v-for="(brand, index) in brands.data"
                                :key="brand.id"
                            >
                                <td>
                                    <p class="text-muted mb-0">
                                        {{ brand.id }}
                                    </p>
                                </td>
                                <td>
                                    <doubleClickInput
                                        :title="brand.title"
                                        :Id="brand.id"
                                        :Index="index"
                                        @updateValue="updatebrand"
                                    ></doubleClickInput>
                                </td>
                                <td>
                                    <span class="rounded-pill d-inline">{{
                                        dateFormat(brand.created_at)
                                    }}</span>
                                </td>
                                <td>
                                    <span class="rounded-pill d-inline"
                                        ><i
                                            class="fa-solid fa-calculator me-2"
                                        ></i
                                        >{{ brand.product_count }}</span
                                    >
                                </td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        @click="deleteBrand(brand.id, index)"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </transition-group>
                    </table>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <paginate :links="brands.links"></paginate>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../admin/productbrand.js"></script>

<style scoped></style>
