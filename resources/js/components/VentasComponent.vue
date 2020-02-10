<template>
<div class="card mb-3">
            <div class="card-header">
          <i class="fas fa-table"></i>
            Crea, actualiza, elimina ventas</div>
            <div class="card-body">
            <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="" v-model="sale.saledetail_id" class="form-control" placeholder="Folio" required="required" autofocus="autofocus">
              <label for="folio">Folio</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text"v-model="sale.user_id" id="" class="form-control" placeholder="Usuario" required="required">
              <label for="usuario">Usuario</label>
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
          <div class="card-header">
          <i class="fas fa-table"></i>
            Historial de ventas</div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Folio</th>
                    <th>Usuario</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.saledetail }}</td>
                    <td>{{ elemento.user }}</td>
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
    props: ["datos", "salesdetails", "users"],
    mounted() {
        this.list = JSON.parse(this.datos);
        console.log(this.list);
        this.listSalesdetails = JSON.parse(this.salesdetails);
        console.log(this.listSalesdetails);
        this.listUsers = JSON.parse(this.users);
        console.log(this.listUsers);
    },
    data() {
        return {
            list: null,
            listSalesdetails: null,
            listUsers: null,
            sale: {
                saledetail: null,
                user: null,
            },
            idxLista: null,
            idx: null
        };
    },
    methods: {
        save: function() {
            let self = this;
              axios.post("/ventas/save", this.sale)
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
            axios.post("/ventas/update", { sale: this.sale, id: this.idx })
                .then(response => {
                    swal('Actualizado correctamente');
                    console.log(response.data);
                    self.list = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        dele: function() {
            let self = this;
            axios.post("/ventas/delete", {
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
            this.idxLista = index;
            this.idx = elemento.id;
            this.sale.saledetail_id = elemento.saledetail_id;
            this.sale.user_id = elemento.user_id;
       
        },
  
        
    }
};
</script>