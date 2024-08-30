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
                <p class="text-sm text-gray-500">
                    <strong class="mr-3">Category</strong>
                    <span v-for="category in product.category" :key="category.id" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{category.name}}</span>
                </p>
                
                <ul class="list-disc list-inside text-gray-600 mt-2" v-for="feature in product.feature" :key="feature.id">
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                         </svg>
                         {{feature.description}}
                    </li>
                    
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

