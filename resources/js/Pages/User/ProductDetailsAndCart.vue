<template>
    <Head>
        <title>Product Details And Add To Cart</title>
    </Head>
    <Master>
        <div class="row">
            <div class="my-md-3 my-lg-2 text-primary">
                <span onclick="history.back()">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Back</span
                >
            </div>
            <div class="mb-3 col-md-6 col-lg-5">
                <div class="overflow-hidden" style="height: 400px">
                    <div
                        class="w-100 d-inline h-100"
                        v-for="(ps, index) in product.images"
                        :key="index"
                    >
                        <transition
                            enter-active-class="animate__animated animate__bounceInUp"
                            leave-active-class="animate__animated animate__bounceOut"
                            mode="out-in"
                        >
                            <img
                                style="object-fit: contain"
                                class="w-100 h-100"
                                :src="/storage/ + ps.image"
                                v-show="currentImage == index"
                            />
                        </transition>
                    </div>
                </div>

                <div class="image-box mt-2">
                    <div v-for="(ps, index) in product.images" :key="index">
                        <img
                            class="rounded-2"
                            @click="changeImage(index)"
                            :class="
                                currentImage == index
                                    ? 'border border-2 border-primary p-1'
                                    : ''
                            "
                            :src="/storage/ + ps.image"
                            alt=""
                            style="
                                width: 80px;
                                height: 80px;
                                object-fit: cover;
                                object-position: center;
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-7 p-lg-4">
                <div class="fs-4 fw-bold mb-2">{{ product.product_name }}</div>
                <div class="d-flex mb-2">
                    <span class="badge badge-primary me-2">{{
                        product.category.title
                    }}</span>
                    <span class="badge badge-primary me-2">{{
                        product.brand.title
                    }}</span>
                </div>
                <small class="text-muted">
                    {{ product.description }}
                </small>
                <div class="row my-3" v-if="product.colors.length != 0">
                    <small class="d-block fw-bolder">Select Color:</small>
                    <select
                        v-model="selectColor"
                        class="form-select-sm w-25 ms-2 mt-2"
                        id=""
                    >
                        <option value="">Choose Color</option>
                        <option
                            v-for="(pc, i) in product.colors"
                            :key="i"
                            :value="pc.color"
                        >
                            {{ pc.color }}
                        </option>
                    </select>
                    <small class="text-danger" v-if="colorStatus"
                        >Need To Choose Color</small
                    >
                </div>
                <div class="row my-3">
                    <small class="d-block fw-bolder"
                        >Select Specification:</small
                    >
                    <small class="text-danger" v-if="specStatus"
                        >Need To Choose Specification</small
                    >
                    <div class="row mt-2 flex-wrap">
                        <div
                            class="me-2 mb-2 col"
                            v-for="(ps, i) in product.specifications"
                            :key="i"
                        >
                            <input
                                type="radio"
                                class="btn-check"
                                :value="ps"
                                v-model="productSpec"
                                name="options"
                                :id="ps.id"
                            />
                            <label
                                :class="
                                    productSpec.id == ps.id
                                        ? 'border border-primary rounded-4'
                                        : ''
                                "
                                :for="ps.id"
                            >
                                <div class="card">
                                    <div class="card-body">
                                        {{ ps.specification }}
                                    </div>
                                    <div class="card-footer">
                                        ${{ ps.price }}
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <small class="d-block fw-bold mb-2"
                            >Product Count:</small
                        >
                        <div class="d-flex">
                            <button
                                class="btn btn-sm btn-primary"
                                @click="reduceProduct"
                                :disabled="productCount == 1"
                            >
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input
                                type="text"
                                class="form-control mx-2 text-center"
                                style="width: 45px"
                                v-model="productCount"
                            />
                            <button
                                class="btn btn-sm btn-primary"
                                @click="addProduct"
                            >
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <h5 v-if="productSpec.price">
                        Total : <i class="fa-solid fa-dollar-sign"></i>
                        {{ productSpec.price * productCount }}
                    </h5>
                    <div class="mt-2">
                        <button class="btn btn-primary" @click="addToCart">
                            Add To Cart
                            <i class="fa-solid fa-cart-shopping ms-1"></i>
                        </button>
                    </div>
                </div>
                <div class="row mt-2">
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
                                >Reviews</a
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
                                >Comments</a
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
                            <!-- add rating  -->
                            <div v-if="!product.is_rating">
                                <Rating @value="addRating"></Rating>
                            </div>
                            <div
                                class="d-flex align-items-center my-2"
                                v-if="product.is_rating"
                            >
                                <h5 class="alert alert-primary">
                                    <i
                                        class="fa-regular fa-circle-check me-2"
                                    ></i>
                                    You Are Already Rating.
                                </h5>
                            </div>
                            <!-- add rating  -->
                            <!-- Current User Rating -->
                            <transition
                                enter-active-class="animate__animated animate__jackInTheBox"
                                leave-active-class="animate__animated animate__hinge"
                            >
                                <div
                                    class=" "
                                    v-if="
                                        product.is_rating &&
                                        product.currentUserRating != null
                                    "
                                >
                                    <div class="fs-5 fw-bolder mb-3">
                                        Your Rating
                                    </div>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div
                                                class="d-flex justify-content-between"
                                            >
                                                <div class="d-flex">
                                                    <img
                                                        :src="
                                                            user.profile != null
                                                                ? '/storage/' +
                                                                  user.profile
                                                                : user.profile_photo_url
                                                        "
                                                        alt=""
                                                        style="
                                                            width: 45px;
                                                            height: 45px;
                                                        "
                                                        class="rounded-circle"
                                                    />

                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1">
                                                            {{ user.name }}
                                                        </p>
                                                        <small
                                                            class="text-muted"
                                                            >{{
                                                                product
                                                                    .currentUserRating
                                                                    .date
                                                            }}</small
                                                        >
                                                        <div class="">
                                                            <ShowRating
                                                                :value="
                                                                    product
                                                                        .currentUserRating
                                                                        .rating
                                                                "
                                                            ></ShowRating>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fs-5">
                                                    <i
                                                        class="fa-solid fa-circle-xmark mb-4 text-danger"
                                                        title="Remove Rating"
                                                        @click="
                                                            removeRating(
                                                                product
                                                                    .currentUserRating
                                                                    .id
                                                            )
                                                        "
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </transition>

                            <div
                                class="fs-5 fw-bolder alert alert-warning"
                                v-if="
                                    arrayRating.length == 0 &&
                                    product.currentUserRating == null
                                "
                            >
                                <span>
                                    <i
                                        class="fa-regular fa-thumbs-down me-2"
                                    ></i
                                    >There Is No Rating Here!</span
                                >
                            </div>

                            <!-- Current User Rating -->
                            <div class="" v-if="arrayRating.length > 0">
                                <div class="fs-5 fw-bolder mb-3">
                                    Rating Lists
                                </div>
                                <!-- Rating List  -->

                                <transition-group
                                    tag="div"
                                    enter-active-class="animate__animated animate__flipInX "
                                    leave-active-class="animate__animated animate__flipOutX "
                                >
                                    <div
                                        class="card mb-2"
                                        v-for="rating in getRating"
                                        :key="rating"
                                    >
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <img
                                                    :src="
                                                        rating.user.profile !=
                                                        null
                                                            ? '/storage/' +
                                                              rating.user
                                                                  .profile
                                                            : rating.user
                                                                  .profile_photo_url
                                                    "
                                                    alt=""
                                                    style="
                                                        width: 45px;
                                                        height: 45px;
                                                    "
                                                    class="rounded-circle"
                                                />

                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">
                                                        {{ rating.user.name }}
                                                    </p>
                                                    <small class="text-muted">{{
                                                        rating.date
                                                    }}</small>
                                                    <div class="">
                                                        <ShowRating
                                                            :value="
                                                                rating.rating
                                                            "
                                                        ></ShowRating>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </transition-group>
                                <div
                                    class="text-center mt-3"
                                    v-if="ratingValue == arrayRating.length"
                                >
                                    <p>Ratings Are End Here!</p>
                                </div>

                                <div
                                    class="text-center mt-3"
                                    v-if="ratingValue != arrayRating.length"
                                >
                                    <button
                                        class="btn btn-outline-primary"
                                        @click="addRatingCount"
                                    >
                                        See More
                                    </button>
                                </div>
                                <div
                                    class="text-center mt-3"
                                    v-if="ratingValue == arrayRating.length"
                                >
                                    <button
                                        class="btn btn-outline-primary"
                                        @click="removeRatingCount"
                                    >
                                        See Less
                                    </button>
                                </div>
                                <!-- Rating List  -->
                            </div>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="ex1-tabs-2"
                            role="tabpanel"
                            aria-labelledby="ex1-tab-2"
                        >
                            <div class="">
                                <textarea
                                    cols="10"
                                    rows="6"
                                    class="form-control w-100"
                                    placeholder="Enter Comment Here ... "
                                    v-model="comment"
                                ></textarea>
                                <small
                                    class="text-danger"
                                    v-if="commentValueStatus"
                                    >Need To Fill The Comment Field!</small
                                >
                            </div>
                            <div class="w-100 text-end my-2">
                                <button
                                    class="btn btn-info"
                                    @click="addComment"
                                    :disabled="commentStatus"
                                >
                                    Add Comment
                                </button>
                            </div>
                            <div
                                class="fs-5 fw-bolder alert alert-danger"
                                v-if="comments.length == 0"
                            >
                                <span>
                                    <i
                                        class="fa-solid fa-comment-slash me-2"
                                    ></i>
                                    There Is No Comment Here!</span
                                >
                            </div>
                            <!-- Comment List  -->
                            <div class="my-3" v-if="this.comments.length != 0">
                                <div class="fs-5 fw-bolder mb-3">
                                    Comment Lists
                                </div>

                                <transition-group
                                    tag="div"
                                    style="
                                        max-height: 340px;
                                        overflow: scroll;
                                        overflow-x: hidden;
                                    "
                                    enter-active-class="animate__animated animate__flipInX animate__faster"
                                    leave-active-class="animate__animated animate__flipOutX animate__faster"
                                >
                                    <!-- user comment  -->
                                    <div
                                        class="card mb-2"
                                        v-for="(comment, index) in comments"
                                        :key="comment"
                                    >
                                        <div class="card-body">
                                            <div
                                                class="d-flex justify-content-between"
                                            >
                                                <div class="d-flex">
                                                    <img
                                                        :src="
                                                            comment.user
                                                                .profile != null
                                                                ? '/storage/' +
                                                                  comment.user
                                                                      .profile
                                                                : comment.user
                                                                      .profile_photo_url
                                                        "
                                                        alt=""
                                                        style="
                                                            width: 45px;
                                                            height: 45px;
                                                        "
                                                        class="rounded-circle"
                                                    />
                                                    <div class="ms-3">
                                                        <p class="fw-bold mb-1">
                                                            {{
                                                                comment.user
                                                                    .name
                                                            }}
                                                        </p>
                                                        <small
                                                            class="text-primary"
                                                            >{{
                                                                comment.date
                                                            }}</small
                                                        >
                                                        <p class=" ">
                                                            {{
                                                                comment.comment
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="fs-5"
                                                    v-if="
                                                        comment.user.id ==
                                                        user.id
                                                    "
                                                >
                                                    <i
                                                        class="fa-solid fa-circle-xmark mb-4 text-danger"
                                                        title="Remove Rating"
                                                        @click="
                                                            removeComment(
                                                                comment.id,
                                                                index
                                                            )
                                                        "
                                                    ></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- user comment -->
                                </transition-group>
                                <div
                                    class="text-center mt-3"
                                    v-if="commentValue == comments.length"
                                >
                                    <p>Comment Are End Here!</p>
                                </div>
                            </div>
                            <!-- Comment List  -->
                        </div>
                    </div>
                    <!-- Tabs content -->
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../user/ProductDetailsAndCart.js"></script>

<style lang="scss" scoped></style>
