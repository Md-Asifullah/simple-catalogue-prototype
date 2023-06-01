<template>
    <!-- Start of Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #42b883">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand"
                >Simple Catalogue</router-link
            >
            <!-- <a class="navbar-brand" href="#">Simple Catalogue</a> -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/orders" class="nav-link active"
                            >Orders</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br />
        <h1 class="text-center">Orders</h1>
        <br />
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Customer Address</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Order Status</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in orders"
                    :key="item.id"
                    v-if="orders.length > 0"
                >
                    <a href="#"><th scope="row" v-text="item.id"></th></a>
                    <td v-text="item.product_id"></td>
                    <td v-text="item.product_name"></td>
                    <td v-text="item.quantity"></td>
                    <td v-text="item.customer_name"></td>
                    <td v-text="item.customer_email"></td>
                    <td v-text="item.customer_address"></td>
                    <td v-text="'RM ' + item.total_price"></td>
                    <td v-text="item.status" class="text-primary"></td>
                </tr>
                <p v-else>Order not found</p>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
let orders = ref([]);
onMounted(async () => {
    getOrders();
    newOrder();
});

const getOrders = async () => {
    let response = await axios.get("/api/get_all_orders");
    // console.log("response", response);
    orders.value = response.data.orders;
    console.log(orders);
};
</script>
