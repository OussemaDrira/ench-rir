<template>
    <AdminNavbar />
    <br><br> <br><br>
    <AdSousCategorie :id="route.params.id" />
    <div class="card" style="margin-top: -3%;">
        <DataTable v-model:filters="filters" :value="Scategories" paginator showGridlines :rows="10" dataKey="id"
                filterDisplay="menu" :loading="loading" >
           
            <template #empty> No Sous Categories found. </template>
            <template #loading> Loading Sous Categorie data. Please wait. </template>
            <Column field="nomSCategorie" header="nom Sous Categorie" style="min-width: 12rem">
                <template #body="{ data }">
                    {{ data.nomSCategorie }}
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by name of sous Categorie" />
                </template>
            </Column>


            <Column  header="Action" style="min-width: 12rem">
                <template #body="{ data }">
                    <div class="d-flex align-items-center">
                    <modSousCategorie :form="data" />
                
                <button type="button" class="btn btn-warning rounded-circle ml-2" @click="deleteSCategory(data.id)">
                    <span style="color: rgb(245, 5, 5)">
                        <i class="fa-solid fa-trash"></i>

                    </span>
                </button>
            </div>
                </template>
                
            </Column>
            
        </DataTable>
    </div>
</template>

<script setup>
import DataTable from "primevue/datatable";
import axios from "axios";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import modSousCategorie from "./modSousCategorie.vue";
import InputText from "primevue/inputtext";
import AdminNavbar from '../AdminNavbar.vue';
import AdSousCategorie from "./adSousCategorie.vue";
import { FilterMatchMode, FilterOperator } from 'primevue/api';


const filters = ref();

import { useRouter,useRoute } from 'vue-router';

const router = useRouter() ;
const route = useRoute();

const Scategories = ref([]);

const isLoading = ref(true);

const initFilters = () => {
    filters.value = {
        
        nomSCategorie: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] }
        
    };
};
initFilters();

const getSCategories = async () => {
    try {
        const response = await axios.get(
            `http://localhost:8000/api/getSC/${route.params.id}`
        );
        Scategories.value = response.data;
        isLoading.value = false;
    } catch (error) {
        console.error("Erreur lors de la récupération des Sous catégorie catégories:", error);
    }
};


const deleteSCategory = async (id) => {
    if (window.confirm("Etes-vous sûr de supprimer cette sous categorie ?")) {
        try {
            await axios.delete(`http://localhost:8000/api/s_categories/${id}`);

            getSCategories();
        } catch (error) {
            console.log(error);
        }
    }
};



  onMounted(() => {
    getSCategories();   })
</script>

<style lang="css" scoped></style>
