<template>
<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrate</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="username" v-model="user.username" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="username">Usuario</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" v-model="user.email" class="form-control" placeholder="Email address" required="required">
              <label for="email">Correo Electrónico</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="password" v-model="user.password" class="form-control" placeholder="Password" required="required">
                  <label for="password">Contraseña</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" v-model="user.password_confirmation"class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirmar Contraseña</label>
                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary btn-block" @click="register()">Registrarse</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login">Logueate</a>
          <a class="d-block small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
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
       user:{
          username: null,
          email: null,
          password: null,
          password_confirmation:null,
        },
      }

    },
    methods:{
        register: function(){
            axios.post("/register", this.user)
            .then(response =>{

                swal('Registro con éxito', 'Datos Correctos', 'success');
                window.location.href = '/login';
            })
            .catch(error=>{
                let er = error.response.data.errors;
                let mensaje = 'Error no identificado';
                if(er.hasOwnProperty('username')){
                    mensaje = er.username[0];
                }
                else if(er.hasOwnProperty('email')){
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
