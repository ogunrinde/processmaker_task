<template>
  <div class="mx-auto mt-5" style="width: 50%;">
    <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" show>Login to Access</b-alert>
    </b-row>
    <b-row>
        <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" :show="message==''?false:true">{{message}}</b-alert>
    </b-row>
    <b-alert variant="danger" :show="errors==null?false:true">
    <div v-for="(v, k) in errors" :key="k">
        <p v-for="error in v" :key="error" class="text-sm" style="color:red">
        {{ error }}
        </p>
    </div>
    </b-alert>      
    <b-form @submit="login_access">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="login.email"
          type="email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="mt-3"  id="input-group-2" label="Your Password:" label-for="input-2">
        <b-form-input
          id="input-2"
          type="password"
          v-model="login.password"
          required
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" class="mt-3"  variant="primary">Submit</b-button>
    </b-form>
     <b-row>
           <router-link style="text-align:center;" :to="{name: 'register'}" class="">Go to Register</router-link> 
    </b-row>
  </div>
</template>
 
<script>
  import { state,mutations } from '../state';
    export default {
        data() {
            return {
                login: {
                    email:"",
                    password:""
                },
                 errors: null,
                 message:''
            }
        },
        methods: {
            async login_access(e){
                 e.preventDefault()
                await this.axios.post('http://localhost:8000/api/login',this.login).then(response=>{
                    if(response.data.success == true){
                       mutations.setToken(response.data.token)
                       //this.$session.set('token', response.data.token); 
                       this.$router.push({name:"list"})
                    }else
                    {
                        this.message = response.data.message;
                    }
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })
           }
        }
    }
</script>