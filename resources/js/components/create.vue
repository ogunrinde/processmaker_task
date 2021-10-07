<template>
  <div class="mx-auto mt-5" style="width: 50%;">
    <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" show>Create Record</b-alert>
    </b-row>
    <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" :show="message==''?false:true">{{message}}</b-alert>
    </b-row>
    <div v-if="errors" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
    <div v-for="(v, k) in errors" :key="k">
        <p v-for="error in v" :key="error" class="text-sm" style="color:red">
        {{ error }}
        </p>
    </div>
    </div>    
    <b-form @submit="createrecord">
      <b-form-group
        id="input-group-1"
        label="Name:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="record.name"
          type="text"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group class="mt-3" id="input-group-2" label="Code:" label-for="input-2">
        <b-form-input
          id="input-2"
          class="mb-3"
          v-model="record.code"
          required
        ></b-form-input>
      </b-form-group>

      

      <b-form-group class="mt-3"  id="input-group-2" label="Status:" label-for="input-2">
        <b-form-select v-model="record.status" :options="options"></b-form-select>
      </b-form-group>

       <b-form-group class="mt-3"  id="input-group-2" label="Description:" label-for="input-2">
       <b-form-textarea
        id="textarea"
        v-model="record.description"
    
        ></b-form-textarea>
      </b-form-group>



      <b-button type="submit" class="mt-3"  variant="primary">Submit</b-button>
    </b-form>
     <b-row>
           <router-link style="text-align:center;" :to="{name: 'list'}" class="">Go to List</router-link> 
    </b-row>
  </div>
</template>
 
<script>
  import { state } from '../state';
    export default {
        data() {
            return {
                record: {
                    name:"",
                    code:"",
                    status:"",
                    description:""
                },
                options: [
                    { value: 'active', text: 'Active' },
                    { value: 'inactive', text: 'Inactive' }
                ],
                 errors: null,
                 message:''
            }
        },
        methods: {
            async createrecord(e){
                 e.preventDefault()
                await this.axios.post('http://localhost:8000/api/record/store',this.record, {
                headers: { Authorization: `Bearer ${state.token}` }
                }).then(response=>{
                    if(response.data.success == true){
                        this.message = 'New Record Created Successful';
                        this.record = {name:"", code:"",status:"",description:""}
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