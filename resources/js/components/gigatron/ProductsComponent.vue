<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List of Gigatron products (laptops)</div>

                    <div class="card-body">
                        <div v-if="products.data.length > 0">
                            <table class="table border">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>EAN</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                </tr>   
                                <tr v-for="(product, index) in products.data" :key="index">
                                    <td><a :href="product.image_url" target="_blank"><img :src="product.image_url"/></a></td>
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.name }}</td>
                                    <td>{{ product.ean }}</td>
                                    <td>{{ product.brand.name }}</td>
                                    <td class="price">{{ product.price }}</td>
                                </tr>                         
                            </table>
                            <pagination :data="products" @pagination-change-page="getResults"></pagination>
                        </div>                            
                        <div v-else>
                            <h1>No records to show</h1>
                        </div>
                    </div>
                </div>
            </div>            
        </div>        
    </div>
</template>

<script>
    export default {
        props: ['products'],
        methods: {
            getResults(page) {                

                if (typeof page === 'undefined') {
                    page = 1;
                }
      
                this.$http.get('?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {                        
                        this.products = data;
                    });
            }
        }
    }
</script>
