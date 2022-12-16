<template>
    <!-- Header Start  -->
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <!-- Navbar brand -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#">
                        <img
                            src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
                            height="30"
                            alt="MDB Logo"
                            loading="lazy"
                        />
                    </a>
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <Link
                                class="nav-link text-primary"
                                :href="route('user#home')"
                                :class="
                                    currentTab == 'home'
                                        ? 'border rounded-5 ps-3 ps-md-2 border-1 border-primary'
                                        : ''
                                "
                                >Home</Link
                            >
                        </li>
                        <li class="nav-item">
                            <Link
                                class="nav-link text-primary"
                                :href="route('user#orderHistory')"
                                :class="
                                    currentTab == 'orderHistory'
                                        ? 'border rounded-5 ps-3 ps-md-2 border-1 border-primary'
                                        : ''
                                "
                                >Order History</Link
                            >
                        </li>
                        <li class="nav-item">
                            <Link
                                class="nav-link text-primary"
                                :href="route('user#contactPage')"
                                :class="
                                    currentTab == 'contact'
                                        ? 'border rounded-5 ps-3 ps-md-2 border-1 border-primary'
                                        : ''
                                "
                                >Contact</Link
                            >
                        </li>
                    </ul>
                    <!-- Left links -->
                </div>
                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <div class="d-flex align-items-center">
                    <Link :href="route('user#saveProductLists')" class="me-4">
                        <i
                            class="fas fa-heart text-primary"
                            title="Save Product"
                        ></i>
                    </Link>
                    <!-- Icon -->
                    <Link :href="route('user#cartPage')" class="me-4">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span
                            class="badge rounded-pill badge-notification bg-danger"
                            >{{ cart.length }}</span
                        >
                    </Link>

                    <!-- Avatar -->
                    <div class="dropdown">
                        <a
                            class="dropdown-toggle d-flex align-items-center hidden-arrow"
                            href="#"
                            id="navbarDropdownMenuAvatar"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                :src="
                                    $page.props.user.profile != null
                                        ? '/storage/' + $page.props.user.profile
                                        : $page.props.user.profile_photo_url
                                "
                                class="rounded-circle"
                                style="
                                    width: 45px;
                                    height: 45px;
                                    object-fit: cover;
                                    object-position: center;
                                "
                            />
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdownMenuAvatar"
                        >
                            <li>
                                <Link
                                    class="dropdown-item"
                                    :href="this.route('user#profile')"
                                    >My profile</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/logout"
                                    as="button"
                                    method="post"
                                    class="dropdown-item"
                                    >Log Out</Link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!-- Header End  -->
    <!-- Main Content  -->
    <main
        class="mt-2 mt-md-3 mt-lg-5 px-3 pt-5 p-lg-5"
        style="min-height: 100vh"
    >
        <slot></slot>
    </main>
    <!-- Main Content End  -->
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-white text-muted">
        <!-- Section: Social media -->
        <section
            class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
        >
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="me-4 link-secondary">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary"></i>MD
                            Shop
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your
                            footer content. Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Products</h6>
                        <p>
                            <a href="#!" class="text-reset">Laptop</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Mobile Phone</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset"
                                >Mobile Accessories</a
                            >
                        </p>
                        <p>
                            <a href="#!" class="text-reset">etc...</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Useful links
                        </h6>
                        <p>
                            <Link
                                :href="route('user#orderHistory')"
                                class="text-reset"
                                >Order History</Link
                            >
                        </p>
                        <p>
                            <Link
                                :href="route('user#saveProductLists')"
                                class="text-reset"
                                >Save Products</Link
                            >
                        </p>
                        <p>
                            <Link
                                :href="route('user#contactPage')"
                                class="text-reset"
                                >Contact</Link
                            >
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div
                        class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4"
                    >
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p>
                            <i class="fas fa-home me-3 text-secondary"></i> New
                            York, NY 10012, US
                        </p>
                        <p>
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            info@example.com
                        </p>
                        <p>
                            <i class="fas fa-phone me-3 text-secondary"></i> +
                            01 234 567 88
                        </p>
                        <p>
                            <i class="fas fa-print me-3 text-secondary"></i> +
                            01 234 567 89
                        </p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div
            class="text-center p-4"
            style="background-color: rgba(0, 0, 0, 0.025)"
        >
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="">ZMH</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</template>

<script>
import "../../../../css/app1.css";
import { Link } from "@inertiajs/inertia-vue3";
import { mapState } from "vuex";
export default {
    name: "Master",
    components: {
        Link,
    },
    computed: {
        ...mapState(["cart"]),
    },
    props: {
        currentTab: "",
    },
};
</script>

<style lang="scss" scoped></style>
