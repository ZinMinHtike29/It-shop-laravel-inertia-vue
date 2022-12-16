<template>
    <Head>
        <title>Admin List</title>
    </Head>
    <Master currentTab="Admin List">
        <div
            class="d-flex justify-content-between mt-2 align-items-center py-1"
        >
            <h1 class="font-weight-bold fs-4">Admin Lists</h1>
            <div class="d-flex align-items-center">
                <input
                    type="text"
                    class="form-control rounded-l-full"
                    placeholder="Search Here ..."
                    v-model="searchKey.key"
                />
                <button
                    class="btn btn-sm btn-success py-2 rounded-r-full"
                    @click="search"
                >
                    <i class="fa-solid fa-magnifying-glass fs-4"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0 bg-white my-3 text-nowrap">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(admin, index) in adminLists" :key="index">
                        <td>
                            <div class="d-flex align-items-center">
                                <img
                                    :src="`${
                                        admin.profile == null
                                            ? admin.profile_photo_url
                                            : '/storage/' + admin.profile
                                    }`"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                />
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ admin.name }}</p>
                                    <p class="text-muted mb-0">
                                        {{ admin.email }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-muted mb-0">{{ admin.address }}</p>
                        </td>
                        <td>
                            <span class="rounded-pill d-inline">{{
                                admin.phone
                            }}</span>
                        </td>
                        <td v-show="admin.id != $page.props.auth.user.id">
                            <span
                                class="text-danger"
                                @click="removeFromAdmin(admin.id, index)"
                                >Remove From Admin</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </Master>
</template>

<script src="../../admin/adminList.js"></script>

<style lang="stylus" scoped></style>
