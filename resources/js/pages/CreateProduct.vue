<template>
    <div class="max-w-2xl mx-auto p-4">
      
      <h2 class="mb-2"><strong>Add Product</strong></h2>
      <hr>
      
      <form @submit.prevent="handleSubmit" class="space-y-4 mt-3">
        <!-- Title -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input
            v-model="title"
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
            required
          />
          <div v-if="imagePreview" class="mt-2">
            <img :src="imagePreview" alt="Image Preview" class="w-full h-auto rounded-md shadow-md"/>
          </div>
          <p v-if="errors.image" class="text-red-500 text-sm">{{ errors.image }}</p>
        </div>
  
        <!-- Categories -->
        <div class="w-full md:w-80">
          <label for="" class="block text-sm font-medium text-gray-700">Select Categories</label>
          <div v-for="(category, index) in categories" :key="category.id" class="field-checkbox">
            <input

              type="checkbox"
              :value="category.id"
              v-model="selectedCategories"
              :id="category"
            />
            <label class="ml-2 d-flex relative" :for="category.name"> <span>{{ category.name }}</span> <span @click="deleteCategory(category.id,index)" class="absolute bottom-0 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c-4.419 0-8 3.582-8 8s3.581 8 8 8s8-3.582 8-8s-3.581-8-8-8m3.707 10.293a.999.999 0 1 1-1.414 1.414L12 13.414l-2.293 2.293a.997.997 0 0 1-1.414 0a1 1 0 0 1 0-1.414L10.586 12L8.293 9.707a.999.999 0 1 1 1.414-1.414L12 10.586l2.293-2.293a.999.999 0 1 1 1.414 1.414L13.414 12z"/></svg></span> </label>
            
          </div>
        </div>
  
        <!-- Features -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Features</label>
          <div v-for="(feature, index) in features" :key="index" class="flex items-center space-x-2 mb-2">
            <input
              v-model="features[index]"
              type="text"
              class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            <button type="button" @click="removeFeature(index)" class="text-red-500">Remove</button>
          </div>
          <button type="button" @click="addFeature" class="text-blue-500">Add More</button>
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
        title: '',
        image: null,
        imagePreview: null,
        selectedCategories: [],
        categories: [],
        features: [''],
        errors: {},
      }
    },

    mounted(){

      this.getCategory();
    },


    methods: {
      handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
          this.image = file;
          this.imagePreview = URL.createObjectURL(file);
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
        if (!this.title) this.errors.title = 'Title is required.';
        if (!this.image) this.errors.image = 'Image is required.';
        return Object.keys(this.errors).length === 0;
      },
      async handleSubmit() {
        if (this.validateForm()) {
          const formData = new FormData();
          formData.append('title', this.title);
          formData.append('image', this.image);
          formData.append('categories', this.selectedCategories);
          formData.append('features', this.features);


          const response = await axios.post('/api/store-product', formData, {
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

      async deleteCategory(categoryid,index){
          if(categoryid){

            if (confirm("Delete Category will delete related products. Proceed?")){
              const response = await axios.delete(`/api/delete-category/${categoryid}`);

              if(response.data.status == 'success'){
                  alert('Category deleted successfully!');
                  this.categories.splice(index, 1);
              }
            }
          }
        }
    },
  }
  </script>
  
  <style scoped>
  /* Add any additional custom styles here */
  </style>
  

