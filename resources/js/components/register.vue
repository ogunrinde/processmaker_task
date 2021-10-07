<template>
  <div class="mx-auto mt-5" style="width: 50%;">
    <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" show>Create Account</b-alert>
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
    <b-form @submit="createaccount">
      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="register.email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="mt-3" id="input-group-2" label="Your Name:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="register.name"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="mt-3"  id="input-group-2" label="Your Password:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="register.password"
          type="password"
          required
        ></b-form-input>
      </b-form-group>

       <b-form-group class="mt-3"  id="input-group-2" label="Your Confirm Password:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="register.password_confirmation"
          type="password"
          required
        ></b-form-input>
      </b-form-group>



      <b-button type="submit" class="mt-3"  variant="primary">Submit</b-button>
    </b-form>
     <b-row>
           <router-link style="text-align:center;" :to="{name: 'login'}" class="">Go to Login</router-link> 
    </b-row>
  </div>
</template>
 
<script>
    export default {
        data() {
            return {
                register: {
                    name:"",
                    email:"",
                    password:"",
                    password_confirmation:""
                },
                 showDismissibleAlert: true,
                 errors: null,
                 message:''
            }
        },
        methods: {
            async createaccount(e){
                 e.preventDefault()
                await this.axios.post('http://localhost:8000/api/register',this.register).then(response=>{
                    if(response.data.success == true){
                        this.message = 'Registration Successful...Proceed to Login';
                    }else
                    {
                        this.message = response.data.message;
                    }
                }).catch(error=>{
                    console.log(error.response.errors);
                    this.errors = error.response.data.errors;
                })
           }
        }
    }
</script>