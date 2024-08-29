<template>

    <h3 class="text-4xl font-bold text-gray-800 text-center mb-8">
        Product Lists
    </h3>

    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Product Card 1 -->
        <div v-for="product in products" :key="products.id" class="bg-white rounded-lg shadow-md overflow-hidden">
            <img class="h-48 w-full object-cover" :src="product.image" alt="Product Image 1">
            <div class="p-4">
                <h3 class="text-xl font-bold text-gray-800">{{product.name}}</h3>
                <p class="text-sm text-gray-500">Category: 
                    
                    <span v-for="category in product.category" :key="category.id"  class="font-semibold text-gray-700">{{category.name}},</span></p>
                
                <ul class="list-disc list-inside text-gray-600 mt-2">
                    <li v-for="feature in product.feature" :key="feature.id">{{feature.description}}</li>
                    
                </ul>
                <div class="mt-4 text-center">
                    <router-link :to="`/product/${product.id}`" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium bg-blue-100 hover:bg-gray-100">
                        Edit
                      </router-link>
                    
                </div>
            </div>
        </div>

       

    </div>

</template>

<script>
import axios from 'axios';

export default{


    data(){
        return {
            products : [],
        }
    },



    mounted(){
        this.getProducts();
    },


    methods:{


        async getProducts(){
            const response = await axios.get('/api/products');

            this.products = response.data.data;
        }
    }



}
</script>

