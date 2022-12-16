<template>
    <Head>
        <title>Register</title>
    </Head>
    <div class="main position-relative animate__animated animate__backInRight">
        <div class="container">
            <div class="row" style="height: 100vh" id="signUpPage">
                <div class="col-lg-7 bg-white">
                    <h2 class="text-center login-text mt-5">Create Account</h2>
                    <div class="login-form mt-4">
                        <form @submit.prevent="register">
                            <div class="row justify-content-center">
                                <div class="login-input col-md-7">
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="floatingInput"
                                            placeholder="name@example.com"
                                            v-model="userData.name"
                                        />
                                        <label for="floatingInput"
                                            ><i
                                                class="fa-regular fa-user me-2"
                                            ></i
                                            >Name</label
                                        >
                                        <small
                                            class="text-danger"
                                            v-if="errors.name"
                                            >{{ errors.name }}</small
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="floatingInput"
                                            placeholder="name@example.com"
                                            v-model="userData.email"
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
                                    <div class="form-floating mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="floatingInput"
                                            placeholder="09xxxxxxxxx"
                                            v-model="userData.phone"
                                        />
                                        <label for="floatingInput"
                                            ><i
                                                class="fa-solid fa-mobile me-2"
                                            ></i
                                            >Phone</label
                                        >
                                        <small
                                            class="text-danger"
                                            v-if="errors.phone"
                                            >{{ errors.phone }}</small
                                        >
                                    </div>
                                    <div class="my-3">
                                        <label
                                            class="form-label"
                                            for="customFile"
                                            >Choose Profile</label
                                        >
                                        <input
                                            type="file"
                                            class="form-control p-2"
                                            id="customFile"
                                            @change="setImage"
                                        />
                                        <small
                                            class="text-danger"
                                            v-if="errors.image"
                                            >{{ errors.image }}</small
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea
                                            style="height: 100px"
                                            cols="30"
                                            rows="10"
                                            class="form-control"
                                            id="floatingInput"
                                            placeholder="Enter Address "
                                            v-model="userData.address"
                                        ></textarea>
                                        <label for="floatingPassword"
                                            ><i
                                                class="fa-solid fa-location-dot me-2"
                                            ></i
                                            >Enter Address</label
                                        >
                                        <small
                                            class="text-danger"
                                            v-if="errors.address"
                                            >{{ errors.address }}</small
                                        >
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="floatingPassword"
                                            placeholder="Password"
                                            v-model="userData.password"
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
                                    <div class="form-floating">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="floatingPassword"
                                            placeholder="Password"
                                            v-model="
                                                userData.password_confirmation
                                            "
                                        />
                                        <label for="floatingPassword"
                                            ><i
                                                class="fa-solid fa-lock me-2"
                                            ></i
                                            >Confirm Password</label
                                        >
                                    </div>
                                    <div class="my-3 d-flex align-items-center">
                                        <input
                                            class="form-check-inline bg-secondary"
                                            type="checkbox"
                                            v-model="userData.terms"
                                        />
                                        <label for=""
                                            >I agree to the Privacy Policy
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center my-4">
                                <button class="">
                                    <div
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        v-if="registerStatus"
                                    >
                                        <span class="visually-hidden"
                                            >Loading...</span
                                        >
                                    </div>
                                    <span v-if="registerStatus">loading..</span>
                                    <span v-if="!registerStatus">Register</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 text-box p-lg-5 h-100">
                    <div
                        class="d-flex align-items-center justify-content-center flex-column text-center"
                    >
                        <h1 class="">Welcome Back!</h1>
                        <p class="text-white fs-5 mt-3">
                            To keep connected with us please login with your
                            personal info
                        </p>
                        <Link
                            class="btn btn-outline-light rounded rounded-pill mt-4 py-2"
                            id="signIn"
                            :href="route('loginPage')"
                        >
                            Login
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="../../Auth/register.js"></script>
<style scoped>
@import "../../../css/auth.css";
</style>
