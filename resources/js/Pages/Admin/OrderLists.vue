<template>
    <Head>
        <title>Order Lists</title>
    </Head>
    <Master currentTab="orderList">
        <h1 class="font-weight-bold fs-4">Order Lists</h1>
        <div class="d-flex justify-content-between align-items-center">
            <div
                class="d-flex justify-content-between mt-2 align-items-center py-1"
            >
                <div class="d-flex align-items-center">
                    <input
                        type="text"
                        class="form-control rounded-l-full"
                        placeholder="Search Here ..."
                        v-model="searchKey"
                    />
                    <button
                        class="btn btn-success btn-sm rounded-r-full"
                        @click="search"
                    >
                        <i class="fa-solid fa-magnifying-glass fs-4"></i>
                    </button>
                </div>
            </div>
            <div class="ms-2 ms-md-0">
                <select
                    class="form-select mt-1"
                    @change="filterByStatus"
                    v-model="filterValue"
                >
                    <option value="">All</option>
                    <option value="0">Pending</option>
                    <option value="1">Accept</option>
                    <option value="2">Reject</option>
                </select>
            </div>
        </div>
        <div
            class="d-flex justify-content-center my-4"
            v-if="orders.data.length == 0"
        >
            <h1 class="alert alert-info">There Is No Order Here !</h1>
        </div>
        <div class="table-responsive">
            <table
                class="table align-middle mb-0 bg-white my-3 text-nowrap"
                v-if="orders.data.length > 0"
            >
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>email</th>
                        <th>Order Code</th>
                        <th>Total</th>
                        <th>Order Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr v-for="(order, index) in orders.data" :key="index">
                        <td>
                            {{ order.name }}
                        </td>
                        <td>
                            <SeeMore :userData="order.address"></SeeMore>
                        </td>
                        <td>
                            <span class="">{{ order.phone }}</span>
                        </td>
                        <td>
                            <span class="">{{ order.email }}</span>
                        </td>
                        <td>
                            <Link
                                :href="
                                    route(
                                        'admin#orderDetails',
                                        order.order_code
                                    )
                                "
                                class="btn-link"
                                >{{ order.order_code }}</Link
                            >
                        </td>
                        <td>
                            <span>{{ order.total_price }}</span>
                        </td>
                        <td>
                            <span>{{ order.date }}</span>
                        </td>
                        <td>
                            <select
                                @change="
                                    changeStatus(
                                        index,
                                        order.order_code,
                                        $event
                                    )
                                "
                                class="form-select-sm bg-light"
                            >
                                <option
                                    value="0"
                                    :selected="order.order_status == 0"
                                >
                                    Pending
                                </option>
                                <option
                                    value="1"
                                    :selected="order.order_status == 1"
                                >
                                    Accept
                                </option>
                                <option
                                    value="2"
                                    :selected="order.order_status == 2"
                                >
                                    Reject
                                </option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mt-3" v-if="!filterStatus">
            <paginate :links="orders.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../admin/orderLists.js"></script>

<style lang="stylus" scoped></style>
