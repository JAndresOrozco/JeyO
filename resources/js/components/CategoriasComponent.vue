<template>
<div class="card mb-3">
                <div class="card-header">
          <i class="fas fa-table"></i>
            Crea, actualiza, elimina categorias</div>
            <div class="card-body">
            <form>
          <div class="form-group">
          <label for="name">Nombre</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="category.name" class="form-control" placeholder="Nombre" required="required" autofocus="autofocus">
            </div>
          </div>
          <div class="form-group">
          <label for="description">Descripción</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="category.description" class="form-control" placeholder="Descripción" required="required" autofocus="autofocus">
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
          <div class="card-header">
          <i class="fas fa-table"></i>
            Categorias registradas</div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.name }}</td>
                    <td>{{ elemento.description }}</td>

                  </tr>
                </tbody>
              </table>
            </div>
            </div>




    </div>

</template>
<script>
    export default {
    props: ["datos"],
    mounted() {
        this.list = JSON.parse(this.datos);
    },
    data() {
        return {
            list: null,
            category: {
                name: null,
                description: null
            },
            idxLista: null,
            idx: null
        };
    },
    methods: {
        save: function() {
            let self = this;
            axios.post("/categorias/save", this.category)
                .then(response => {
                    swal('Agregado correctamente');
                    self.list.push(response.data);
                    self.idx = response.data.id;
                })
                .catch(error => {
                   let er = error.response.data.errors;
                    let mensaje;
                    if(er.hasOwnProperty('name')){
                        mensaje = "Campo nombre vacio";
                    }else if(er.hasOwnProperty('description')){
                      mensaje= "Campo descripción vacio";
                    }
                    swal('Error', mensaje)
                });
        },
        update: function() {
            let self = this;
            axios.post("/categorias/update", {id: this.idx, name: this.category.name, description: this.category.description })
                .then(response => {
                    swal('Actualizado correctamente');
                    console.log(response.data);
                    self.list[self.idxLista].name = response.data.name;
                    self.list[self.idxLista].description = response.data.description;
                })
                .catch(error => {
                    let er = error.response.data.errors;
                    let mensaje;
                    if(er.hasOwnProperty('name')){
                        mensaje = "Campo nombre vacio";
                    }else if(er.hasOwnProperty('description')){
                      mensaje= "Campo descripción vacio";
                    }
                    swal('Error', mensaje)
                });
        },
        dele: function() {
            let self = this;
            axios.post("/categorias/delete", {
                    id: this.idx
                })
                .then(response => {
                    swal('Eliminado');
                    console.log(response.data);
                    self.list.splice(self.idxLista, 1);
                })
                .catch(error => {
                    swal('Error');
                });
        },
        load: function(elemento, index) {
            console.log(elemento,index);
            this.idx = elemento.id;
            this.category.name = elemento.name;
            this.category.description = elemento.description;
            this.idxLista = index;
            console.log(this.idx);

        },

    }
};
</script>
