<template>
    <Head>
        <title>Save Product Lists</title>
    </Head>
    <Master>
        <div
            class="text-center text-primary mt-5"
            v-if="product.data.length == 0"
        >
            <h3>There Is No Save Product Here !</h3>
        </div>
        <transition-group
            tag="div"
            class="row mt-4 mt-lg-3"
            leave-active-class="animate_animated animate__hinge animate__fast"
            v-if="product.data.length > 0"
        >
            <!-- Card Start  -->
            <div
                class="col-md-4 col-lg-3 mb-3"
                v-for="(p, index) in product.data"
                :key="p"
            >
                <div class="card cus-card p-0 customize-card">
                    <div class="card-img-top text-center" style="height: 220px">
                        <img
                            :src="/storage/ + p.product.images[0].image"
                            style="object-fit: contain; object-position: center"
                            class="h-100 w-100"
                            alt="Laptop"
                        />
                    </div>
                    <div
                        class="save-button"
                        data-mdb-toggle="tooltip"
                        title="Save Product!"
                    >
                        <i
                            class="fa-solid fa-xmark text-danger"
                            @click="removeProduct(p.id, index)"
                            title="remove from save product"
                        ></i>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="small badge badge-info me-2">
                                {{ p.product.category.title }}
                            </p>
                            <p class="small badge badge-info">
                                {{ p.product.brand.title }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-0 fw-bolder">
                                {{ p.product.product_name }}
                            </h6>
                        </div>
                        <div class="row ps-2">
                            <Link
                                class="col btn btn-primary p-2"
                                :href="
                                    route(
                                        'user#detailsAndAddtoCartPage',
                                        p.product.id
                                    )
                                "
                            >
                                See Details
                                <i class="fa-solid fa-eye ms-1"></i> And Buy
                                <i class="fa-solid fa-shopping-cart ms-1"></i>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card End  -->
        </transition-group>

        <div
            class="my-2 d-flex justify-content-end"
            v-if="product.data.length > 0"
        >
            <paginate :links="product.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../user/saveproduct.js"></script>

<style lang="stylus" scoped></style>
