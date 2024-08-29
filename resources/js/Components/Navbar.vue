<template>
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
              <img class="h-8 w-8" src="" alt="Logo">
            </div>
  
            <!-- Navigation Links -->
            <div class="hidden sm:-my-px sm:ml-6 sm:flex space-x-4">
              <router-link to="/" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                Home
              </router-link>
              <router-link to="/products" class="text-gray-900 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                Products
              </router-link>
              
            </div>
          </div>
  
          <!-- Add Product Button -->
          <div class="flex items-center">
            <router-link to="/create-product" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">
              Add Products
            </router-link>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  export default {
    name: 'Navbar',
  };
  </script>
  
  <style scoped>
  /* Add any additional styling here if needed */
  </style>
  