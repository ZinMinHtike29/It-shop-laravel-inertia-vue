<template>
    <Head>
        <title>Order Details</title>
    </Head>
    <Master>
        <div class="row">
            <Link class="my-3" :href="route('user#orderHistory')">
                <i class="fa-solid fa-arrow-left-long me-2"></i>Back
            </Link>
            <div class="col-md-4 mb-2" v-for="p in orderProducts" :key="p">
                <div class="card">
                    <div class="card-img-top">
                        <ImageCarousel
                            :image="p.product.images"
                        ></ImageCarousel>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ p.product.product_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <span class="badge badge-primary me-1">{{
                                p.product.brand.title
                            }}</span>
                            <span class="badge badge-primary me-1">{{
                                p.product.category.title
                            }}</span>
                        </h6>
                        <p class="btn btn-info btn-sm" v-if="p.color != null">
                            {{ p.color }}
                        </p>
                        <p class="card-text">
                            {{
                                filterSpec(
                                    p.product.specifications,
                                    p.specification_id
                                )
                            }}
                        </p>
                        <p class="btn btn-dark me-1">Count: {{ p.qty }}</p>
                        <p class="btn btn-dark">
                            Total Price: {{ p.total_price }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../user/orderdetails.js"></script>

<style lang="stylus" scoped></style>
