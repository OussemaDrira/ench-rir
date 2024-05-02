<template>
  <Menu/>
  <article class="az">
    <div class="container" :class="{'sign-up-active' : signUp}">
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-left">

            <h2>Create account !</h2>
            <div id="registerTemplate">
    <div class="form-group">
        <label for="name">
            <i class="fas fa-user"></i> Nom
        </label>
        <input type="text" placeholder="Enter your name" name="name" v-model="user.name" class="form-control" required>
    </div>


    <div class="form-group">
        <label for="name">
            <i class="fas fa-user"></i> Prénom
        </label>
        <input type="text" placeholder="Enter your name" name="name" v-model="user.lastName" class="form-control" required>
    </div>



    <div class="form-group">
        <label for="email">
            <i class="fas fa-envelope"></i> Email
        </label>
        <input type="email" placeholder="Enter your email" name="email" v-model="user.email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">
            <i class="fas fa-lock"></i> Mot de passe
        </label>
        <input type="password" placeholder="Enter your password" name="password" v-model="user.password" class="form-control" required>
    </div>
    <input type="hidden" name="role" v-model="user.role">
    <div class="form-group">
        <label for="telephone">
            <i class="fas fa-phone"></i> Telephone
        </label>
        <input type="text" placeholder="Enter your telephone number" name="telephone" v-model="user.telephone" class="form-control">
    </div>
    <div class="form-group">
        <label for="adresse">
            <i class="fas fa-map-marker-alt"></i> Addresse
        </label>
        <input type="text" placeholder="Enter your address" name="adresse" v-model="user.adressse" class="form-control">
    </div>
</div>

            <button class="invert"  @click="handleSubmit">creér </button>
          </div>
          <div class="overlay-right">
            <h2>Salut, mon ami </h2>
            <p>Veuillez saisir vos coordonnées personnelles</p>
            <button class="invert" id="signUp" @click="signUp = !signUp">Sign Up</button>
          </div>
        </div>
      </div>
      <form class="sign-up" action="#">
       <h2>Enchérir <span class="gree">en ligne</span></h2>
      </form>
      <form class="sign-in" @submit.prevent="handleLogin">
        <h2>Login</h2>
        <div>Accéder a votre compte</div>
        <input type="email" placeholder="Email" v-model="user1.email" required autofocus autocomplete="off" />
        <input type="password" placeholder="Password" v-model="user1.password" required autocomplete="off"/>
      
        <button type="submit" >Login</button>
      </form>
    </div>
  </article>
</template>


<script setup>
import axios from "axios";
import { useRouter } from "vue-router";
import Menu from "../menu.vue";
import { ref } from 'vue';

const user1 = {
  email: "",
  password: ""
};

const signUp = ref(false);

const user = {
  name: "",
  lastName: "",
  email: "",
  password: "",
  telephone: "",
  adressse: "",
  role: "Acheteur"
};

const router = useRouter();

const handleSubmit = () => {
  axios
    .post('http://localhost:8000/api/register/', user)
    .then((response) => {
      console.log(response.data);
      signUp.value = false;
    })
    .catch((error) => {
      console.error(error);
    });
};

const handleLogin = () => {
  axios.post('http://localhost:8000/api/login/', user1)
    .then((response) => {
      localStorage.setItem('user', response.data.user.name);
      localStorage.setItem('userId', response.data.user.id);
      localStorage.setItem('token', response.data.token);
      if (response.data.user.role == "admin") {
        router.push("/validerProduit");
      } else {
        router.push("/");
      }
    })
    .catch(err => {
      if (err.response && err.response.status === 403) {
        const suspendedDate = new Date(err.response.data.user.suspended_until);
        const suspendedDateString = suspendedDate.toISOString();
        const encodedSuspendedDate = encodeURIComponent(suspendedDateString);
        router.push(`/ban/${encodedSuspendedDate}`);
      } else {
        alert("Une erreur s'est produite lors de la connexion.");
      }
    });
};
</script>


