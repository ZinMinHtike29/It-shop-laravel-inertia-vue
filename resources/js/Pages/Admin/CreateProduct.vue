<template>
    <Head>
        <title>Create Product</title>
    </Head>
    <!-- Toastr  -->

    <Master currentTab="createProduct">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header text-center fs-4 fw-bolder">
                        <h1>Create Product</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group my-2">
                            <label for="" class="mb-2">Product Name</label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                placeholder=" Enter Product Name"
                                v-model="productName"
                            />
                            <small
                                class="text-danger"
                                v-if="errors.productName"
                                >{{ errors.productName }}</small
                            >
                        </div>
                        <!-- Description  -->
                        <div class="form-group my-2">
                            <label for="" class="mb-2"
                                >Product Description</label
                            >
                            <textarea
                                class="form-control"
                                cols="30"
                                rows="5"
                                placeholder=" Enter Description"
                                v-model="description"
                            ></textarea>
                            <small
                                class="text-danger"
                                v-if="errors.description"
                                >{{ errors.description }}</small
                            >
                        </div>
                        <!-- Description  -->
                        <!-- Image  -->
                        <div class="form-group my-2">
                            <label for="" class="mb-2"
                                >Select Product Images</label
                            >
                            <input
                                type="file"
                                multiple
                                class="form-control border-1 rounded border-dark p-1"
                                ref="inputFile"
                                @change="setImage"
                            />
                            <small class="text-danger" v-if="errors.image">{{
                                errors.image
                            }}</small>
                        </div>
                        <!-- Image  -->
                        <!-- Category  -->
                        <div class="form-group my-2">
                            <label for="">Select One Category</label>
                            <div class="d-flex flex-wrap">
                                <div
                                    class="mx-1 mb-2"
                                    v-for="(c, index) in category"
                                    :key="index"
                                >
                                    <input
                                        type="radio"
                                        class="btn-check"
                                        name="options"
                                        :value="c.id"
                                        v-model="categoryValue"
                                        :id="c.title + c.id"
                                        autocomplete="off"
                                    />
                                    <label
                                        :class="
                                            categoryValue == c.id
                                                ? 'bg-info text-white'
                                                : ''
                                        "
                                        class="btn btn-secondary"
                                        :for="c.title + c.id"
                                        >{{ c.title }}</label
                                    >
                                </div>
                            </div>
                            <small class="text-danger" v-if="errors.categoryId"
                                >Need To Choose One Category</small
                            >
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
                                        v-model="brandVal"
                                        :id="c.title + c.id"
                                        autocomplete="off"
                                    />
                                    <label
                                        :class="
                                            brandVal == c.id
                                                ? 'bg-info text-white'
                                                : ''
                                        "
                                        class="btn btn-secondary"
                                        :for="c.title + c.id"
                                        >{{ c.title }}</label
                                    >
                                </div>
                            </div>
                            <small class="text-danger" v-if="errors.brandId"
                                >Need To Choose One Brand Name</small
                            >
                        </div>
                        <!-- brand  -->
                        <!-- Color  -->
                        <div class="form-group my-2">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <label for="">Add Product Color</label>
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
                                    v-for="(pc, index) in productColor"
                                    :key="pc"
                                >
                                    <label
                                        class="d-flex justify-content-between"
                                    >
                                        <span>Product Color {{ index }}</span>
                                        <span
                                            @click="deleteColor(index)"
                                            v-if="index != 0"
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
                        <div class="form-group">
                            <div
                                class="d-flex justify-content-between align-items-center"
                            >
                                <label for="">Add Product Specification</label>
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
                                    v-for="(ps, index) in productSpec"
                                    :key="ps"
                                >
                                    <label
                                        class="d-flex justify-content-between"
                                    >
                                        <span
                                            >Product Specification and Price
                                            {{ index }}</span
                                        >
                                        <span
                                            @click="deleteSpec(index)"
                                            v-if="index != 0"
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
                                        v-if="getErrors(index, 'price')"
                                        class="text-danger"
                                        >{{ getErrors(index, "price") }}</small
                                    >
                                    <textarea
                                        class="form-control"
                                        cols="30"
                                        rows="7"
                                        placeholder=" Enter Product Specification"
                                        required
                                        v-model="ps.specification"
                                    ></textarea>
                                    <small
                                        v-if="getErrors(index, 'specification')"
                                        class="text-danger"
                                        >{{
                                            getErrors(index, "specification")
                                        }}</small
                                    >
                                </div>
                            </transition-group>
                        </div>
                        <!-- Add Specification  -->

                        <div class="form-group text-center">
                            <button
                                class="btn btn-success"
                                @click="createProduct"
                            >
                                <div
                                    class="spinner-border spinner-border-sm"
                                    role="status"
                                    v-if="createStatus"
                                >
                                    <span class="visually-hidden"
                                        >Loading...</span
                                    >
                                </div>
                                <span v-if="createStatus">Creating</span>

                                <span v-if="!createStatus">Create Product</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../admin/CreateProduct.js"></script>

<style lang="stylus" scoped></style>
