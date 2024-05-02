import Accueil from './components/accueil.vue';
import slider from './components/slider.vue';
import produit from './components/produit.vue';
import produit_des from './components/produit_des.vue';
import filter from './components/filter.vue';

import register from './components/userlogin/register.vue';
import formulaireVente from './components/VendeurPages/formulaireVente.vue';
import validerProduit from './components/Admin/validerProduit.vue';
import listCategorie from './components/Admin/categorie/listCategorie.vue';
import ListSousCategorie from './components/Admin/sCategorie/listSousCategorie.vue';
import Ban from './components/ban.vue';
import UserList from './components/Admin/userList.vue';
import introuvable from './components/introuvable.vue';

export const routes = [
{
name: '/',
path: '/',
component: slider
},
{
   name: '/filter',
   path: '/filter',
   component: filter
   },
{
 name: '/produit',
 path: '/produit',
 component: produit,
},
{
   name: '/register',
   path: '/register',
   component: register,
},
{
    name: 'sellform',
    path: '/sellform',
    component: formulaireVente,
 },
 {
    name: 'adminvalide',
    path: '/validerProduit',
    component: validerProduit,
 },
 {
   name: 'categorie',
   path: '/listCateg',
   component: listCategorie,
},
{
   name: 'desc',
   path: '/desc/:id/:idencher/:prix',
   component: produit_des,
},
{
   name: 'listSouscateg',
   path: '/listSousCategorie/:id',
   component: ListSousCategorie,
},
{
   name: 'ban',
   path: '/ban/:suspendedDate',
   component: Ban,
},
{
   name: 'user',
   path: '/user',
   component: UserList,
},
{
   path: '/:pathMatch(.*)*',
   component: introuvable
}


];