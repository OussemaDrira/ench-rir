<template>
  <br /><br /><br /><br /><br /><br /><br><br><br><br>
  <section class="property-grid grid" style="margin-top: -7%">
      <div class="container">
          <div class="row">
              <div
                  class="col-md-3"
                  v-for="enchere in filteredEncheres"
                  :key="enchere.id"
              >
                  <div class="card-box-a card-shadow">
                      <div class="img-box-a">
                          <img
                              :src="enchere.image"
                              alt=""
                              class="img-a img-fluid"
                              style="height: 300px; width: 300px"
                          />
                      </div>
                      <div class="card-overlay">
                          <div class="card-overlay-a-content">
                              <div class="card-header-a">
                                  <h2 class="card-title-a">
                                      <a href="#">
                                          <br />
                                          {{ enchere.nomProduit }}</a
                                      >
                                  </h2>
                              </div>
                              <div class="card-body-a">
                                  <div class="price-box d-flex">
                                      <span class="price-a"
                                          >Prix : DT
                                          {{ enchere.prixActuelle }}</span
                                      >
                                  </div>
                                  <li>
                                      <h4 style="color: blanchedalmond">
                                          Date Fin :
                                      </h4>
                                      <span style="color: blanchedalmond"
                                          >{{ enchere.dateFin }}
                                      </span>
                                  </li>
                                 <router-link
                :to="{
                  name: 'desc',
                  params: { id: enchere.idProduit ,idencher:enchere.id, prix:enchere.prixActuelle},
                }"
                class="btn btn-success"
                >description_prod  
              </router-link>
              
                                  <button class="btn btn-success" @click="encher(enchere.id,enchere.prixActuelle)"> enchére </button>
                              </div>
                              <div class="card-footer-a"  >
                    <ul class="card-info d-flex justify-content-around" >
                      <li>
                        <h4 class="card-info-title">nom</h4>
                        <span>{{ enchere.name }}
                        </span>
                      </li>
                      <li>
                        <h4 class="card-info-title">pérnom </h4>
                        <span>{{ enchere.lastName }}</span>
                      </li>
                   
                     
                    </ul>
                  </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted,watch, defineProps  } from "vue";
import axios from "axios";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useRouter } from 'vue-router';

const router = useRouter();

const encheres = ref([]);
const produits = ref([]);
const users = ref([]);
const props = defineProps({
  searchQuery: String
});

watch(() => props.searchQuery, (newValue) => {
  // Perform search based on the new value
  search(newValue);
});

const search = (query) => {
  // Implement search functionality here
  console.log('Searching for:', query);
};

const fetchData = async () => {
  try {
    const [encheresResponse, produitsResponse, usersResponse] = await Promise.all([
      axios.get("http://localhost:8000/api/encheres"),
      axios.get("http://localhost:8000/api/produits"),
      axios.get("http://localhost:8000/api/users")
    ]);

    encheres.value = encheresResponse.data.map((enchere) => ({
      ...enchere,
      users: usersResponse.data.filter((user) => user.id === enchere.user_id)
    }));
    produits.value = produitsResponse.data;
    users.value = usersResponse.data;
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

const encheresWithProduits = computed(() => {
  return encheres.value.map((enchere) => {
    const produit = produits.value.find((p) => p.id === enchere.produit_id);
    const user = users.value.find((p) => p.id === enchere.user_id);

    return {
      id: enchere.id,
      prixActuelle: enchere.prixActuelle,
      idProduit: produit ? produit.id : "Unknown",
      nomProduit: produit ? produit.nomProduit : "Unknown",
      description: produit ? produit.description : "Unknown",
      image: produit ? produit.Image : null,
      prixInitial: produit ? produit.prixIntialee : null,
      dateFin: produit ? produit.delaitFin : null,
      statut: produit ? produit.statut : null,
      lastName:user ?user.lastName :null,
      name:user ? user.name: null,
      user_id: enchere.user_id
    };
  });
});

const filteredEncheres = computed(() => {
  const currentDate = new Date();
  const query = props.searchQuery ? props.searchQuery.toLowerCase().trim() : '';
  if (!query) {
    return encheresWithProduits.value.filter((enchere) => {
      const enchereDate = new Date(enchere.dateFin);
      return enchereDate > currentDate;
    });
  } else {
    return encheresWithProduits.value.filter((enchere) => {
      const enchereDate = new Date(enchere.dateFin);
      return (
        enchereDate > currentDate &&
        (enchere.nomProduit.toLowerCase().includes(query) ||
        enchere.description.toLowerCase().includes(query))
      );
    });
  }
});




const encher = async (id, prix) => {
  try {
    const iduser = localStorage.getItem('userId');
    prix = prix * 1.1;
    const response2 = await axios.get(`http://localhost:8000/api/encheres/${id}`);
    const responseData = response2.data;
    const user=responseData.user_id
    if(user!=iduser)
    {
        toast("c'est votre chance");
    }
    const response = await axios.put(`http://localhost:8000/api/Encherer/${id}/${iduser}/${prix}`);
    window.location.reload();
  } catch (error) {
    console.error("Error placing bid:", error);
  }
};

onMounted(() => {
  fetchData();
});
</script>
