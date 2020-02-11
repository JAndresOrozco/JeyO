<template>
<div class="card mb-3">
<div class="card-header">
          <i class="fas fa-table"></i>
            Crea, actualiza, elimina productos</div>
            <div class="card-body">
            <form>
          <div class="form-group">
          <label for="name">Nombre</label>
            <div class="form-label-group">
              <input type="text" id="" v-model="product.name" class="form-control" placeholder="Nombre" required="required" autofocus="autofocus">
            </div>
          </div>
          <div class="form-group">
          <label for="email">Descripción</label>
            <div class="form-label-group">
              <input type="text"v-model="product.description" id="" class="form-control" placeholder="Descripción" required="required">
            </div>
          </div>
          <div class="form-group">
          <label for="category">Categoria</label>
            <div class="form-label-group">
              <input type="text" v-model="product.category_id" id="" class="form-control" placeholder="Categoria" required="required">
            </div>
          </div>
          <div class="form-group">
          <label for="price">Precio</label>
            <div class="form-label-group">
              <input type="text" v-model="product.price" id="" class="form-control" placeholder="Precio" required="required">
            </div>
          </div>
          <div class="form-group">
              <label for="supplier">Proveedor</label>
            <div class="form-label-group">
              <input type="text" v-model="product.supplier_id" id="" class="form-control" placeholder="Proveedor" required="required">
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
          <div class="card-header">
          <i class="fas fa-table"></i>
            Productos en inventario</div>

            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Proveedor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.name }}</td>
                    <td>{{ elemento.description }}</td>
                    <td>{{ elemento.category }}</td>
                    <td>{{ elemento.price }}</td>
                    <td>{{ elemento.supplier }}</td>
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
    props: ["datos", "categories", "suppliers"],
    mounted() {
        this.list = JSON.parse(this.datos);
        console.log(this.list);
        this.listCategories = JSON.parse(this.categories);
        console.log(this.listCategories);
        this.listSuppliers = JSON.parse(this.suppliers);
        console.log(this.listSuppliers);
    },
    data() {
        return {
            list: null,
            listCategories: null,
            listSuppliers: null,
            product: {
                name: null,
                description: null,
                category_id: null,
                price: null,
                supplier_id: null,
            },
            idxLista: null,
            idx: null
        };
    },
    methods: {
        save: function() {
            let self = this;
            axios.post("/productos/save", this.product)
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
     
            axios.post("/productos/update", { product: this.product, id: this.idx 
            , name: this.product.name, description: this.product.description, category_id: this.product.category_id,
            price: this.product.price, supplier_id: this.product.supplier_id
            })
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
            axios.post("/productos/delete", {
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
            this.product.name = elemento.name;
            this.product.description = elemento.description;
            this.product.price = elemento.price;
            this.product.category_id = elemento.category_id;
            this.product.supplier_id = elemento.supplier_id;
          
        },
      
    }
};
</script>