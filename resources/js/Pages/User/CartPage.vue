<template>
    <Head>
        <title>Cart</title>
    </Head>
    <Master>
        <transition
            enter-active-class="animate__animated animate__backInDown"
            leave-active-class="animate__animated animate__backOutUp"
        >
            <div
                class="d-flex justify-content-center mt-md-3 mt-lg-0"
                style=""
                v-if="successOrder"
            >
                <toastr
                    success="Order Successfully Placed"
                    class="w-50 fixed"
                ></toastr>
            </div>
        </transition>
        <div class="row mt-md-3 mt-lg-2">
            <Link class="my-2" :href="route('user#home')">
                <i class="fa-solid fa-arrow-left-long"></i> Back
            </Link>
            <div class="col-lg-8 overflow-scroll">
                <div class="fs-4 fw-bolder">Shopping Cart</div>
                <div class="row my-3">
                    <div class="text-primary" v-if="cart.length == 0">
                        <h4>There Is No Product Here!</h4>
                    </div>
                    <table
                        class="table text-center mb-0 bg-white"
                        v-if="cart.length > 0"
                    >
                        <thead class="bg-light">
                            <tr>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Spec</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--  -->
                        <transition-group
                            leave-active-class="animate__animated animate__flipOutX"
                        >
                            <tr v-for="(c, i) in cart" :key="c">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img
                                            :src="/storage/ + c.images[1].image"
                                            style="
                                                width: 80px;
                                                height: 80px;
                                                object-fit: cover;
                                            "
                                            class="rounded-4"
                                        />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">
                                                {{ c.product_name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">
                                        {{ c.colors }}
                                    </p>
                                </td>
                                <td colspan="2">
                                    <SeeMore
                                        :userData="
                                            c.specifications.specification
                                        "
                                    ></SeeMore>
                                </td>
                                <td>${{ c.specifications.price }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-sm btn-info"
                                            @click="addCount(c)"
                                        >
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                        <input
                                            type="text"
                                            class="form-control mx-2 text-center"
                                            style="width: 45px"
                                            :value="c.count"
                                        />
                                        <button
                                            class="btn btn-sm btn-info"
                                            @click="reduceCount(c)"
                                        >
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>${{ c.count * c.specifications.price }}</td>
                                <td>
                                    <i
                                        @click="
                                            $store.dispatch('deleteProduct', i)
                                        "
                                        class="fa-solid fa-xmark fa-2x text-danger"
                                    ></i>
                                </td>
                            </tr>
                        </transition-group>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 mt-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <div class="text-muted">SubTotal :</div>
                            <div>${{ totalValue }}</div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div class="text-muted">Shipping :</div>
                            <div>$10</div>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <div class="text-muted">Total :</div>
                            <div>${{ totalValue * 1 + 10 }}</div>
                        </div>
                        <button
                            :disabled="cart.length == 0"
                            class="btn btn-primary mt-2 w-100"
                            @click="addOrder"
                        >
                            Check Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../user/cartpage.js"></script>

<style lang="stylus" scoped></style>
