<template>
<div class="card mb-3">
            <div class="card mb-3">
                <div class="card-header">
          <i class="fas fa-table"></i>
            Crea, actualiza, elimina ventas</div>
            <div class="card-body">
            <form>
          <div class="form-group">
          <label for="name">Folio del producto</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="sale.product_id" class="form-control" placeholder="Nombre" required="required" autofocus="autofocus">
            </div>
          </div>
         
          <div class="form-group">
          <label for="quantity">Cantidad</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="sale.quantity" class="form-control" placeholder="Cantidad" required="required" autofocus="autofocus">
            </div>
          </div>
          <div class="form-group">
          <label for="price">Precio</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="sale.price" class="form-control" placeholder="Precio" required="required" autofocus="autofocus">
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
          <div class="card-header">
          <i class="fas fa-table"></i>
            Detalle de ventas</div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.product }}</td>
                    <td>{{ elemento.quantity }}</td>
                    <td>{{ elemento.price }}</td>
                
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
    props: ["datos", "products"],
    mounted() {
        this.list = JSON.parse(this.datos);
        console.log(this.list);
        this.listProducts = JSON.parse(this.products);
        console.log(this.listProducts);
    },
    data() {
        return {
            list: null,
            listProducts: null,
            sale: {
                quantity: null,
                price: null,
                product_id: null,
            },
            idxLista: null,
            idx: null
        };
    },
    methods: {
        save: function() {
            let self = this;
            axios.post("/detalleventas/save", this.sale)
                .then(response => {
                    swal('Agregado correctamente');
                    self.list.push(response.data);
                    self.idx = response.data.id;
                })
                .catch(error => {
                   let er = error.response.data.errors;
                    let mensaje;
                    if(er.hasOwnProperty('quantity')){
                        mensaje = "Campo cantidad vacio";
                    }else if(er.hasOwnProperty('price')){
                      mensaje = "Campo precio vacio";
                    }else if(er.hasOwnProperty('product_id')){
                      mensaje = "Campo producto vacio";
                    }
                    swal('Error', mensaje)
                });
        },
        update: function() {
            let self = this;
            axios.post("/detalleventas/update", { sale: this.sale, id: this.idx, price: this.sale.price, quantity: this.sale.quantity, product_id: this.sale.product_id})
                .then(response => {
                    swal('Actualizado correctamente');
                    console.log(response.data);
                    self.list = response.data;
                })
                .catch(error => {
                    let er = error.response.data.errors;
                    let mensaje;
                    if(er.hasOwnProperty('quantity')){
                        mensaje = "Campo cantidad vacio";
                    }else if(er.hasOwnProperty('price')){
                      mensaje = "Campo precio vacio";
                    }else if(er.hasOwnProperty('product_id')){
                      mensaje = "Campo folio de producto vacio";
                    }
                    swal('Error', mensaje)
                });
        },
        dele: function() {
            let self = this;
            axios.post("/detalleventas/delete", {
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
            console.log(elemento, index);
            this.idxLista = index;
            this.idx = elemento.id;
            this.sale.quantity = elemento.quantity;
            this.sale.price = elemento.price;
            this.sale.product_id = elemento.product_id;
    
        },
        
    }
};
</script>