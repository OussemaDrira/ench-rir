<template>
  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top" >
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.html" style="margin-left: -8%;">Enchérir <img :src="image" id="logo" />
        <span class="color-b">En ligne</span></a>

        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                <ul class="navbar-nav">

                    <li class="nav-item itemNav">
                        <router-link to="/" class="nav-link" :class="{ 'active': $route.path === '/' }"
                            style="font-size:19px;">Accueil</router-link>
                    </li>

                    <li class="nav-item itemNav">
                        <router-link to="/filter" class="nav-link " :class="{ 'active': $route.path === '/filter' }"
                            style="font-size:19px;">Produits</router-link>
                    </li>

                    <li class="nav-item itemNav">

                        <router-link class="nav-link" to="/sellform" :class="{ 'active': $route.path === '/sellform' }"
                            style="font-size:19px;">Demande_vente</router-link>
                    </li>

              
                    <li class="nav-item itemNav">
                        <!-- Utilisez une condition pour afficher le nom d'utilisateur ou le lien de connexion -->
                        <template v-if="isAuthenticated">
                            <!-- Affiche le nom d'utilisateur -->
                        </template>
                        <template v-else>
                            <!-- Affiche le lien de connexion -->
                            <router-link class="nav-link" to="/register" style="font-size:19px;">Login </router-link>
                        </template>
                    </li>

                    <li class="nav-item dropdown itemNav">
                        <template v-if="isAuthenticated">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            style="font-size:19px;">{{ user.name }}</a>
                        </template>
                        <template v-else>
                            <!-- Affiche le lien de connexion -->
                           
                        </template>
                       
                        <div class="dropdown-menu">
                            
                            <template v-if="isAuthenticated">
                                <!-- <button type="button" class="dropdown-item " onclick="handleLogout()">
                                    Se déconnecter</button> -->
                                <button class="dropdown-item " type="button" @click="handleLogout">Se
                                    déconnecter</button>
                            </template>
                            <template v-else>
                                <router-link to="/register" style="font-size:19px;" class="dropdown-item ">
                                        se connecter</router-link>
                            </template>
                        </div>
                    </li>
                </ul>
            </div>
      <div class="d-flex">
        <input 
    type="text" 
    class="form-control me-2" 
    placeholder="Search..." 
    aria-label="Search"
    v-model="searchQuery"
    @input="emitSearchQuery"
  >  
    <button @click="togglePanel" type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </div>
  </nav><!-- End Header/Navbar -->

</template>
<script>
import image from "../../../public/img/encherirLogo2.jpeg"
import axios from 'axios';
import { ref } from 'vue';

export default {

data() {
    return {
        isAuthenticated: false,
        isPanelOpen: true,
        image: image,
        searchQuery: '',

        user: {
            name: "",
        }

    };
},
methods: {
    togglePanel() {
        this.isPanelOpen = !this.isPanelOpen;
    }
    ,
    handleLogin() {
        console.log('fffffff' + this.user1);
        axios
            .post('http://localhost:8000/api/login/', this.user1)
            .then((response) => {
                console.log(response.data);

                localStorage.setItem('user', response.data.user.name)
                localStorage.setItem('userId', response.data.user.id)
                localStorage.setItem('token', response.data.token)
                console.log(response.data.user.role)
                if (response.data.user.role == "admin") {
                    this.$router.push("/dashbord");
                }
                else {
                    this.$router.push("/");
                }

            })
            .catch(err => {

                console.log(err);
                alert(err)
            })
    },
    handleLogout() {
        let token = localStorage.getItem('token');
        console.log(token);
        axios.post('http://localhost:8000/api/logout', null, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
            .then((response) => {
                console.log(response);
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                this.$router.push("/register");
            })
            .catch(err => {
                console.log(err);
                alert(err);
            });
    },    emitSearchQuery() {
      // Emit an event named 'search' with the search query as payload
      this.$emit('search', this.searchQuery);
    }


},
mounted() {
    const bootstrapScript = document.createElement('script');
    bootstrapScript.src = '../vendor/bootstrap/js/bootstrap.bundle.min.js';
    document.body.appendChild(bootstrapScript);

    // Charger Swiper après avoir monté le composant
    const swiperScript = document.createElement('script');
    swiperScript.src = '../vendor/swiper/swiper-bundle.min.js';
    document.body.appendChild(swiperScript);

    // Charger le validateur de formulaire PHP Email après avoir monté le composant
    const validateScript = document.createElement('script');
    validateScript.src = '../vendor/php-email-form/validate.js';
    document.body.appendChild(validateScript);

    // Votre script principal
    const mainScript = document.createElement('script');
    mainScript.src = '../js/main.js';
    document.body.appendChild(mainScript);


    const token = localStorage.getItem("token");
    if (token) {
        // Si un jeton est trouvé, l'utilisateur est authentifié
        this.isAuthenticated = true;
        const userName = localStorage.getItem("user");
        this.user.name = userName;
    }


}
};
</script>
<style>
@import '../vendor/animate.css/animate.min.css';
@import '../vendor/bootstrap/css/bootstrap.min.css';
@import '../vendor/bootstrap-icons/bootstrap-icons.css';
@import '../vendor/swiper/swiper-bundle.min.css';
@import '../css/style.css';


#logo {

  border-color: black;
  width: auto;
  height: 2cm;
}
</style>