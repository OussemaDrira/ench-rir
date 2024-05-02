
<template>
    <AdminNavbar />
    <br><br> <br><br>
    <div class="card" >
        <DataTable v-model:filters="filters" :value="produits" paginator showGridlines :rows="10" dataKey="id"
                filterDisplay="menu" :loading="loading" :globalFilterFields="[ 'user.name','user.lastName', 'scategories.nomSCategorie']">
            <template #header>
                <div class="flex justify-content-between">
                    <Button type="button" icon="pi pi-filter-slash" label="Clear" outlined @click="clearFilter()" />
                    <IconField iconPosition="left">
                        <InputIcon>
                            <i class="pi pi-search" />
                        </InputIcon>
                        <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                    </IconField>
                </div>
            </template>
            <template #empty> No products found. </template>
            <template #loading> Loading pr data. Please wait. </template>
            <Column field="Image" header="Image" style="min-width: 12rem">
                <template #body="{ data }">
                    <Image :src="data.Image" alt="Image" width="150" preview/>


                </template>
                
            </Column>


            <Column header="Nom Produit" filterField="nomProduit" style="min-width: 12rem">
                <template #body="{ data }">
                    
                    <span v-if="data.user">{{ data.nomProduit }}</span>
                    <span v-else>N/A</span>
                    
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by country" />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button type="button" icon="pi pi-times" @click="filterCallback()" severity="secondary">clear</Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button type="button" icon="pi pi-check" @click="filterCallback()" severity="success">Apply</Button>
                </template>
                <template #filterfooter>
                    <div class="px-3 pt-0 pb-3 text-center">Customized Buttons</div>
                </template>
            </Column>





            <Column header="Nom Utilisateur" filterField="user.name" style="min-width: 12rem">
                <template #body="{ data }">
                    
                    <span v-if="data.user">{{ data.user.name }}</span>
                    <span v-else>N/A</span>
                    
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by country" />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button type="button" icon="pi pi-times" @click="filterCallback()" severity="secondary">clear</Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button type="button" icon="pi pi-check" @click="filterCallback()" severity="success">Apply</Button>
                </template>
                <template #filterfooter>
                    <div class="px-3 pt-0 pb-3 text-center">Customized Buttons</div>
                </template>
            </Column>



            <Column header="Nom Utilisateur" filterField="user.lastName" style="min-width: 12rem">
                <template #body="{ data }">
                    
                    <span v-if="data.user">{{ data.user.lastName }}</span>
                    <span v-else>N/A</span>
                    
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by country" />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button type="button" icon="pi pi-times" @click="filterCallback()" severity="secondary">clear</Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button type="button" icon="pi pi-check" @click="filterCallback()" severity="success">Apply</Button>
                </template>
                <template #filterfooter>
                    <div class="px-3 pt-0 pb-3 text-center">Customized Buttons</div>
                </template>
            </Column>




            
            <Column header="Date" filterField="delaitFin" dataType="date" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ formatDate(data.delaitFin) }}
                </template>
                <template #filter="{ filterModel }">
                    <Calendar v-model="filterModel.value" dateFormat="yyyy-mm-dd" placeholder="yyyy/mm/dd" mask="9999-99-99" />
                </template>

            </Column>

            <Column header="Sous categorie" filterField="scategories.nomSCategorie" style="min-width: 12rem">
                <template #body="{ data }">
                    
                    <span v-if="data.scategories.nomSCategorie">{{ data.scategories.nomSCategorie }}</span>
                    <span v-else>N/A</span>
                    
                </template>
                <template #filter="{ filterModel }">
                    <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by country" />
                </template>
                <template #filterclear="{ filterCallback }">
                    <Button type="button" icon="pi pi-times" @click="filterCallback()" severity="secondary">clear</Button>
                </template>
                <template #filterapply="{ filterCallback }">
                    <Button type="button" icon="pi pi-check" @click="filterCallback()" severity="success">Apply</Button>
                </template>
                <template #filterfooter>
                    <div class="px-3 pt-0 pb-3 text-center">Customized Buttons</div>
                </template>
            </Column>


            <Column header="Prix initiale" filterField="prixIntialee" dataType="numeric" style="min-width: 10rem">
                <template #body="{ data }">
                    {{ formatCurrency(data.prixIntialee) }}
                </template>
                <template #filter="{ filterModel }">
                    <InputNumber v-model="filterModel.value" mode="currency" currency="dnt" />
                </template>
            </Column>

            <Column header="Action">
                <template #body="{ data }">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-success btn-circle" @click="DeclencherEnchere(data.id)">
                            <i class="fas fa-check"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-circle" style="margin-left:4%;" @click="refuser(data.id)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </template>
            </Column>

            


           
        </DataTable>
    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import AdminNavbar from './AdminNavbar.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

import Button from 'primevue/button';

import InputText from 'primevue/inputtext';

import InputNumber from 'primevue/inputnumber';

import Calendar from 'primevue/calendar';


import Image from 'primevue/image';
import axios from 'axios';

const produits = ref([]);








const filters = ref();

const loading = ref(true);

onMounted(() => {
    getProduits();
    loading.value=false;
});


const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        'user.name': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        'user.lastName': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },

        'nomProduit': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
        delaitFin: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.DATE_IS }] }, 
        prixIntialee: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] },
        'scategories.nomSCategorie': { operator: FilterOperator.OR, constraints: [{ value: null, matchMode: FilterMatchMode.EQUALS }] },
        
    };
};

initFilters();

const formatDate = (value) => {
    if (value) {
        // Convertir la chaîne de date en objet Date
        const date = new Date(value);
        // Extraire les composants de la date (année, mois, jour)
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        // Formater la date dans le format souhaité
        return `${month}/${day}/${year}`;
    } else {
        return ''; // Ou une autre valeur par défaut si nécessaire
    }
};



const formatCurrency = (value) => {
    return value.toLocaleString('fr-TN', { style: 'currency', currency: 'TND' });
};
const clearFilter = () => {
    initFilters();
};
const getProduits = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/ProduitNonApprouve");
    produits.value = response.data;
    
  } catch (error) {
    console.error(error);
  }
};


const refuser = async (id) => {
  try {
    const response = await axios.put(`http://localhost:8000/api/RefuseProduit/${id}`);
    window.location.reload();
  } catch (error) {
    console.error(error);
  }
};
const DeclencherEnchere = async (id) => {
    try {
        const user_id = await axios.get(`http://localhost:8000/api/getUserByProduct/${id}`);
        const prixActuelle = await axios.get(`http://localhost:8000/api/getPriceByProduct/${id}`);
        
        const Encheres = {
            user_id: user_id.data,
            prixActuelle: prixActuelle.data,
            produit_id: id,
            statut:"en cours"
        };

        console.log(Encheres);

        const response = await axios.put(`http://localhost:8000/api/changerStatu/${id}`);
        await axios.post("http://localhost:8000/api/encheres/", Encheres);

        window.location.reload();
    } catch (error) {
        console.error(error);
    }
};


</script>
<style>
.card{
    margin-top: 3%;
}


</style>