<style lang="scss" scoped>
.gree{
  color: #27b368;
}
.az{
  padding-top: 10%;
}
  .container {
    position: relative;
    width: 1000px;
    height: 700px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, .2),
                0 10px 10px rgba(0, 0, 0, .2);
    background: linear-gradient(to bottom, #ccc, #ccc);

    .overlay-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: transform .5s ease-in-out;
      z-index: 100;
    }

    .overlay {
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      background: url("https://www.village-notaires-patrimoine.com/IMG/arton1459.jpg?1678272144");
      color: #19570c;
      transform: translateX(0);
      transition: transform .5s ease-in-out;
    }

    @mixin overlays($property) {
      position: absolute;
      top: 0;
      display: flex;
      align-items: center;
      justify-content: space-around;
      flex-direction: column;
      padding: 70px 40px;
      width: calc(50% - 80px);
      height: calc(100% - 140px);
      text-align: center;
      transform: translateX($property);
      transition: transform .5s ease-in-out;
    }

    .overlay-left {
      @include overlays(-20%);
      margin-top: -7%;
      padding-top: 20%;
    }

    .overlay-right {
      @include overlays(0);
      right: 0;
    }
  }
  .overlay-right p{
    color:#093d21;
    font-size: 20px;
  }
  h2 {
    margin: 0;
  }

  p {
    margin: 20px 0 30px;
  }

  a {
    color: #222;
    text-decoration: none;
    margin: 15px 0;
    font-size: 1rem;
  }

  button {
    border-radius: 20px;
    border: 1px solid #19570c;
    background-color: #fff;
    color: #19570c;
    font-size: 1rem;
    font-weight: bold;
    padding: 10px 40px;
    letter-spacing: 1px;
    text-transform: uppercase;
    cursor: pointer;
    transition: transform .1s ease-in;

    &:active {
      transform: scale(.9);
    }

    &:focus {
      outline: none;
    }
  }

  button.invert {
    background-color: transparent;
    border-color: #fff;
  }

  form {
    position: absolute;
    top: 0;
    display: flex;
    align-items: center;
    justify-content: space-around;
    flex-direction: column;
   
    padding-left: 10%;
    width: calc(50% - 120px);
    height: calc(100% - 180px);
    text-align: center;
    background: linear-gradient(to bottom, #ccc, #ccc);
    transition: all .5s ease-in-out;

    div {
      font-size: 1rem;
    }

    input {
      background-color: #eee;
      border: none;
      padding: 8px 15px;
      margin: 6px 0;
      width: calc(100% - 30px);
      border-radius: 15px;
      border-bottom: 1px solid #ddd;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, .4), 
                        0 -1px 1px #fff, 
                        0 1px 0 #fff;
      overflow: hidden;

      &:focus {
        outline: none;
        background-color: #fff;
      }
    }
  }

  .sign-in {
    left: 0;
    z-index: 2;
  }

  .sign-up {
    left: 0;
    z-index: 1;
    opacity: 0;
  }

  .sign-up-active {
    .sign-in {
      transform: translateX(100%);
    }

    .sign-up {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: show .5s;
    }

    .overlay-container {
      transform: translateX(-100%);
    }

    .overlay {
      transform: translateX(50%);
    }

    .overlay-left  {
      transform: translateX(0);
    }

    .overlay-right {
      transform: translateX(20%);
    }
  }

  @keyframes show {
    0% {
      opacity: 0;
      z-index: 1;
    }
    49% {
      opacity: 0;
      z-index: 1;
    }
    50% {
      opacity: 1;
      z-index: 10;
    }
    
  }
  /* Example CSS for form styling */
.form-group {
    margin-bottom: 0%;
    
}
label {
    display: block;
    margin-bottom: 5px;
}
input[type="text"],
input[type="email"],
input[type="password"],
input[type="telephone"] {
    width: 100%;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

</style>