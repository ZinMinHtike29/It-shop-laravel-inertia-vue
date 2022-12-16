<template>
    <Head>
        <title>Category</title>
    </Head>
    <Master currentTab="Category">
        <div class="row">
            <!-- Toastr  -->
            <transition name="toast">
                <div class="position-relative z-50" v-if="updateStatus">
                    <toastr
                        class="col-6 offset-3 mt-2"
                        success="Update Category success"
                    ></toastr>
                </div>
            </transition>
            <!-- Toastr  -->
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="fw-bolder fs-5">Create Category</h1>
                    </div>
                    <div class="card-body">
                        <div class="form-group my-2">
                            <label for="">Title</label>
                            <input
                                type="text"
                                class="form-control rounded-pill"
                                placeholder=" Enter Category Title"
                                v-model="categoryTitle"
                            />
                            <small class="text-danger" v-if="errors.title">{{
                                errors.title
                            }}</small>
                        </div>
                        <button
                            class="btn btn-success float-right"
                            @click="createCategory"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-8 bg-white rounded shadow-sm">
                <div
                    class="d-flex justify-content-between mt-2 align-items-center py-1"
                >
                    <h1 class="font-weight-bold fs-4">Category Lists</h1>
                    <div class="d-flex align-items-center">
                        <input
                            type="text"
                            class="form-control rounded-l-full"
                            placeholder="Search Here ..."
                            v-model="searchKey"
                        />
                        <button
                            @click="search"
                            class="btn btn-sm btn-success py-2 rounded-r-full"
                        >
                            <i class="fa-solid fa-magnifying-glass fs-4"></i>
                        </button>
                    </div>
                </div>
                <div class="text-end">
                    <small class="text-danger"
                        >Double Click The Title To Edit !</small
                    >
                </div>
                <div
                    class="d-flex justify-content-center"
                    v-if="categories.data.length == 0"
                >
                    <h1 class="alert alert-info">There Is No Category !</h1>
                </div>
                <div class="overflow-scroll">
                    <table
                        class="table align-middle mb-0 bg-white my-3"
                        v-if="categories.data.length > 0"
                        style="min-width: 600px"
                    >
                        <thead class="">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Product Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <transition-group
                            tag="tbody"
                            enter-active-class="animate__animated animate__backInDown"
                            leave-active-class="animate__animated animate__backOutDown"
                        >
                            <tr
                                v-for="(category, index) in categories.data"
                                :key="category.id"
                            >
                                <td>
                                    <p class="text-muted mb-0">
                                        {{ category.id }}
                                    </p>
                                </td>
                                <td>
                                    <doubleClickInput
                                        :title="category.title"
                                        :Id="category.id"
                                        :Index="index"
                                        @updateValue="updateCategory"
                                    ></doubleClickInput>
                                </td>
                                <td>
                                    <span class="rounded-pill d-inline">{{
                                        dateFormat(category.created_at)
                                    }}</span>
                                </td>
                                <td>
                                    <span class="rounded-pill d-inline"
                                        ><i
                                            class="fa-solid fa-calculator me-2"
                                        ></i
                                        >{{ category.product_count }}</span
                                    >
                                </td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        @click="
                                            deleteCategory(category.id, index)
                                        "
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </transition-group>
                    </table>
                    <div class="mt-3 d-flex justify-content-end">
                        <paginate :links="categories.links"></paginate>
                    </div>
                </div>
            </div>
        </div>
    </Master>
</template>

<script src="../../../js/admin/categorypage.js"></script>

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
