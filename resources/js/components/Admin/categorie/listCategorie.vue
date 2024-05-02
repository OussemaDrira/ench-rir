<template>
        
    
      <AdminNavbar />
      <br><br>
      <br><br>
      <Addcategorietable />
      <DataTable v-model:filters="filters" :value="categories" paginator :rows="5" dataKey="id" filterDisplay="row" :loading="loading"
        :globalFilterFields="['nomCategorie']">
    <template #header>
        <div class="flex justify-content-end">
            <span class="p-input-icon-left">
                <i class="pi pi-search" />
                <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
            </span>
        </div>
    </template>
    <template #empty> No categorie found. </template>
    <template #loading> Loading categorie data. Please wait. </template>
   

    <Column field="nomCategorie" header="nomCategorie" style="min-width: 12rem">
        <template #body="{ data }">
            {{ data.nomCategorie }}
        </template>
        <template #filter="{ filterModel, filterCallback }">
            <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter" placeholder="Search by name" />
        </template>
    </Column>






    <Column header="Liste Sous Catégorie" style="min-width: 5rem">

        <template #body="{ data }">
            <router-link :to="{name: 'listSouscateg', params: { id: data.id }}" class="btn rounded-circle" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;">
                <span style="text-align: center;"><i class="fa fa-eye" aria-hidden="true"></i></span>

                
            </router-link>
        </template>
    </Column>








    <Column header="Méthode" style="min-width: 12rem">
        <template #body="{ data }">
            <div class="d-flex align-items-center">
                <modifiercategorie :form="data" />
                
                <button type="button" class="btn btn-warning rounded-circle ml-2" @click="deleteCategory(data.id)">
                    <span style="color: rgb(245, 5, 5)">
                        <i class="fa-solid fa-trash"></i>

                    </span>
                </button>
            </div>
        </template>
    </Column>

</DataTable>
      
    
  </template>

<script setup>
import DataTable from "primevue/datatable";
import axios from "axios";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import { FilterMatchMode } from "primevue/api";
import modifiercategorie from "./modCategorie.vue";
import InputText from "primevue/inputtext";
import Addcategorietable from "./adCategorie.vue";
import AdminNavbar from '../AdminNavbar.vue';

const categories = ref([]);
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    nomCategorie: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});
const isLoading = ref(true);

const getCategories = async () => {
    try {
        const response = await axios.get(
            "http://localhost:8000/api/categories"
        );
        categories.value = response.data;
        isLoading.value = false;
    } catch (error) {
        console.error("Erreur lors de la récupération des catégories:", error);
    }
};

onMounted(() => {
    getCategories();
});
const deleteCategory = async (id) => {
    if (window.confirm("Etes-vous sûr de supprimer ce categorie ?")) {
        try {
            await axios.delete(`http://localhost:8000/api/categories/${id}`);

            getCategories();
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style lang="css" scoped></style>
