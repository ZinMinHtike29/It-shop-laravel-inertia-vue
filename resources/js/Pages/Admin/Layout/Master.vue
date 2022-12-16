<template>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav
            id="sidebarMenu"
            class="collapse d-lg-block sidebar collapse bg-white"
        >
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <Link
                        :href="route('admin#homePage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'my_dashboard' ? 'active' : ''"
                        aria-current="true"
                    >
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i
                        ><span>Dashboard</span>
                    </Link>
                    <Link
                        :href="route('admin#listPage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'Admin List' ? 'active' : ''"
                    >
                        <i class="fa-solid fa-users-gear me-3"></i
                        ><span>Admin Lists</span></Link
                    >

                    <Link
                        :href="route('admin#userList')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'userList' ? 'active' : ''"
                        ><i class="fas fa-users fa-fw me-3"></i
                        ><span>Users Lists</span></Link
                    >
                    <Link
                        :href="route('admin#categoryPage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'Category' ? 'active' : ''"
                    >
                        <i class="fas fa-chart-bar fa-fw me-3"></i
                        ><span>Category</span></Link
                    >
                    <Link
                        :href="route('admin#brandPage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'brand' ? 'active' : ''"
                    >
                        <i class="fa-regular fa-font-awesome me-3"></i
                        ><span>Product Brands</span></Link
                    >
                    <Link
                        :href="route('admin#createProductPage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'createProduct' ? 'active' : ''"
                    >
                        <i class="fa-regular fa-square-plus me-3"></i
                        ><span>Create Product</span>
                    </Link>
                    <Link
                        :href="route('admin#productList')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'productList' ? 'active' : ''"
                    >
                        <i class="fa-solid fa-list me-3"></i
                        ><span>Product Lists</span>
                    </Link>
                    <Link
                        :href="route('admin#orderListPage')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'orderList' ? 'active' : ''"
                    >
                        <i class="fa-regular fa-file-lines me-3"></i
                        ><span>Order Lists</span>
                    </Link>
                    <Link
                        :href="route('admin#contactList')"
                        class="list-group-item list-group-item-action py-2 ripple"
                        :class="currentTab == 'contactList' ? 'active' : ''"
                    >
                        <i class="fa-solid fa-message me-3"></i
                        ><span>Contact Lists</span>
                    </Link>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav
            id="main-navbar"
            class="navbar navbar-expand-lg navbar-light bg-white fixed-top"
        >
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-mdb-toggle="collapse"
                    data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img
                        src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png"
                        style="heigth: 10px"
                        alt=""
                        loading="lazy"
                    />
                </a>

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                            href="#"
                            id="navbarDropdownMenuLink"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img
                                v-if="$page.props.auth.user.profile == null"
                                :src="$page.props.auth.user.profile_photo_url"
                                class="rounded-circle"
                                style="
                                    height: 40px;
                                    object-fit: cover;
                                    object-position: center;
                                "
                                loading="lazy"
                            />
                            <img
                                v-if="$page.props.auth.user.profile != null"
                                :src="`/storage/${$page.props.auth.user.profile}`"
                                class="rounded-circle"
                                style="
                                    width: 40px;
                                    height: 40px;
                                    object-fit: cover;
                                    object-position: center;
                                "
                                loading="lazy"
                            />
                            <span class="fw-bolder fs-6">
                                {{ $page.props.auth.user.name }}
                            </span>
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdownMenuLink"
                        >
                            <li>
                                <Link
                                    class="dropdown-item"
                                    :href="route('admin#profile')"
                                    as="button"
                                    >My Profile</Link
                                >
                            </li>
                            <li>
                                <Link
                                    class="dropdown-item"
                                    href="/logout"
                                    method="post"
                                    as="button"
                                    >Logout</Link
                                >
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <slot></slot>
        </div>
    </main>
    <!--Main layout-->
</template>

<script>
import "../../../../css/admin.css";

import { Link } from "@inertiajs/inertia-vue3";
export default {
    name: "Master1",
    props: {
        currentTab: "",
    },
    components: {
        Link,
    },
    computed: {},
};
</script>
