<template>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="admin">Jey O</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" @click="logout()">Logout</a>
        </div>
      </li>
    </ul>

  </nav>
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
            
        },
        logout: function() {
            let self = this;
            axios.post("/api/usuarios/logout")
                .then(response => {
                    swal('Token revocado');
                    console.log(response.data);
                    self.list = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        
       
    }
};
</script>