<template>
     <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
       
          <div class="widget-a" id="gg">
            <div class="w-header-a" >
              <div>
              <h3 class="w-title-a text-brand">Enchérir en ligne</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
               EnchérirEnLigne est une plateforme qui offre à ses clientèles des services de haute qualité dans le domaine de vente en ligne.
              </p>
            </div>
          </div>
            <div>
              <img src="../../../public/img/ench.png"/>
            </div>
          </div>
       
        </div>
    
        
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <router-link to="/" class="list-inline-item" >Accueil</router-link>
              </li>
              <li class="list-inline-item">
                <router-link to="/filter" class="list-inline-item" >Produits</router-link>
              </li>
              <li class="list-inline-item">
                <router-link to="/sellform" class="list-inline-item" >
Demandes_vente</router-link>
              </li>
              
            </ul>
          </nav>
          
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">EnchérirEnLigne</span> All Rights Reserved.
            </p>
          </div>
          <div class="credits">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
          -->
          </div>
        </div>
      </div>
    </div>
  </footer><!-- End  Footer -->

  
</template>

<script setup>

</script>

<style>
a{
    text-decoration: none;
    color:black;
}
#gg{
  display: flex;
  width: 1000px;
  padding-left: 100px;
}
</style>