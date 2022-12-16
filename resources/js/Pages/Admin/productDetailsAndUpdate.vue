<template>
    <Head>
        <title>Product Details and Update</title>
    </Head>
    <Master currentTab="productList">
        <!-- toastr  -->
        <transition
            enter-active-class="animate__animated animate__slideInDown"
            leave-active-class="animate__animated animate__zoomOutDown"
        >
            <div
                class="fixed-top d-flex justify-content-center"
                v-if="flash.success"
            >
                <toastr :success="flash.success" class="w-50"></toastr>
            </div>
        </transition>
        <!-- toastr  -->
        <!-- Tabs   -->
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link active"
                    id="ex1-tab-1"
                    data-mdb-toggle="tab"
                    href="#ex1-tabs-1"
                    role="tab"
                    aria-controls="ex1-tabs-1"
                    aria-selected="true"
                    ><i class="fa-solid fa-circle-info"></i>Product Details</a
                >
            </li>
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link"
                    id="ex1-tab-2"
                    data-mdb-toggle="tab"
                    href="#ex1-tabs-2"
                    role="tab"
                    aria-controls="ex1-tabs-2"
                    aria-selected="false"
                    ><i class="fa-solid fa-pen-to-square"></i>Update Product</a
                >
            </li>
            <li class="nav-item" role="presentation">
                <a
                    class="nav-link"
                    id="ex1-tab-3"
                    data-mdb-toggle="tab"
                    href="#ex1-tabs-3"
                    role="tab"
                    aria-controls="ex1-tabs-3"
                    aria-selected="false"
                    ><i class="fa-solid fa-comment"></i>Comment</a
                >
            </li>
        </ul>
        <!-- Tabs navs -->

        <!-- Tabs content -->
        <div class="tab-content" id="ex1-content">
            <div
                class="tab-pane fade show active"
                id="ex1-tabs-1"
                role="tabpanel"
                aria-labelledby="ex1-tab-1"
            >
                <!-- Main Content  -->
                <Link class="my-2 w-25" :href="route('admin#productList')">
                    <i class="fa-solid fa-arrow-left-long"></i> Back
                </Link>
                <div class="row">
                    <div class="col-md-6 col-lg-5 mb-3">
                        <div class="row">
                            <img
                                :src="/storage/ + imageLink"
                                alt=""
                                class="img-thumbnail"
                                style="
                                    height: 300px;
                                    object-fit: contain;
                                    object-position: center;
                                "
                            />
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <img
                                    @click="changeImage(pi.image)"
                                    :class="
                                        imageLink == pi.image
                                            ? 'border border-2 border-info'
                                            : ''
                                    "
                                    :src="/storage/ + pi.image"
                                    alt=""
                                    class="rounded"
                                    style="
                                        width: 80px;
                                        object-fit: cover;
                                        object-position: center;
                                    "
                                    v-for="(pi, index) in product.images"
                                    :key="index"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 p-lg-2">
                        <div class="fs-4 fw-bold mb-2">
                            {{ product.product_name }}
                        </div>
                        <div class="">
                            <span class="btn-sm btn-primary me-2">{{
                                product.category.title
                            }}</span>
                            <span class="btn-sm btn-primary">{{
                                product.brand.title
                            }}</span>
                        </div>
                        <small class="text-muted">
                            {{ product.description }}
                        </small>
                        <div class="row card w-50 my-2 ms-md-1">
                            <div class="card-body">
                                <div
                                    class="alert alert-warning w-50 m-auto my-2"
                                    v-if="product.ratings.length == 0"
                                >
                                    There Is No Rating For This Product !
                                </div>
                                <div
                                    class=""
                                    v-if="product.ratings.length != 0"
                                >
                                    <div
                                        class=""
                                        v-for="(r, index) in product.ratings"
                                        :key="index"
                                    >
                                        <div class="d-flex align-items-center">
                                            <ShowRating
                                                class="me-2"
                                                :value="r.rating"
                                            ></ShowRating>
                                            <span class="mt-1"
                                                ><i
                                                    class="fa-solid fa-user me-2"
                                                ></i
                                                >{{ r.rating_count }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3" v-if="product.colors.length != 0">
                            <small class="d-block fw-bolder"
                                >Product Colors:</small
                            >
                            <div class="d-flex">
                                <div
                                    v-for="(pc, index) in product.colors"
                                    :key="index"
                                >
                                    <span class="badge badge-info me-1">{{
                                        pc.color
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <small class="d-block fw-bolder"
                                >Product Specification:</small
                            >
                            <div class="row mt-2">
                                <div
                                    class="col mb-2"
                                    data-mdb-toggle="tooltip"
                                    v-for="(
                                        ps, index
                                    ) in product.specifications"
                                    :key="index"
                                >
                                    <label
                                        class="btn btn-outline-info d-block"
                                        for="btn-check"
                                        style="min-height: 150px"
                                    >
                                        <div>{{ ps.specification }}</div>
                                    </label>
                                    <div
                                        class="text-center fs-6 fw-bolder w-100 shadow-sm"
                                    >
                                        $ {{ ps.price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main Content End  -->
            </div>
            <div
                class="tab-pane fade"
                id="ex1-tabs-2"
                role="tabpanel"
                aria-labelledby="ex1-tab-2"
            >
                <div class="container">
                    <div class="card">
                        <div class="card-header text-center">
                            <h5>Update Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <h6 class="mb-3">
                                        Update Product Image Here
                                    </h6>
                                    <div
                                        class="my-2"
                                        v-for="(pi, index) in product.images"
                                        :key="index"
                                    >
                                        <UpdateImage
                                            :index="index"
                                            :image="pi.image"
                                            :imageId="pi.id"
                                            :productId="pi.product_id"
                                            @value="updateImage"
                                        ></UpdateImage>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h6 class="mb-3">
                                        Update Product Data Here
                                    </h6>
                                    <div class="">
                                        <div class="form-group my-3">
                                            <label for="">Product Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder=" Enter Product Name"
                                                v-model="
                                                    updateProductData.productName
                                                "
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.productName"
                                                >{{ errors.productName }}</small
                                            >
                                        </div>
                                        <div class="form-group my-3">
                                            <label for=""
                                                >Product Description</label
                                            >
                                            <textarea
                                                class="form-control"
                                                cols="30"
                                                placeholder=" Enter Description"
                                                rows="7"
                                                v-model="
                                                    updateProductData.description
                                                "
                                            ></textarea>
                                            <small
                                                class="text-danger"
                                                v-if="errors.description"
                                                >{{ errors.description }}</small
                                            >
                                        </div>
                                        <!-- Category  -->
                                        <div class="form-group my-2">
                                            <label for=""
                                                >Product Category</label
                                            >
                                            <div class="d-flex flex-wrap">
                                                <div
                                                    class="mx-1 mb-2"
                                                    v-for="(
                                                        c, index
                                                    ) in category"
                                                    :key="index"
                                                >
                                                    <input
                                                        type="radio"
                                                        class="btn-check"
                                                        name="options"
                                                        :value="c.id"
                                                        v-model="
                                                            updateProductData.categoryValue
                                                        "
                                                        :id="c.title + c.id"
                                                        autocomplete="off"
                                                    />
                                                    <label
                                                        :class="
                                                            updateProductData.categoryValue ==
                                                            c.id
                                                                ? 'bg-info text-white'
                                                                : ''
                                                        "
                                                        class="btn btn-secondary"
                                                        :for="c.title + c.id"
                                                        >{{ c.title }}</label
                                                    >
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.categoryId"
                                                        >Need To Choose One
                                                        Category</small
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Category  -->
                                        <!-- brand  -->
                                        <div class="form-group my-2">
                                            <div for="">Select One Brand</div>
                                            <div class="d-flex flex-wrap">
                                                <div
                                                    class="mx-1 mb-2"
                                                    v-for="(c, index) in brand"
                                                    :key="index"
                                                >
                                                    <input
                                                        type="radio"
                                                        class="btn-check"
                                                        name="options1"
                                                        :value="c.id"
                                                        v-model="
                                                            updateProductData.brandVal
                                                        "
                                                        :id="c.title + c.id"
                                                        autocomplete="off"
                                                    />
                                                    <label
                                                        :class="
                                                            updateProductData.brandVal ==
                                                            c.id
                                                                ? 'bg-info text-white'
                                                                : ''
                                                        "
                                                        class="btn btn-secondary"
                                                        :for="c.title + c.id"
                                                        >{{ c.title }}</label
                                                    >
                                                    <small
                                                        class="text-danger"
                                                        v-if="errors.brandId"
                                                        >Need To Choose One
                                                        Brand Name</small
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <!-- brand  -->
                                        <!-- Color  -->
                                        <div class="form-group my-2">
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <label for="">Update or </label>
                                                <button
                                                    class="btn btn-primary"
                                                    @click="addMoreColor"
                                                >
                                                    Add More Colors
                                                </button>
                                            </div>
                                            <transition-group
                                                tag="div"
                                                enter-active-class="animate__animated animate__rotateInDownLeft"
                                                leave-active-class="animate__animated animate__rotateOutDownLeft"
                                            >
                                                <div
                                                    class="my-3"
                                                    v-for="(
                                                        pc, index
                                                    ) in updateProductData.productColor"
                                                    :key="pc"
                                                >
                                                    <label
                                                        class="d-flex justify-content-between"
                                                    >
                                                        <span
                                                            >Product Color
                                                            {{ index }}</span
                                                        >
                                                        <span
                                                            @click="
                                                                deleteColor(
                                                                    index,
                                                                    pc.id
                                                                )
                                                            "
                                                            ><i
                                                                class="fa-solid fa-xmark text-danger"
                                                            ></i
                                                        ></span>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        class="form-control p-1 rounded-pill"
                                                        placeholder=" Enter Product Color "
                                                        v-model="pc.color"
                                                    />
                                                </div>
                                            </transition-group>
                                        </div>
                                        <!-- Color  -->
                                        <!-- Add Specification  -->
                                        <div class="form-group my-2">
                                            <div
                                                class="d-flex justify-content-between align-items-center"
                                            >
                                                <label for=""
                                                    >Update Product
                                                    Specification or
                                                </label>
                                                <button
                                                    class="btn btn-primary"
                                                    @click="addMoreSpec"
                                                >
                                                    Add More Specification
                                                </button>
                                            </div>
                                            <transition-group
                                                tag="div"
                                                enter-active-class="animate__animated animate__rotateInDownLeft"
                                                leave-active-class="animate__animated animate__rotateOutDownLeft"
                                            >
                                                <div
                                                    class="my-3"
                                                    v-for="(
                                                        ps, index
                                                    ) in updateProductData.productSpec"
                                                    :key="ps"
                                                >
                                                    <label
                                                        class="d-flex justify-content-between"
                                                    >
                                                        <span
                                                            >Product
                                                            Specification and
                                                            Price
                                                            {{ index }}</span
                                                        >
                                                        <span
                                                            @click="
                                                                deleteSpec(
                                                                    index,
                                                                    ps.id
                                                                )
                                                            "
                                                            ><i
                                                                class="fa-solid fa-xmark text-danger"
                                                            ></i
                                                        ></span>
                                                    </label>
                                                    <input
                                                        type="number"
                                                        class="form-control p-1 rounded-pill my-2"
                                                        placeholder=" Enter Price "
                                                        v-model="ps.price"
                                                    />
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            getError(
                                                                index,
                                                                'price'
                                                            )
                                                        "
                                                        >{{
                                                            getError(
                                                                index,
                                                                "price"
                                                            )
                                                        }}</small
                                                    >
                                                    <textarea
                                                        class="form-control"
                                                        cols="30"
                                                        rows="7"
                                                        placeholder=" Enter Product Specification"
                                                        required
                                                        v-model="
                                                            ps.specification
                                                        "
                                                    ></textarea>
                                                    <small
                                                        class="text-danger"
                                                        v-if="
                                                            getError(
                                                                index,
                                                                'specification'
                                                            )
                                                        "
                                                        >{{
                                                            getError(
                                                                index,
                                                                "price"
                                                            )
                                                        }}</small
                                                    >
                                                </div>
                                            </transition-group>
                                        </div>
                                        <!-- Add Specification  -->
                                        <div class="text-end">
                                            <button
                                                class="btn btn-info"
                                                @click="updateProduct"
                                            >
                                                Update Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tab-pane fade"
                id="ex1-tabs-3"
                role="tabpanel"
                aria-labelledby="ex1-tab-3"
            >
                <div
                    class="alert alert-warning"
                    v-if="product.comments.length == 0"
                >
                    There Is NO Comment Here!
                </div>

                <div
                    style="max-height: 90vh; overflow: scroll"
                    v-if="product.comments.length != 0"
                >
                    <!-- user comment  -->
                    <div
                        class="card mb-2"
                        v-for="comment in product.comments"
                        :key="comment"
                    >
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <img
                                        :src="
                                            comment.user.profile != null
                                                ? '/storage/' +
                                                  comment.user.profile
                                                : comment.user.profile_photo_url
                                        "
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                    />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">
                                            {{ comment.user.name }}
                                        </p>
                                        <small class="text-primary">{{
                                            comment.date
                                        }}</small>
                                        <p class=" ">
                                            {{ comment.comment }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- user comment -->
                </div>
            </div>
        </div>
        <!-- Tabs content -->
        <!-- Tabs  -->
    </Master>
</template>

<script src="../../admin/productDetailsAndUpdate.js"></script>

<style lang="stylus" scoped></style>
