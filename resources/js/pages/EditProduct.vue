<template>
    <div class="max-w-2xl mx-auto p-4">
      <form @submit.prevent="handleSubmit" class="space-y-4">
        <!-- Title -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input
            v-model="product.name"
            id="title"
            type="text"
            required
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
          <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</p>
        </div>
  
        <!-- Image Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input
                type="file"
                id="image"
                @change="handleImageUpload"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:rounded-md file:text-sm file:font-semibold file:bg-gray-50 hover:file:bg-gray-100"
            />
          
            <div v-if="image" class="mt-2">
                <img :src="image" alt="Image Preview" class="mt-2 h-48 w-29 object-cover"/>
            </div>
            <div v-else>
                <img class="mt-2 h-48 w-29 object-cover" :src="imagePreview" alt="Product Image 1">
            </div>
            
          
          
        </div>
  
       
        <!-- Submit Button -->
        <div>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Submit</button>
        </div>
      </form>
    </div>
  </template>

  
  
  <script>

import axios from 'axios';
  
  export default {
    data() {
      return {
        errors: {},
        product: {
           
        },

        image: null,
        imagefile: null,
        imagePreview : '',
      }
    },

    mounted(){
        const productid =  this.$route.params.id;
        this.getCategory();
        
        this.getProduct(productid);
      
    },


    methods: {
      handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
          this.imagefile = file;
          this.image = URL.createObjectURL(file);
        }
      },
      addFeature() {
        this.features.push('');
      },
      removeFeature(index) {
        this.features.splice(index, 1);
      },
      validateForm() {
        this.errors = {};
        if (!this.product.name) this.errors.title = 'Title is required.';
        if (!this.product.image) this.errors.image = 'Image is required.';
        return Object.keys(this.errors).length === 0;
      },
      async handleSubmit() {
        if (this.validateForm()) {
          const formData = new FormData();
          formData.append('title', this.product.name);
          if(this.imagefile != null){
            formData.append('image', this.imagefile);
          }
          
          const productid = this.$route.params.id;
          
          const response = await axios.post(`/api/update-product/${productid}`, formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });

           if(response.data.status == 'success'){
            this.$router.push({ path: '/products'});
           }
           
        }
      },

      async getCategory(){

        const response = await axios.get('/api/categories');

        this.categories = response.data.data;
       
      },


      async getProduct(productid){

        if(productid){
            const response = await axios.get(`/api/product/${productid}`);

            this.product = response.data.data;
            this.imagePreview = response.data.data.image;
        }
       

      }
    },
  }
  </script>
  
  <style scoped>
  /* Add any additional custom styles here */
  </style>
  

