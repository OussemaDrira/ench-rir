<template>
  <AdminNavbar />
  <div class="card">
    <DataTable v-model:filters="filters" :value="users" paginator showGridlines :rows="10" dataKey="id"
      filterDisplay="menu" :loading="loading" :globalFilterFields="['name', 'lastName', 'email', 'telephone']">
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
      <template #empty>No user found.</template>
      <template #loading>Loading user data. Please wait.</template>

      <Column header="Nom Utilisateur" filterField="name" style="min-width: 12rem">
        <template #body="{ data }">
          <span>{{ data.name || 'N/A' }}</span>
        </template>
        <!-- Rest of the column configuration -->
      </Column>

      <Column header="Prénom Utilisateur" filterField="user.lastName" style="min-width: 12rem">
        <template #body="{ data }">
          <span>{{ data.lastName || 'N/A' }}</span>
        </template>
        <!-- Rest of the column configuration -->
      </Column>

      <Column header="email Utilisateur" filterField="user.email" style="min-width: 12rem">
        <template #body="{ data }">
          <span>{{ data.email || 'N/A' }}</span>
        </template>
        <!-- Rest of the column configuration -->
      </Column>

      <Column header="telephone" filterField="user.telephone" style="min-width: 12rem">
        <template #body="{ data }">
          <span>{{ data.telephone || 'N/A' }}</span>
        </template>
        <!-- Rest of the column configuration -->
      </Column>

      <Column field="id" header="Blocker" style="min-width: 12rem">
        <template #body="val">
          <div class="d-flex">
            <ModaleBan :user="val.data" />
            
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
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import axios from 'axios';
import ModaleBan from './ModaleBan.vue';

const users = ref([]);
const filters = ref();
const loading = ref(true);

const getUsers = async () => {
  try {
    const response = await axios.get("http://localhost:8000/api/ListUser");
    users.value = response.data;
    loading.value = false;
  } catch (error) {
    console.error("Erreur lors de la récupération des utilisateurs:", error);
  }
};

const clearFilter = () => {
  filters.value.global.value = null;
};

const initFilters = () => {
  filters.value = {
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    'name': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    'lastName': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    'telephone': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    'email': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] }
  };
};

initFilters();
onMounted(getUsers);
</script>

<style>
.card {
  margin-top: 3%;
}
</style>