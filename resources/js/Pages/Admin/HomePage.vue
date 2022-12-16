<template>
    <Head>
        <title>Main Dashboard</title>
    </Head>
    <Master currentTab="my_dashboard">
        <!--Section: Minimal statistics cards-->
        <section>
            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i
                                        class="fa-brands fa-product-hunt text-info fa-3x"
                                    ></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ newProduct }}</h3>
                                    <p class="mb-0">New Products</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i
                                        class="far fa-comment-alt text-warning fa-3x"
                                    ></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ newComment }}</h3>
                                    <p class="mb-0">New Comments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div class="align-self-center">
                                    <i
                                        class="fas fa-map-marker-alt text-danger fa-3x"
                                    ></i>
                                </div>
                                <div class="text-end">
                                    <h3>{{ totalVisit }}</h3>
                                    <p class="mb-0">Total Visits in (30 day)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between px-md-1">
                                <div>
                                    <h3 class="text-success">{{ newUser }}</h3>
                                    <p class="mb-0">New Users</p>
                                </div>
                                <div class="align-self-center">
                                    <i
                                        class="far fa-user text-success fa-3x"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Minimal statistics cards-->

        <!--Section: Statistics with subtitles-->
        <section>
            <div class="row">
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i
                                            class="fa-brands fa-product-hunt text-info fa-3x me-4"
                                        ></i>
                                    </div>
                                    <div class="align-self-center">
                                        <h4>Total Products</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ totalProduct }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <i
                                            class="far fa-comment-alt text-warning fa-3x me-4"
                                        ></i>
                                    </div>
                                    <div class="align-self-center">
                                        <h4>Total Comments</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <h2 class="h1 mb-0">{{ totalComments }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-md-1">
                                <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                        <h2 class="h1 mb-0 me-4">
                                            ${{ totalSale }}.00
                                        </h2>
                                    </div>
                                    <div class="align-self-center">
                                        <h4>Total Sales</h4>
                                    </div>
                                </div>
                                <div class="align-self-center">
                                    <i
                                        class="far fa-heart text-danger fa-3x"
                                    ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Section: Statistics with subtitles-->
    </Master>
</template>

<script src="../../admin/homepage.js"></script>

<style lang="scss" scoped></style>
