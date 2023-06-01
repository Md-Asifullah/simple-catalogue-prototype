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
    <div class="container">
        <br />
        <h1 class="text-center">Add to Cart</h1>
        <br />
        <!-- Start of Cart -->
        <div
            v-for="item in list"
            :key="item.id"
            class="card mb-3"
            style="max-width: 100%"
        >
            <div class="d-none">
                {{ (formPicker.product_id = item.id) }}
                {{ (formPicker.product_name = item.name) }}
                {{
                    item.regular_price != "No price allocated"
                        ? (formPicker.total_price =
                              item.regular_price * formPicker.quantity)
                        : "N/A"
                }}
            </div>

            <div class="row g-0">
                <div class="col-md-5">
                    <img :src="item.images[0].src" />
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h4
                            class="card-title"
                            v-text="'Product Id: ' + item.id"
                        ></h4>
                        <h1 v-text="item.name"></h1>
                        <p v-text="'Category: ' + item.categories[0].name"></p>
                        <h5
                            :class="
                                item.in_stock ? 'text-success' : 'text-danger'
                            "
                            v-text="
                                'Availability: ' +
                                (item.in_stock ? 'in stock' : 'out of stock')
                            "
                        ></h5>
                        <h5
                            v-text="
                                'Price: ' +
                                (item.regular_price
                                    ? 'RM ' + item.regular_price
                                    : 'No price allocated')
                            "
                        ></h5>

                        <hr />
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Customer Name</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="customerName"
                                placeholder="Enter your name"
                                v-model="formPicker.customer_name"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Email address</label
                            >
                            <input
                                type="email"
                                class="form-control"
                                id="exampleFormControlInput1"
                                placeholder="name@example.com"
                                v-model="formPicker.customer_email"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Select Quantity of Products</label
                            >
                            <select
                                class="form-select"
                                aria-label="Default select example"
                                v-model="formPicker.quantity"
                            >
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlTextarea1"
                                class="form-label"
                                >Address</label
                            >
                            <textarea
                                class="form-control"
                                id="exampleFormControlTextarea1"
                                rows="3"
                                placeholder="Enter your address"
                                v-model="formPicker.customer_address"
                            ></textarea>
                        </div>

                        <a href="#" class="btn btn-success" @click="onSave()"
                            >Order</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Cart -->
    </div>
</template>
<script>
import axios from "axios";
import { onMounted, ref } from "vue";

let products = ref([]);
let formPicker = ref([]);

export default {
    name: "App",
    data() {
        return {
            list: [],
            formPicker,
        };
    },
    async mounted() {
        // let result = await axios.get('https://reqres.in/api/users?page=1');
        const currentUrl = window.location.href;
        let id = currentUrl.slice(32);
        // alert(id);
        let result = await axios.get(
            "https://cors-anywhere.herokuapp.com/https://mangomart-autocount.myboostorder.com/wp-json/wc/v1/products?include=" +
                id
        );
        console.warn(result.data);
        this.list = result.data;
        this.newOrder();
    },
    methods: {
        async newOrder() {
            let form = await axios.get("/api/create_order");
            console.log("NULL DATA");
            console.log("form", form.data);
            formPicker.value = form.data;
        },
        onSave() {
            const formData = new FormData();
            formData.append("product_id", this.formPicker.product_id);
            formData.append("product_name", this.formPicker.product_name);
            formData.append("quantity", this.formPicker.quantity);
            formData.append("customer_name", this.formPicker.customer_name);
            formData.append("customer_email", this.formPicker.customer_email);
            formData.append(
                "customer_address",
                this.formPicker.customer_address
            );
            formData.append("total_price", this.formPicker.total_price);
            formData.append("status", this.formPicker.status);

            axios.post("/api/add_order", formData);
            console.log("Form Data Coming up");
            console.log(formData);
            alert("Order has been successful!");
        },
    },
};
</script>

<style scoped>
a {
    cursor: pointer;
}
img {
    width: 100%;
}
h4 {
    color: #7d7d7d;
}
</style>
