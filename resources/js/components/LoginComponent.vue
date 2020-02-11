<template>
<div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" v-model="user.email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="email">Correo Electrónico</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" v-model="user.password" id="password" class="form-control" placeholder="Password" required="required">
              <label for="password">Contraseña</label>
            </div>
          </div>
          <button type="button" class="btn btn-primary btn-block" @click="login()" >Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register">Registrarse</a>
        </div>
      </div>
    </div>
  </div>
  </template>

  <script>
    export default {
    mounted() {
    },
    data() {
      return {
          user: {
            email:null,
            password:null,
          },
      }

    },
    methods:{
        login: function(){
            axios.post("/login", this.user)
            .then(response =>{
              if(response.data == 'desactivado'){
                swal('Usuario desactivado' , 'error');
              }else{
                swal('Has iniciado sesión', 'Datos Correctos', 'success');
                window.location.href = '/';
              }
            })
            .catch(error=>{
                let er = error.response.data.errors;
                let mensaje = 'Error no identificado';
                if(er.hasOwnProperty('email')){
                    mensaje = er.email[0];
                }else if(er.hasOwnProperty('password')){
                    mensaje = er.password[0]
                }

                swal('Error', mensaje)
            })
        },

        }
    }

</script>
