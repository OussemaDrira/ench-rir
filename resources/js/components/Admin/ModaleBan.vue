<template>
  <div class="card flex justify-content-center">
    <Button type="button" @click="visible = true" class="p-button-danger p-button-rounded"
      style="width: 40px; height: 40px;">
      <i class="fa-solid fa-ban" style="color: white;"></i>
    </Button>
  </div>

  <form>
    <div class="card flex justify-content-center">
      <Dialog v-model:visible="visible">
        <div class="row">
          <div class="col-md-12">
            <label for="date" class="form-label">Banner Jusqu'à :</label>
            <input type="date" class="form-control" id="date" v-model="date">
          </div>
        </div>


        <br />
        <button type="submit" className="btn btn-outline-primary" @click="bannerUser()">
          <i class="fa-solid fa-floppy-disk"></i>Enregister
        </button>
        <button type="button" className="btn btn-outline-primary" @click="cancel">
          <i class="fa-solid fa-floppy-disk"></i>cancel
        </button>
      </Dialog>
    </div>
  </form>

</template>

<script setup>
import { ref, defineProps } from 'vue';
import axios from 'axios';
import Dialog from 'primevue/dialog';

const visible = ref(false);
const props = defineProps(['user'])
console.log(props.user.id)

const date = ref('');



const bannerUser = async (id) => {
  try {
    const response = await axios.put(
      `http://localhost:8000/api/Banner/${props.user.id}`,
      { suspended_until: date.value }
    );
    visible.value = false;
  } catch (error) {
    console.error("Erreur lors de la mise à jour de la bannière:", error);
  }
};
</script>

<style scoped>
.card {
  margin: 20px;
}

.fa-ban {
  color: white;
}

.p-button-danger {
  background-color: red;
  border: none;
}

.p-button-rounded {
  border-radius: 50%;

}

.p-button-danger {
  background-color: red;
  /* Couleur de fond rouge pour indiquer le danger */
  color: white;
  /* Texte en blanc pour un meilleur contraste */
  border: none;
  /* Suppression de la bordure */
}

.p-button-borderless {
  border: none;
  /* Suppression de la bordure */
}
</style>