<template>
   <input type="submit"
        class="btn btn-sm d-block w-100 mb-2 btn-outline-danger mr-1 d-block"
        value="ELIMINAR"
        v-on:click="eliminarReceta"
        >
</template>

<script>
export default {

    props: ['recetaId'],

    mounted() {
    },

    methods: {
        eliminarReceta() {
          this.$swal({
            title: 'Deseas eliminar la receta?',
            text: "Una vez eliminada no se podra recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    const params = {
                        id: this.recetaId
                    }

                    axios.post(`/recetas/${this.recetaId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal({
                                title: 'Receta eliminada',
                                text: 'Se eliminó la receta',
                                icon: 'success'
                            })

                            // Elimino del dom el elemento

                            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        })
                        .catch(error => {
                            console.error(error);
                        })

                }
            })
        }
    }

}
</script>
