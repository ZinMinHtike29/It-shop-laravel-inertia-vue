<template>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <!-- Card Start  -->
                <div class="">
                    <div class="card p-0">
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
                            <div class="mb-3">
                                <p class="mb-0 text-muted">
                                    {{ p.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card End  -->
            </div>
            <div class="col-md-8">
                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex-with-icons" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link active"
                            :id="p.id"
                            data-mdb-toggle="tab"
                            :href="#ex-with-icons-tabs-1"
                            role="tab"
                            :aria-controls="p.id"
                            aria-selected="true"
                        >
                            <i class="fa-regular fa-star fa-fw me-2"></i
                            >Ratings</a
                        >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            :id="p.id"
                            data-mdb-toggle="tab"
                            :href="'#' + p.id"
                            role="tab"
                            :aria-controls="p.id"
                            aria-selected="false"
                            ><i class="fa-regular fa-comment fa-fw me-2"></i
                            >Comments</a
                        >
                    </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex-with-icons-content">
                    <div
                        class="tab-pane fade show active"
                        :id="p.id"
                        role="tabpanel"
                        :aria-labelledby="p.id"
                    >
                        <div
                            class="alert alert-warning"
                            v-if="p.ratings.length == 0"
                        >
                            There Is No Rating For This Product !
                        </div>
                        <div class="" v-if="p.ratings.length != 0">
                            <div
                                class=""
                                v-for="(r, index) in p.ratings"
                                :key="index"
                            >
                                <div class="d-flex align-items-center">
                                    <ShowRating
                                        class="me-2"
                                        :value="r.rating"
                                    ></ShowRating>
                                    <span class="mt-1"
                                        ><i class="fa-solid fa-user me-2"></i
                                        >{{ r.rating_count }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        :id="p.id"
                        role="tabpanel"
                        :aria-labelledby="p.id"
                    >
                        <div
                            class="alert alert-warning"
                            v-if="p.comments.length == 0"
                        >
                            There Is NO Comment Here!
                        </div>

                        <div
                            class="overflow-y-scroll"
                            style="max-height: 100vh"
                            v-if="p.comments.length != 0"
                        >
                            <!-- user comment  -->
                            <div
                                class="card mb-2"
                                v-for="comment in p.comments"
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
            </div>
        </div>
    </div>
</template>

<script>
import ShowRating from "../Components/ShowRating.vue";
export default {
    name: "UserRatingAndComment",
    components: {
        ShowRating,
    },
    props: {
        p: {},
    },
};
</script>

<style lang="scss" scoped></style>
