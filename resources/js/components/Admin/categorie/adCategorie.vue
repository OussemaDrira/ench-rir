<template>
    <nav class="navbar navbar-expand-lg navbar-dark " style="margin-top: 4%;">
    
    
    <div class="container-fluid">
    
    <button type="button" class="btn btn-warning rounded-circle" @click="visible = true">
    
    <span style="color: rgb(33, 43, 27)">
    <i class="fa-solid fa-square-plus"> </i>
    </span>
    New
    </button>
    </div>
    </nav>
    <form >
    <div class="card flex justify-content-center">
    <Dialog v-model:visible="visible">
    
    <div class="row">
    <div class="col-md-12">
    <label for="nomCategorie" class="form-label">Nom Categorie</label>
    
    <input type="text" class="form-control" id="nomCategorie" v-model="categ.nomCategorie">
    
    </div>
   
    </div>
    <br/>
    
    
    
    <button type="submit" className="btn btn-outline-primary" @click="addcategorie">
    <i class="fa-solid fa-floppy-disk"></i>Enregister
    </button>
    <button type="button" className="btn btn-outline-primary"
    
    @click="cancel">
    <i class="fa-solid fa-floppy-disk"></i>cancel
    </button>
    </Dialog>
    </div>
    </form>
    </template>
    
    <script setup>
    import { ref,onMounted } from "vue"
    import axios from "axios";

    import Dialog from 'primevue/dialog';
import AdminNavbar from "../AdminNavbar.vue";

    

    
    // Create FilePond component
   
   
    const visible = ref(false);
    const categ=ref({
    nomCategorie:"",
    
    })
   
    
     
    const addcategorie=async()=>{
    await axios.post("http://localhost:8000/api/categories/",categ.value)
    .then(() => {
        window.location.reload();

   })

    
    .catch(err => console.log(err))
    }
    onMounted(() => {
    
    }
    
    );
    
   
  
    </script>
    <style scoped>
   
    </style>