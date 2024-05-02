<template>
    <div>
        <section class="page_404">
            <div class="container1">
                <div class="row">	
                    <div class="col-sm-12 ">
                        <div class="col-sm-10 col-sm-offset-1  text-center">
                            <div class="four_zero_four_bg">
                                <h1 class="text-center ">403</h1>
                            </div>
                            <div class="contant_box_404">
                                <h3 class="h2">
                                    Tu es Banni
                                </h3>
                                <p>Votre ban finit le {{ suspendedDate }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
const route = useRoute();

const suspendedDate = ref('');

onMounted(() => {
    suspendedDate.value = new Date(route.params.suspendedDate).toLocaleDateString();
});
</script>

<style lang="scss">
.page_404 {
    padding: 0px 0;
    background: #fff;
    font-family: 'Arvo', serif;
    margin-top: 5%;
    margin-left: 7%;
}

.four_zero_four_bg {
    background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
    background-size: cover; /* Ajout de cette propriété pour couvrir toute la largeur */
}

.four_zero_four_bg h1 {
    font-size: 80px;
}

.four_zero_four_bg h3 {
    font-size: 80px;
}

.link_404 {			 
    color: #fff !important;
    padding: 10px 20px;
    background: #39ac31;
    margin: 20px 0;
    display: inline-block;
}

.contant_box_404 { 
    margin-top: 5%;
}
h2{
    margin-top: 4%;
}
</style>
