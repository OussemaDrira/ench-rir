<template>
    <button
        type="button"
        class="btn btn-warning rounded-circle"
        @click="visible = true"
    >
        <span style="color: rgb(233, 240, 241)">
            <i class="fa-solid fa-pen-to-square"></i>
        </span>
    </button>
    <form>
        <div class="card flex justify-content-center">
            <Dialog v-model:visible="visible">
                <div class="row">
                    <div class="col-md-12">
                        <label for="nomCategorie" class="form-label">nomCategorie</label>

                        <input type="text" class="form-control" id="nomCategorie" v-model="categorie.nomCategorie"/>
                    </div>
                </div>
                <br />
                <button
                    type="submit"
                    className="btn btn-outline-primary"
                    @click="modifiercategorie"
                >
                    <i class="fa-solid fa-floppy-disk"></i>Enregister
                </button>
                <button
                    type="button"
                    className="btn btn-outline-primary"
                    @click="cancel"
                >
                    <i class="fa-solid fa-floppy-disk"></i>cancel
                </button>
            </Dialog>
        </div>
    </form>
</template>
<script setup>
import { ref, onMounted, defineProps } from "vue";
import axios from "axios";
import Dialog from "primevue/dialog";

const props = defineProps(["form"]); 
const visible = ref(false);
const categorie = ref({});

const loadcategorie = () => {
    console.log(props.form);
    categorie.value = props.form;
    console.log(categorie.value);

};

onMounted(() => {
    
    loadcategorie();
    
    
});

const modifiercategorie = () => {
    axios
        .put(
            `http://localhost:8000/api/categories/${categorie.value.id}`,
            categorie.value
        )
        .then(() => {
            visible.value = false;
        })
        .catch((error) => {
            console.error("There was an error!", error);
        });
};

const cancel = () => {
    visible.value = false;
};

const getcategories = async () => {
    await axios
        .get("http://localhost:8000/api/categories/")
        .then((res) => {
            categorie.value = res.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>
<style scoped></style>
