<template>
    <div class="mx-auto mt-5" style="width: 80%;">
    <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" show>List of Record Created</b-alert>
    </b-row>
    <b-row>
        <b-col class="mb-2 text-end">
            <router-link :to='{name:"create"}' class="btn btn-primary">Create</router-link>
        </b-col>
        <div>

        <b-modal id="openmodal" title="Edit Record" hide-footer>
        <b-row>
            <b-alert variant="info" style="text-align:center;font-size: 1.2rem;" :show="message==''?false:true">{{message}}</b-alert>
        </b-row>
        <b-form @submit="updaterecord">
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
        </b-modal>
        </div>
        <div>
            <b-card
                class="mb-2"
            >
                <b-card-text>
                <template>
                <div>
                    <b-table striped hover ref="table" :items="items" :fields="fields">
                     <template v-slot:cell(actions)="{ item }">
                     <b-button v-b-modal.openmodal variant="primary" @click="opentoedit(item)">Edit</b-button>
                    </template>
                  </b-table>
                </div>
                </template>
                  
                </b-card-text>

            </b-card>
            </div>
    </b-row>
    </div>
</template>

<script>
import { state } from '../state';
export default {
    name:"Records",
    data(){
        return {
            edit: null,
            message:'',
            options: [
                    { value: 'active', text: 'Active' },
                    { value: 'inactive', text: 'Inactive' }
            ],
            record: {
                name:"",
                code:"",
                status:"",
                description:""
            },
            fields: [
                'name',
                'description',
                'code',
                'status',
                'actions'
            ],
            items:[],
            
        }
    },
    mounted(){
        this.getRecords()
    },
    methods:{
        async getRecords(){
            await this.axios.get('http://localhost:8000/api/record',{
                 headers: { Authorization: `Bearer ${state.token}` }
                }).then(response=>{
                this.items = response.data.data;
            }).catch(error=>{
                this.records = []
            })
        },
        opentoedit(data) {
            this.edit = data;  
            this.record = { "name": data.name, "description" : data.description, "status": data.status, "code" : data.code}    
        },
        async updaterecord(e){
                e.preventDefault()
                await this.axios.put(`http://localhost:8000/api/record/${this.edit.UUID}`,this.record, {
                 headers: { Authorization: `Bearer ${state.token}` }
                }).then(response=>{
                    if(response.data.success == true){
                        let index = this.items.findIndex(x => x.UUID == this.edit.UUID)
                        this.items[index] = { ...this.record, UUID : this.edit.UUID }
                        this.$refs.table.refresh();
                        this.message = 'Record Editted Successful';
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