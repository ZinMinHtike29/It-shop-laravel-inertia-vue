<template>
    <Head>
        <title>Order History</title>
    </Head>
    <Master currentTab="orderHistory">
        <div
            class="d-flex justify-content-center"
            v-if="orders.data.length == 0"
        >
            <div class="alert alert-warning w-50">There Is No Order Here !</div>
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
                                    route('user#orderDetails', order.order_code)
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
                            <span
                                class="btn btn-warning btn-sm"
                                v-if="order.order_status == 0"
                                >Pending</span
                            >
                            <span
                                class="btn btn-primary btn-sm"
                                v-if="order.order_status == 1"
                                >Accept</span
                            >
                            <span
                                class="btn btn-danger btn-sm"
                                v-if="order.order_status == 2"
                                >Reject</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            class="d-flex justify-content-end mt-3"
            v-if="orders.data.length > 0"
        >
            <paginate :links="orders.links"></paginate>
        </div>
    </Master>
</template>

<script src="../../user/orderhistory.js"></script>

<style lang="stylus" scoped></style>
