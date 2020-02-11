<template>
<div class="card mb-3">
            <div class="card-header">
          <i class="fas fa-table"></i>
            Crea, actualiza, elimina proveedores</div>
            <div class="card-body">
            <form>
          <div class="form-group">
          <label for="name">Proveedor</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="supplier.name" class="form-control" placeholder="Nombre" required="required" autofocus="autofocus">
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
          <div class="card-header">
          <i class="fas fa-table"></i>
            Proveedores registrados</div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
            supplier: {
                name: null,
            },
            idxLista: null,
            idx: null,
        };
    },
    methods: {
        save: function() {
            let self = this;
            axios.post("/proveedores/save", this.supplier)
                .then(response => {
                    swal('Agregado correctamente');
                    self.list.push(response.data);
                    self.idx = response.data.id;
                })
                .catch(error => {
                   swal('Error', "Datos incorrectos");
                });
        },
        update: function() {
            let self = this;
            axios.post("/proveedores/update", { supplier: this.supplier, id: this.idx, name: this.supplier.name })
                .then(response => {
                    swal('Actualizado correctamente');
                    console.log(response.data);
                    self.list[this.idxLista].name = response.data.name;
                })
                .catch(error => {
                    swal('Error');
                });
        },
        dele: function() {
            let self = this;
            axios.post("/proveedores/delete", {
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
            console.log(elemento,index)
            this.idxLista = index;
            this.idx = elemento.id;
            this.supplier.name = elemento.name;
            
        },
       
    }
};
</script>