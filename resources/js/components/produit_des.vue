<template>
  <Menu class="sticky-header" />
  <br><br><br><br>
  <section class="intro-single" style="margin-top: -5%"></section>
  <!-- End Intro Single-->

  <!-- ======= Property Single ======= -->
  <section class="property-single nav-arrow-b" style="margin-top: -10%">
      <div class="container">
          <div class="row">
            <div class="col-lg-6">
                  <!-- Property Image Carousel -->
                  <div id="property-single-carousel" class="swiper">
                      <div class="swiper-wrapper">
                          <div class="carousel-item-b swiper-slide">
                              <img
                                  :src="produit.Image"
                                  alt=""
                                  style="width: 500px;height: 400px;"
                              />
                          </div>
                          <!-- You can add more images here if needed -->
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="">
                      <div class="card-body">
                          <h1 class="title-single" style="text-align: center">
                              Détail du produit
                          </h1>
                          <h1 class="title-single" style="text-align: center">
                          </h1>
                          <div class="property-summary">
                              <ul class="list">
                                  <li class="d-flex justify-content-between">
                                      <strong>nom produit</strong>
                                      <span>   {{ produit.nomProduit }}</span>
                                  </li>
                                  <li class="d-flex justify-content-between">
                                      <strong>date fin:</strong>
                                      <span>{{ produit.delaitFin }}</span>
                                  </li>
                                  <!-- Include other attributes as needed -->
                              </ul>
                          </div>
                          <div class="title-box-d">
                              <h3 class="title-d">
                                  Description du produit :
                              </h3>
                          </div>
                          <div >
                              <p class="description color-text-a">
                                  {{ produit.description }}
                              </p>
                          </div>
                          <div class="title-box-d">
                              <h3>
                                  {{ prixActuelle }} DT
                              </h3>
                          </div>
                          <div >
                            <h3>tu peut enchrer ?</h3>
                            <button class="btn btn-success" @click="encher()"> enchére </button>

                          </div>
                    
                      </div>
                  </div>
              </div>
           
          </div>
      </div>
  </section>

             
  <!-- End Property Single-->
</template>

<script setup>
import Menu from "./menu.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute , useRouter } from "vue-router";

const produit = ref({});
const encheres = ref([]);
const route = useRoute();
const prixActuelle = route.params.prix;
const router = useRouter()
const getProduit = async () => {
  try {
    const response = await axios.get(
      `http://localhost:8000/api/produits/${route.params.id}`
    );
    produit.value = response.data;
    // Récupérer les données de l'enchère lors du chargement du produit
  } catch (error) {
    console.error("Error fetching product:", error);
  }
};




const encher = async () => {

  try {
    const id = route.params.idencher;
    const iduser = localStorage.getItem("userId");
    const prixnouveau = prixActuelle * 1.1;
    const response = await axios.put(
      `http://localhost:8000/api/Encherer/${id}/${iduser}/${prixnouveau}`
    );
    router.push({ name: '/' })
  } catch (error) {
    console.error("Error fetching encheres:", error);
  }
};
onMounted(() => {
  getProduit();
});
</script>

<style lang="scss" scoped>
/* Add your scoped styles here */
.property-single {
  .row {
      align-items: center;
  }
}
</style>
