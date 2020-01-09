<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
            

                    
                
                <div class="card col-md-16">
                     <div class="card-header">
                        <h3 class="card-title" style="color:#DAA520">Demande de Conge</h3><hr>
                    
                          
                           
                           
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                     <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">ID</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.id" class="form-control" id="id" placeholder="id" :class="{ 'is-invalid': form.errors.has('name') }" readonly>
                                     <has-error :form="form" field="id"></has-error>
                                    </div>
                                </div>
                                     <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Numero CIN</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.cin" class="form-control" id="inputName" placeholder="Numero Catre Identité" :class="{ 'is-invalid': form.errors.has('name') }" readonly>
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }" readonly>
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="DebutConge" class="col-sm-2 control-label">DebutConge</label>

                                    <div class="col-sm-12">
                                    <input type="Date" v-model="form.debutConge" class="form-control" id="DebutConge" placeholder="Date de Debut" :class="{ 'is-invalid': form.errors.has('debut') }" >
                                     <has-error :form="form" field="DebutConge"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="finConge" class="col-sm-2 control-label">Fin Conge</label>
                                    <div class="col-sm-12">
                                    <input type="Date" v-model="form.finConge" class="form-control" id="finConge" placeholder="Date de Fin" :class="{ 'is-invalid': form.errors.has('fin') }" >
                                     <has-error :form="form" field="finConge"></has-error>
                                    </div>
                                </div>

                                     <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">                    
                                
                                        <button  @click.prevent="sendConge" class="btn btn-success"> Demande Conge </button>

                                    </div>
                                    </div>
                          </form>  
                       </div>
                       </div>
                       </div>

                  
                
               



              
               
               </div>
         
         
         
         </div>
    </div>
</template>

<script>
    export default {
         data(){
            return {
                profile : {} ,
                 form: new Form({
                        id:'' ,                      
                        cin: '',                
                        name: '',
                        debutConge: '' ,
                        finConge : '' ,                    
                        
                })
            }
        },
        props : [
                'id' 
        ],
        methods:{


            updateConge(){
                     this.$Progress.start();  
                    



            },
        sendConge(){
                this.$Progress.start();               
                 this.form.post('/api/conge')
                .then(()=>{                     
                    this.$Progress.finish();
                   Toast.fire({
                        type: 'success',
                        title: 'Demande a été envoyer'
                        })
                        Fire.$emit('afterAction');
                //         Echo.private('App.User.'+this.id)
                //         .Notification((notification) => {
                //         alert('new notification')
                //         console.log(notification)
                // })
                       
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            
            
        },
        mounted() {
           
        },
        created() {
            axios.get("api/profiles")
            .then(({ data }) => (this.form.fill(data))
            ) }
    }
</script>
