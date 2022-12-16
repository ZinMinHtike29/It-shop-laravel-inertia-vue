<template>
    <Head>
        <title>Home</title>
    </Head>
    <Master currentTab="home">
        <div class="row">
            <!-- Side Bar  -->
            <div class="col-md-4 col-lg-3 shadow-sm">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="fs-5 my-3 text-secondary category">
                            BY CATEGORY
                        </div>
                        <div
                            class="shadow-sm p-2 text-center text-primary col-12 rounded rounded-3 mb-2"
                            :class="currentCategory == null ? 'active1' : ''"
                            @click="filterWithCategory('')"
                        >
                            All
                        </div>
                        <div
                            class="d-block shadow-sm p-2 text-primary text-center col-12 rounded rounded-3 mb-2"
                            v-for="(c, index) in category"
                            :key="index"
                            :class="currentCategory == c.id ? 'active1' : ''"
                            @click="filterWithCategory(c.id)"
                        >
                            {{ c.title }}
                        </div>
                        <div class="">
                            <div class="fs-5 my-3 text-secondary">BY Brand</div>
                            <div
                                class="shadow-sm text-primary p-2 text-center col-12 rounded rounded-3 mb-2"
                                :class="currentBrand == null ? 'active1' : ''"
                                @click="filterWithBrand('')"
                            >
                                All
                            </div>
                            <div
                                class="shadow-sm text-primary p-2 text-center col-12 rounded rounded-3 my-2"
                                v-for="(brand, index) in brand"
                                @click="filterWithBrand(brand.id)"
                                :key="index"
                                :class="
                                    currentBrand == brand.id ? 'active1' : ''
                                "
                            >
                                {{ brand.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side Bar End  -->

            <!-- content  -->
            <div class="col-md-8 col-lg-9 mt-2">
                <div class="row my-3">
                    <div class="col-7 col-md-4 offset-0 offset-md-6">
                        <input
                            type="text"
                            class="form-control d-inline"
                            placeholder="Search Product Here."
                            v-model="searchKey"
                        />
                    </div>
                    <button
                        class="btn btn-primary btn-sm col-5 col-md-2"
                        @click="search"
                    >
                        search
                        <i class="fa-solid fa-magnifying-glass ms-1"></i>
                    </button>
                </div>
                <div
                    class="text-center text-primary mt-5"
                    v-if="product.data.length == 0"
                >
                    <h3>There Is No Product Here !</h3>
                </div>
                <div class="row mt-2" v-if="product.data.length > 0">
                    <!-- Card Start  -->
                    <div
                        class="col-md-6 col-lg-4 mb-3"
                        v-for="(p, index) in product.data"
                        :key="index"
                    >
                        <div class="card cus-card p-0 customize-card">
                            <div
                                class="card-img-top text-center"
                                style="height: 220px"
                            >
                                <img
                                    :src="/storage/ + p.images[0].image"
                                    style="
                                        object-fit: contain;
                                        object-position: center;
                                    "
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
                                    class="fa-regular fa-heart text-danger"
                                    v-if="!p.is_save"
                                    @click="saveProduct(p.id, index)"
                                ></i>
                                <i
                                    class="fa-solid fa-heart text-danger"
                                    v-if="p.is_save"
                                ></i>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="small badge badge-info me-2">
                                        {{ p.category.title }}
                                    </p>
                                    <p class="small badge badge-info">
                                        {{ p.brand.title }}
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-0 fw-bolder">
                                        {{ p.product_name }}
                                    </h6>
                                </div>
                                <div class="row ps-2">
                                    <Link
                                        class="col btn btn-primary p-2"
                                        :href="
                                            route(
                                                'user#detailsAndAddtoCartPage',
                                                p.id
                                            )
                                        "
                                    >
                                        See Details
                                        <i class="fa-solid fa-eye ms-1"></i> And
                                        Buy
                                        <i
                                            class="fa-solid fa-shopping-cart ms-1"
                                        ></i>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card End  -->
                </div>
                <div
                    class="my-2 d-flex justify-content-end"
                    v-if="product.data.length > 0"
                >
                    <paginate :links="product.links"></paginate>
                </div>
            </div>
            <!-- content End  -->
        </div>
    </Master>
</template>

<script src="../../user/homepage.js"></script>

<style lang="stylus" scoped></style>
