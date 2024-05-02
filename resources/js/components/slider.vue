<template>
  <Menu class="sticky-header" />
  <br><br>
  <div class="slider">
    <div class="slide" v-for="(item, index) in slides" :key="index" :class="{ active: currentIndex === index }"
      :style="{ height: '500px', width: '100%' }">
      <img :src="item.image" alt="Slide">

      <div class="overlay-text">
        <p class="intro-title-top"></p>
        <h1 class="intro-title mb-4">
          <span class="color-b"></span>
        </h1>
        <p class="intro-subtitle intro-price">
        </p>
      </div>
    </div>
    <button class="prev" @click="prevSlide">&#10094;</button>
    <button class="next" @click="nextSlide">&#10095;</button>
  </div>
  <br><br>
  <section class="cour">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Nos Services</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-cart"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Enchérir</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                EnchérirEnLigne est une plateforme de vente aux enchères en ligne.
                Hidh-Tech,Electroménager,Matériel,professionnel,Auto-Moto,Loisirs,Mobilier,Immobilier et bien plus
                encore.
              </p>
            </div>

          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-universal-access-circle"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Accessibilité</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Accessible à tous le monde
                Enchèrir dès maintenant, il est devenu plus facile et plus rapide avec EnchérirEnLigne.
              </p>
            </div>
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="bi bi-stopwatch"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">Disponibilité </h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                Disponibilité 24h/24 et 7j/7 :
                Absolument ! Avec les enchères en ligne, vous avez la liberté d'enchérir à tout moment et de n'importe
                où.
              </p>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <br><br><br>
  <br><br><br>
  <section class="property-grid grid" style="margin-top: -7%">
    <div class="property-carousel">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="carousel-wrapper">
              <div class="carousel-slide" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                <div class="col-md-4" id="cour" v-for="enchere in filteredEncheres" :key="enchere.id">
                  <div class="card-box-a card-shadow">
                    <div class="img-box-a">
                      <img :src="enchere.image" alt="" class="img-a img-fluid" style="height: 25rem; width: 55rem" />
                    </div>
                    <div class="card-overlay">
                      <div class="card-overlay-a-content">
                        <div class="card-header-a">
                          <h2 class="card-title-a">
                            <a href="#">
                              <br /> {{ enchere.nomProduit }}</a>
                          </h2>
                        </div>
                        <div class="card-body-a">
                          <div class="price-box d-flex">
                            <span class="price-a">Prix : DT
                              {{ enchere.prixActuelle }}</span>
                          </div>

                          <h4 style="color: blanchedalmond">
                            Date Fin :
                          </h4>
                          <span style="color: blanchedalmond">{{ enchere.dateFin }}
                          </span>
                        </div>
                        <div class="card-body-a">



                          <router-link
                            :to="{ name: 'desc', params: { id: enchere.idProduit, idencher: enchere.id, prix: enchere.prixActuelle }, }"
                            class="btn btn-success">Detail produit </router-link>



                        </div>
                        <div class="card-footer-a">
                          <ul class="card-info d-flex justify-content-around">
                            <li>
                              <h4 class="card-info-title">user </h4>
                              <span>encherer</span>
                            </li>
                            <li>
                              <h4 class="card-info-title">name </h4>
                              <span>name :{{ enchere.name }}
                              </span>
                            </li>
                            <li>
                              <h4 class="card-info-title">lastName </h4>
                              <span>{{ enchere.lastName }}</span>
                            </li>


                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <button class="prev" @click="prevSlide">&#10094;</button>
              <button class="next" @click="nextSlide">&#10095;</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <Footer />
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import Menu from './menu.vue';
import axios from 'axios';
import Footer from './footer.vue';

const encheres = ref([]);
const produits = ref([]);
const users = ref([]);



const slides = [
  {
    image: 'img/5.jpg'
  },
  {
    image: 'img/6.png'
  }
];
const currentIndex = ref(0);
const intervalId = ref(null);
const intervalDuration = 5000; // Change slide every 5 seconds

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
      lastName: user ? user.lastName : null,
      name: user ? user.name : null,
      user_id: enchere.user_id
    };
  });
});

const filteredEncheres = computed(() => {
  const currentDate = new Date();
  return encheresWithProduits.value.filter((enchere) => {
    const enchereDate = new Date(enchere.dateFin);
    return enchereDate > currentDate;
  });
});



const encher = async (id, prix) => {
  try {
    const iduser = localStorage.getItem('userId');
    prix = prix * 1.1;
    const response2 = await axios.get(`http://localhost:8000/api/encheres/${id}`);
    const responseData = response2.data;
    const user = responseData.user_id
    if (user != iduser) {
      toast("is changing");
    }
    const response = await axios.put(`http://localhost:8000/api/Encherer/${id}/${iduser}/${prix}`);
    window.location.reload();
  } catch (error) {
    console.error("Error placing bid:", error);
  }
};

function startSlider() {
  intervalId.value = setInterval(nextSlide, intervalDuration);
}

function stopSlider() {
  clearInterval(intervalId.value);
}

function prevSlide() {
  stopSlider();
  currentIndex.value = (currentIndex.value - 1 + slides.length) % slides.length;
  startSlider();
}

function nextSlide() {
  stopSlider();
  currentIndex.value = (currentIndex.value + 1) % slides.length;
  startSlider();
}

onMounted(() => {
  startSlider();

  fetchData();
});

onUnmounted(() => {
  stopSlider();
});
</script>

<style scoped>
.carousel-wrapper {
  position: relative;
  overflow: hidden;
  margin-right: 10px;
  /* Adjust as needed */

}

.carousel-slide {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.card-box-a {
  flex: 0 0 33.33%;
}

.card-overlay {
  position: relative;
}

#cour {
  margin-right: 10px;
  /* Adjust as needed */
}


.intro-title-top{
 color: black; 
}


.card-info {

  display: flex;
}


button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(124, 121, 121, 0.048);
  color: white;
  border: none;
  cursor: pointer;
  padding: 10px;
  z-index: 100;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}

.slider {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.slide {
  display: none;
}

.slide.active {
  display: block;
}

img {
  width: 100%;
  height: auto;
}

.overlay-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  color: aliceblue;
}

button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(124, 121, 121, 0.048);
  color: white;
  border: none;
  cursor: pointer;
  padding: 10px;
  z-index: 100;
}

.prev {
  left: 0;
}

.next {
  right: 0;
}
</style>