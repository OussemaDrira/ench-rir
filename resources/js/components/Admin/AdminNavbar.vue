<template>
    <!-- ======= Header/Navbar ======= -->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top" >
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a class="navbar-brand text-brand" href="index.html" style="margin-left: -7%;">Enchérir <img :src="image" id="logo" />
                <span class="color-b">En ligne</span></a>


            <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                <ul class="navbar-nav">

                    <li class="nav-item"  >
                        <router-link to="/user" class="nav-link"
                            :class="{ 'active': $route.path === '/user' }" style="font-size:22px;">Utilisateur</router-link>
                    </li>

                    <li class="nav-item" >
                        <router-link class="nav-link " :class="{ 'active': $route.path === '/validerProduit' }"
                            to="/validerProduit" style="font-size:22px;">Gérer les demandes</router-link>
                    </li>

                    <li class="nav-item" >

                        <router-link class="nav-link" :class="{ 'active': $route.path === '/listCateg' }"
                            to="/listCateg" style="font-size:22px;">Gestion de categorie</router-link>
                    </li>


                    <li class="nav-item dropdown" >
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:22px;">Compte</a>
                        <div class="dropdown-menu">
                            <button class="dropdown-item " type="button" @click="handleLogout">
Se déconnecter</button>

                        </div>
                    </li>
                    <li>
                        <button @click="toggleMenu" class="toolbar-button" style="margin-left: 85%; margin-right: 5%;">
                            <div v-if="user" style="display: flex; align-items: center;">
                                <img :src="user.photoURL" class="avatar mr-0 mr-sm-16"
                                    style="border-radius: 50px; width: 40px;height: 40px;">
                                <span class="username mx-12" v-show="$mq.gt.sm">{{ user.displayName }}</span>
                                <i class="s-16" v-show="$mq.xs">keyboard_arrow_down</i>
                            </div>
                        </button>
                    </li>
                </ul>
            </div>

            <button @click="togglePanel" type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse"
                data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </nav><!-- End Header/Navbar -->

</template>
<script>
import image from "../../../../public/img/encherirLogo2.jpeg"
import axios from 'axios';
export default {

    data() {
        return {
            isPanelOpen: true,
            image: image
        };
    },
    methods: {
        togglePanel() {
            this.isPanelOpen = !this.isPanelOpen;
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
    },

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
    }
};
</script>
<style>
@import '../../vendor/animate.css/animate.min.css';
@import '../../vendor/bootstrap/css/bootstrap.min.css';
@import '../../vendor/bootstrap-icons/bootstrap-icons.css';
@import '../../vendor/swiper/swiper-bundle.min.css';
@import '../../css/style.css';


#logo {

    border-color: black;
    width: auto;
    height: 2cm;
}
</style>
<style scoped>
.toolbar-button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  outline: none;
}

.avatar {
  vertical-align: middle;
}

.username {
  font-size: 16px;
}

.s-16 {
  font-size: 16px;
}

@media only screen and (max-width: 600px) {
  .username {
    display: none;
  }
}
</style>
