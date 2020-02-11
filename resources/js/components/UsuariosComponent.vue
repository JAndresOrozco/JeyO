<template>
<div class="card mb-3">
<input type="button" value="Cerrar Sesión" class="btn btn-danger" v-on:click="logout">
<div class="card-header">
<i class="fas fa-table"></i>
            Activa/Desactiva Token</div>
    <div class="card-body">
          <form>
          <input type="button" value="Activar" class="btn btn-primary" v-on:click="activetoken">
          <input type="button" value="Desactivar" class="btn btn-primary" v-on:click="inactiveToken">
          </form>

          </div>

            <div class="card-header">

          <i class="fas fa-table"></i>
            Crea, actualiza, elimina usuarios</div>
            <div class="card-body">
            <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="" v-model="user.username" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus">
              <label for="username">Usuario</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text"v-model="user.email" id="" class="form-control" placeholder="Correo electrónico" required="required">
              <label for="email">Correo Electrónico</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" v-model="user.password" id="" class="form-control" placeholder="Contraseña" required="required">
              <label for="password">Contraseña</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" v-model="user.status" id="" class="form-control" placeholder="Estatus" required="required">
              <label for="status">Estatus</label>
            </div>
          </div>
           <input type="button" value="Guardar" class="btn btn-success" v-on:click="save">
            <input type="button" value="Editar" class="btn btn-warning" v-on:click="update">
            <input type="button" value="Borrar" class="btn btn-danger" v-on:click="dele">
        </form>
        </div>
        <div class="card-header">
          <i class="fas fa-table"></i>
            Usuarios registrados</div>
            <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Usuario</th>
                    <th>Correo Electrónico</th>
                    <th>Contraseña</th>
                    <th>Estatus</th>
                    <th>Token</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(elemento, index) in list" :key="elemento.id" v-on:click="load(elemento, index)">
                    <td>{{ elemento.username }}</td>
                    <td>{{ elemento.email }}</td>
                    <td>{{ elemento.password }}</td>
                    <td>{{ elemento.status }}</td>
                    <td>{{ elemento.api_token }}</td>

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
        console.log(this.list);
    },
    data() {
        return {
            list: null,
            user: {
                username: null,
                email: null,
                password: null,
                status: null,
            },
            idxLista: null,
            idx: null
        };
    },
    methods: {
        save: function() {
            let self = this;
            axios.post("/usuarios/save", this.user)
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
            axios.post("/usuarios/update", { user: this.user, id: this.idx })
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
            axios.post("/usuarios/delete", {
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
            this.user.username = elemento.username;
            this.user.email = elemento.email;
            this.user.password = elemento.password;
            this.user.status = elemento.status;

        },activetoken: function() {
            axios.post("/usuarios/activarToken")
                .then(response => {
                   swal("Activado","Token: " + response.data.token);
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        inactiveToken: function() {
            axios.post("/usuarios/desactivarToken")
                .then(response => {
                    swal("Desactivado","Token removido ");
                })
                .catch(error => {
                    console.log(error.response.data);
                });
        },
        logout: function() {
            axios.post("/logout")
                .then(response => {
                    window.location.href = "/login";
                })
                .catch(error => {
                    console.log(error);
                    window.location.href = "/login";
                });
        },
    }
};
</script>
