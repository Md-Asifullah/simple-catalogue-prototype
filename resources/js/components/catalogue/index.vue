<template>
    <!-- Start of Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #42b883">
        <div class="container-fluid">
            <router-link to="/" class="navbar-brand"
                >Simple Catalogue</router-link
            >
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
                        <router-link to="/" class="nav-link active"
                            >Home</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link to="/orders" class="nav-link"
                            >Orders</router-link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->
    <div class="container">
        <br />
        <h1 class="text-center">Simple Catalogue</h1>
        <br />
        <!-- Products Table Start -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <!-- <li v-for="(product, index) in products">{{ product }}</li> -->
                <tr v-for="item in list" :key="item.id">
                    <td class="align-middle">
                        <img :src="item.images[0].src" />
                    </td>
                    <td class="align-middle" v-text="item.id"></td>
                    <td class="align-middle" v-text="item.name"></td>
                    <td
                        class="align-middle"
                        v-text="item.categories[0].name"
                    ></td>
                    <td
                        class="align-middle"
                        v-text="item.in_stock ? 'in stock' : 'out of stock'"
                    ></td>
                    <td
                        class="align-middle"
                        v-text="
                            item.regular_price
                                ? 'RM ' + item.regular_price
                                : 'No price allocated'
                        "
                    ></td>
                    <td class="align-middle">
                        <!--
                        <button
                            @click.preventDefault="addToCart(item.id)"
                            type="button"
                            class="btn btn-success btn-sm"
                        >
                            Add to cart
                        </button> -->
                        <router-link
                            :to="{
                                name: 'cart',
                                params: { id: item.id },
                            }"
                            class="btn btn-success btn-sm"
                            >Add to cart</router-link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li
                        class="page-item"
                        :class="currentPage == 1 ? 'disabled' : ''"
                    >
                        <a
                            @click.preventDefault="previousPage"
                            class="page-link"
                            >Previous</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            @click.preventDefault="goToPage(currentPage)"
                            class="page-link"
                            >{{ currentPage }}</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            @click.preventDefault="goToPage(currentPage + 1)"
                            class="page-link"
                            >{{ currentPage + 1 }}</a
                        >
                    </li>
                    <li class="page-item">
                        <a
                            @click.preventDefault="goToPage(currentPage + 2)"
                            class="page-link"
                            >{{ currentPage + 2 }}</a
                        >
                    </li>
                    <li class="page-item">
                        <a @click.preventDefault="nextPage" class="page-link"
                            >Next</a
                        >
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Products table end -->
        <!--
        <p v-for="item in list" :key="item.id">
            <img :src="item.images[0].src" />
            {{ item.id }} - {{ item.name }} - {{ item.categories[0].name }} -
            {{ item.in_stock ? 'in stock' : 'out of stock' }} -
            {{
                item.regular_price
                    ? 'RM ' + item.regular_price
                    : 'No price allocated'
            }}
        </p>
        -->
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";

let products = ref([]);

export default {
    name: "App",
    data() {
        return {
            currentPage: 1,
            list: [],
        };
    },
    async mounted() {
        // let result = await axios.get('https://reqres.in/api/users?page=1');
        let result = await axios.get(
            "https://cors-anywhere.herokuapp.com/https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products?page=" +
                this.currentPage
        );
        console.warn(result.data);
        this.list = result.data;
    },
    methods: {
        async viewPage() {
            // alert('This function is running 2');
            let result = await axios.get(
                "https://cors-anywhere.herokuapp.com/https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products?page=" +
                    this.currentPage
            );
            console.warn(result.data);
            this.list = result.data;
        },
        nextPage() {
            this.currentPage++;
            this.viewPage();
        },
        goToPage(pageNumber) {
            this.currentPage = pageNumber;
            this.viewPage();
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.viewPage();
            }
        },
        addToCart(id) {
            alert(id);
        },
    },
};
</script>

<style scoped>
a {
    cursor: pointer;
}
img {
    width: 100px;
}
</style>
