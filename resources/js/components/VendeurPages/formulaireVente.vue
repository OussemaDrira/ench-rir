<template>
    <Menu class="sticky-header" />
    <br><br>
    <div class="container" id="mainId">
        <div class="card-header">
            <i class="far fa-solid fa-hammer fa-lg fa-spin"></i>
            <b>Demande pour déposer un produit à l'enchère</b>
        </div>
        <form id="myform" @submit.prevent="addProduit">
            
            <div style="padding: 20px;">
                <div class="row"> <!-- Ajoutez une classe "row" parente -->
                    <div class="form-group col-md-6" >
                            <label for="scategorie" ><i class="fa-solid fa-list"></i> Catégorie:</label>
                            <select class="form-control" v-model="sellRequest.scategorieID" placeholder="choix du catégorie"  style="margin-top: 10px;">
                                <option class="form-control"  v-for="sc in scategories" :key="sc.id" :value="sc.id" >{{sc.nomSCategorie}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description"><i class="fa-brands fa-product-hunt"></i> Nom du produit:</label>
                            <input type="text" class="form-control" id="nomProduit" name="nomProduit" placeholder="Entrer nom Produit" v-model="sellRequest.nomProduit" style="margin-top: 10px;">
                        </div>
                </div>
                <div class="row"> <!-- Ajoutez une classe "row" parente -->
                    <div class="form-group col-md-6">
                        <label for="prixIntlee"ia> <i class="fa-solid fa-money-bill-1-wave"></i> Prix Initial:</label>
                        <input type="number" class="form-control" id="prixIntialee" name="prixIntialee" placeholder="Entrer le prix initial" v-model="sellRequest.prixIntialee" style="margin-top: 10px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dateFin"><i class="fa-solid fa-calendar-days"></i> Date Fin:</label>
                        <input type="date" class="form-control" id="dateFin" name="dateFin" placeholder="fixer Date Fin" v-model="sellRequest.delaitFin" style="margin-top: 10px;">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description"><i class="fa-solid fa-audio-description"></i> Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Entrer une description" v-model="sellRequest.description"></textarea>
                </div>


                <div class="form-group" style="margin-top: 1%;">
                    <div>
                        <label for="Image"><i class="fa-solid fa-image"></i> Image:</label>
                        <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..." allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles" v-on:init="handleFilePondInit" :server="serverOptions()"/>
                    </div>
                </div>


                
              
            </div>
            <div class="card-footer d-flex flex-row-reverse">
                <button class="btn btn-dark">Soumis la demande</button>
                <button type="button" class="btn btn-dark" style="margin-right:4px;">Retour à l'accueil <i class="fas fa-home"></i></button>
            </div>
        </form>

    


    </div>
    <Footer/>
</template>

<script setup>
import Footer from '../footer.vue';

import {ref,onMounted} from "vue";
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter() 
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import Menu from '../menu.vue';
// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);

const user= localStorage.getItem('user')

let idUser=localStorage.getItem('userId')
console.log(idUser)
let scategories=ref([])



const sellRequest=ref(
    {   
        nomProduit:"",
        description:"",
        Image:"",
        prixIntialee:0,
        delaitFin:"",
        statut:"non approuvé",
        user_id:idUser,
        scategorieID:""

    }
)

const serverOptions = () => { console.log('server pond');
return {
process: (fieldName, file, metadata, load, error, progress, abort) => {
const data = new FormData();
    data.append('file', file);
    data.append('upload_preset', 'projetWeb');
    data.append('cloud_name', 'dimj6qkuf');
    data.append('public_id', file.name);
    axios.post('https://api.cloudinary.com/v1_1/dimj6qkuf/image/upload',
    data)
    .then((response) => response.data)
    .then((data) => {
  

    sellRequest.Image= data.url;
    sellRequest.value.Image= data.url;
  
    load(data);
    })
    .catch((error) => {
    console.error('Error uploading file:', error);
    error('Upload failed');
    abort();
    });
    },
    };
    };

    const getScategories=()=>{
    
    axios.get('http://localhost:8000/api/s_categories').then(res => {
        scategories.value = res.data;
    }).catch(error => {
    console.log(error)
    });
    
    }

    onMounted(() => {
        getScategories();
    })
    if(user ===null)
    {
        router.push({ name: '/register' }) 
    }
    
    const addProduit = async () => {
        console.log(sellRequest.value)
    try {
        console.log("hello");
      await axios.post("http://localhost:8000/api/produits/", sellRequest.value);
      router.push({ name: '/' })      
      
    } catch (error) {}
  };
</script>

<style>

.main {
  animation-duration: 2s;
  animation-delay: 1s;
  animation-iteration-count: infinite;
}

.main-speed {
  animation-duration: 0.5s;
  animation-delay: 1s;
  animation-iteration-count: infinite;
}

.has-error label.error {
  color: red;
  font-weight: bolder;
}
.bg{
    background-color: rgb(45, 196, 39);
}
#mainId{
    padding-top: 7%;
}

</style>