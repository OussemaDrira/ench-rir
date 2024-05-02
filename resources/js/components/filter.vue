<template>
    <div>
      <Menu @search="updateSearchQuery" />
      <Produit :search-query="searchQuery" />
      <Footer/>
    </div>
  </template>
  
  <script setup>
  import Menu from './menu.vue';
  import Produit from './produit.vue';
  import { ref } from 'vue';
  import Footer from './footer.vue';

  // Define a ref to hold the search query
  const searchQuery = ref('');
  
  const updateSearchQuery = (query) => {
    searchQuery.value = query;
  };
  </script>
  