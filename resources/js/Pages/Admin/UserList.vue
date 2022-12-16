<template>
    <Head>
        <title>User Lists</title>
    </Head>
    <Master currentTab="userList">
        <div
            class="d-flex justify-content-between mt-2 align-items-center py-1"
        >
            <h1 class="font-weight-bold fs-4">User Lists</h1>
            <div class="d-flex align-items-center">
                <input
                    type="text"
                    class="form-control rounded-l-full"
                    placeholder="Search Here ..."
                    v-model="key"
                />
                <button
                    class="btn btn-sm btn-success py-2 rounded-r-full"
                    @click="search"
                >
                    <i class="fa-solid fa-magnifying-glass fs-4"></i>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-center" v-if="userLists.length == 0">
            <h1 class="alert alert-info">There Is No User !</h1>
        </div>
        <div class="table-responsive">
            <table
                class="table align-middle mb-0 bg-white my-3 text-nowrap"
                v-if="userLists.length > 0"
            >
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in userLists" :key="index">
                        <td>
                            <div class="d-flex align-items-center">
                                <img
                                    :src="`${
                                        user.profile == null
                                            ? user.profile_photo_url
                                            : '/storage/' + user.profile
                                    }`"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ user.name }}</p>
                                    <p class="text-muted mb-0">
                                        {{ user.email }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <SeeMore :userData="user.address"></SeeMore>
                        </td>
                        <td>
                            <span class="rounded-pill d-inline">{{
                                user.phone
                            }}</span>
                        </td>
                        <td>
                            <span
                                class="text-primary"
                                @click="userChangeRole(user.id, index)"
                            >
                                Change to Admin |
                            </span>
                            <span
                                @click="banUser(user.id, index)"
                                class="text-danger"
                            >
                                Ban User<i class="fa-solid fa-user-slash"></i>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            class="d-flex justify-content-end mt-3"
            v-if="userLists.length != 0"
        >
            <paginate :links="users.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../admin/userList.js"></script>

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
