<template>
    <Head>
        <title>Login</title>
    </Head>
    <div class="main position-relative animate__animated animate__backInLeft">
        <div class="container">
            <div class="row" style="height: 100vh" id="signInPage">
                <div class="col-lg-7 bg-white p-5 mt-4 h-100">
                    <h2 class="text-center login-text mt-5">
                        Log in To Md-Shop
                    </h2>
                    <div class="login-form mt-5 row">
                        <form @submit.prevent="login">
                            <div class="row justify-content-center">
                                <div class="login-input col-md-7 px-4">
                                    <div class="form-floating mb-3">
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="floatingInput"
                                            placeholder="name@example.com"
                                            v-model="loginData.email"
                                        />
                                        <label for="floatingInput"
                                            ><i
                                                class="fa-regular fa-envelope me-2"
                                            ></i
                                            >Email</label
                                        >
                                        <small
                                            class="text-danger"
                                            v-if="errors.email"
                                            >{{ errors.email }}</small
                                        >
                                    </div>
                                    <div class="form-floating">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="floatingPassword"
                                            placeholder="Password"
                                            v-model="loginData.password"
                                        />
                                        <label for="floatingPassword"
                                            ><i
                                                class="fa-solid fa-lock me-2"
                                            ></i
                                            >Password</label
                                        >
                                        <small
                                            class="text-danger"
                                            v-if="errors.password"
                                            >{{ errors.password }}</small
                                        >
                                    </div>
                                    <div class="my-3 d-flex align-items-center">
                                        <input
                                            class="form-check-inline bg-secondary"
                                            type="checkbox"
                                            v-model="loginData.remember"
                                        />
                                        <label for="">Remember Me </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="">
                                    <div
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        v-if="loginStatus"
                                    >
                                        <span class="visually-hidden"
                                            >Loading...</span
                                        >
                                    </div>
                                    <span v-if="loginStatus">loading..</span>
                                    <span v-if="!loginStatus">Login</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5 text-box p-5 h-100">
                    <div
                        class="d-flex align-items-center justify-content-center flex-column text-center"
                    >
                        <h1 class="">Hello , Friends!</h1>
                        <p class="text-white fs-5 mt-3">
                            Enter Your Personal details and start journey with
                            us.
                        </p>
                        <Link
                            class="btn btn-outline-light rounded rounded-pill mt-4 py-2"
                            id="signIn"
                            :href="route('registerPage')"
                        >
                            Register
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../Auth/login.js"></script>
<style scoped>
@import "../../../css/auth.css"
</style>
