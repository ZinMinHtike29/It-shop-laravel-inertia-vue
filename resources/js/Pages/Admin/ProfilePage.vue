<template>
    <Head>
        <title>Profile</title>
    </Head>
    <Master currentTab=" ">
        <div class="p-lg-5">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center fw-bolder">
                                {{ $page.props.auth.user.name }}
                            </h3>
                            <div class="d-flex justify-content-center mt-3">
                                <img
                                    v-if="$page.props.auth.user.profile == null"
                                    :src="
                                        $page.props.auth.user.profile_photo_url
                                    "
                                    class="rounded-circle w-75"
                                    loading="lazy"
                                />
                                <img
                                    v-if="$page.props.auth.user.profile != null"
                                    :src="`/storage/${$page.props.auth.user.profile}`"
                                    class="rounded-circle shadow-sm"
                                    style="
                                        width: 150px;
                                        height: 150px;
                                        object-fit: cover;
                                        object-position: center;
                                    "
                                    loading="lazy"
                                />
                            </div>
                            <div class="text-center my-2">
                                <span class="badge badge-primary">{{
                                    $page.props.auth.user.role
                                }}</span>
                            </div>
                            <div class="fw-bold">
                                <div class="d-flex justify-content-between">
                                    <div class="text-info">
                                        <i
                                            class="fa-solid fa-envelope-open me-1"
                                        ></i
                                        >Email:
                                    </div>
                                    <div class="">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-info">
                                        <i
                                            class="fa-solid fa-map-location-dot me-1"
                                        ></i
                                        >Address:
                                    </div>
                                    <div class="">
                                        {{ $page.props.auth.user.address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">
                                Joined At :
                                {{
                                    dateFormat($page.props.auth.user.created_at)
                                }}</small
                            >
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <!-- Toastr  -->
                        <transition name="toast">
                            <div class="position-relative" v-if="flash.success">
                                <toastr
                                    class="col-6 offset-3 mt-2"
                                    :success="flash.success"
                                ></toastr>
                            </div>
                        </transition>
                        <!-- Toastr  -->
                        <div class="card-body">
                            <!-- Tabs navs -->
                            <ul
                                class="nav nav-tabs nav-fill mb-3"
                                id="ex1"
                                role="tablist"
                            >
                                <li class="nav-item" role="presentation">
                                    <a
                                        class="nav-link active"
                                        id="ex2-tab-1"
                                        data-mdb-toggle="tab"
                                        href="#ex2-tabs-1"
                                        role="tab"
                                        aria-controls="ex2-tabs-1"
                                        aria-selected="true"
                                        ><i class="fa-regular fa-circle-up"></i>
                                        Update Profile</a
                                    >
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a
                                        class="nav-link"
                                        id="ex2-tab-2"
                                        data-mdb-toggle="tab"
                                        href="#ex2-tabs-2"
                                        role="tab"
                                        aria-controls="ex2-tabs-2"
                                        aria-selected="false"
                                    >
                                        <i class="fa-solid fa-lock"></i> Change
                                        Password</a
                                    >
                                </li>
                            </ul>
                            <!-- Tabs navs -->

                            <!-- Tabs content -->
                            <div class="tab-content" id="ex2-content">
                                <div
                                    class="tab-pane fade show active"
                                    id="ex2-tabs-1"
                                    role="tabpanel"
                                    aria-labelledby="ex2-tab-1"
                                >
                                    <form @submit.prevent="updateUserData">
                                        <div class="form-group my-2">
                                            <label for="" class="">Name</label>
                                            <input
                                                type="text"
                                                class="form-control rounded-pill"
                                                placeholder="Enter Name"
                                                v-model="updateData.name"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.name"
                                                >{{ errors.name }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class="">Email</label>
                                            <input
                                                type="email"
                                                class="form-control rounded-pill"
                                                placeholder="Enter Email"
                                                v-model="updateData.email"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.email"
                                                >{{ errors.email }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class="">Phone</label>
                                            <input
                                                type="text"
                                                class="form-control rounded-pill"
                                                placeholder="Enter Phone"
                                                v-model="updateData.phone"
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.phone"
                                                >{{ errors.phone }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class=""
                                                >Address</label
                                            >
                                            <textarea
                                                cols="30"
                                                rows="5"
                                                class="form-control"
                                                placeholder=" Enter Address"
                                                v-model="updateData.address"
                                            ></textarea>
                                            <small
                                                class="text-danger"
                                                v-if="errors.address"
                                                >{{ errors.address }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class=""
                                                >Change Profile</label
                                            >
                                            <input
                                                type="file"
                                                class="form-control bg-light p-2 border-1 border-dark rounded-pill"
                                                @change="setImage"
                                            />
                                        </div>
                                        <button
                                            class="btn btn-outline-info float-right mt-2"
                                        >
                                            <div
                                                class="spinner-border spinner-border-sm"
                                                role="status"
                                                v-if="loadingStatus"
                                            >
                                                <span class="visually-hidden"
                                                    >Loading...</span
                                                >
                                            </div>
                                            <span v-if="loadingStatus"
                                                >updating..</span
                                            >
                                            <span v-if="!loadingStatus"
                                                >Update</span
                                            >
                                        </button>
                                    </form>
                                </div>
                                <div
                                    class="tab-pane fade"
                                    id="ex2-tabs-2"
                                    role="tabpanel"
                                    aria-labelledby="ex2-tab-2"
                                >
                                    <form @submit.prevent="changePassword">
                                        <div class="form-group my-2">
                                            <label for="" class=""
                                                >Old Password</label
                                            >
                                            <input
                                                type="password"
                                                class="form-control rounded-pill"
                                                placeholder="Enter Old Password"
                                                v-model="
                                                    changePasswordValue.oldPassword
                                                "
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.oldPassword"
                                                >{{ errors.oldPassword }}</small
                                            >
                                            <small
                                                class="text-danger"
                                                v-if="$page.props.flash.error"
                                                >{{
                                                    $page.props.flash.error
                                                }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class=""
                                                >New Password</label
                                            >
                                            <input
                                                type="password"
                                                class="form-control rounded-pill"
                                                placeholder="Enter New Password"
                                                v-model="
                                                    changePasswordValue.newPassword
                                                "
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.newPassword"
                                                >{{ errors.newPassword }}</small
                                            >
                                        </div>
                                        <div class="form-group my-2">
                                            <label for="" class=""
                                                >Confirm Password</label
                                            >
                                            <input
                                                type="password"
                                                class="form-control rounded-pill"
                                                placeholder="Confirm Password"
                                                v-model="
                                                    changePasswordValue.confirmPassword
                                                "
                                            />
                                            <small
                                                class="text-danger"
                                                v-if="errors.confirmPassword"
                                                >{{
                                                    errors.confirmPassword
                                                }}</small
                                            >
                                        </div>
                                        <button
                                            class="btn btn-outline-info float-right mt-2"
                                        >
                                            <div
                                                class="spinner-border spinner-border-sm"
                                                role="status"
                                                v-if="changePasswordStatus"
                                            >
                                                <span class="visually-hidden"
                                                    >Loading...</span
                                                >
                                            </div>
                                            <span v-if="changePasswordStatus"
                                                >updating..</span
                                            >
                                            <span v-if="!changePasswordStatus"
                                                >Change Password</span
                                            >
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Tabs content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../admin/profilepage.js"></script>

<style scoped>
.toast-enter-active {
    animation: wobbles 0.8s ease-in;
}
.toast-leave-from {
    transform: translateY(0px);
    opacity: 1;
}
.toast-leave-to {
    transform: translateY(-30px);
    opacity: 0;
}
.toast-leave-active {
    transition: all 0.5s ease-out;
}
@keyframes wobbles {
    0% {
        transform: translateY(-30px);
        opacity: 0;
    }
    50% {
        transform: translateY(0px);
        opacity: 1;
    }
    60% {
        transform: translateY(-10px);
    }
    70% {
        transform: translateY(10px);
    }
    80% {
        transform: translateY(-5px);
    }
    90% {
        transform: translateY(5px);
    }
    100% {
        transform: translateY(0px);
    }
}
</style>
