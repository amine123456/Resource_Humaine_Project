<template>
    <div class="container">
        <div class="row mt-5" v-if="!$gate.isAdmin()">
                 <not-found></not-found>
              </div>
       <div class="row mt-5" v-if="$gate.isAdmin()">         
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  
                <h3 class="card-title">Liste des employées</h3><div v-if="loading">Recherche en cour</div>

                <div class="card-tools">
                    <button class="btn btn-success"  @click="OpenModal">
                        Ajouter employer <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>email</th>
                    <th>bio</th>
                    <th>Type</th>
                    <th>Numero Telephone</th>
                     <th>Salaire(DT)</th>
                    <th>Registred At</th>
                    <th>Modify</th>
                  </tr>                 
                  <tr v-for="employers in employer.data" :key="employer.id" >                      
                    <td>{{employers.id}}</td>
                    <td>{{employers.cin}}</td>
                    <td>{{employers.name}} </td>
                    <td> {{employers.email}} </td>
                    <td>{{employers.bio}}</td>
                    <td>{{employers.type}}</td>
                    <td>{{employers.numtel}}</td>
                    <td>{{employers.salaire}}</td>
                     <td>{{employers.created_at | mydate}}</td>
                    <td>
                        
                                <i background-color="blue" @click="editModal(employers)" class="fa fa-edit"></i>
                       
                        /
                         
                                <i @click="deleteEmployer(employers.id)" class="fa fa-trash" ></i>
                        
                    </td>
                  </tr>
                 
                 
                 
                </tbody></table>
              </div>
              <!-- /.card-body -->
               <div class="card footer">
                 <pagination :data="employer" @pagination-change-page="getResults"></pagination>                
                 </div> 
            </div>
            <!-- /.card -->
          </div>
        </div>
            <div class="modal fade" id="AjouteEmployer" tabindex="-1" role="dialog" aria-labelledby="AjouteEmployerLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                 <h5 v-show="!editMode" class="modal-title" id="AjouteEmployerLabel">Ajouter un employer</h5>
                 <h5 v-show="editMode" class="modal-title" id="AjouteEmployerLabel">Modifier l'employer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editMode ? updateEmployer() : createUser()">
                <div class="modal-body">

                    <div class="form-group">                           
                            <input v-model="form.cin" type="text" name="cin"
                            placeholder="Numero carte identité"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('cin') }">
                            <has-error :form="form" field="cin"></has-error>
                        </div>


                        <div class="form-group">                           
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nom"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        

                         <div class="form-group">                           
                            <input v-model="form.email" type="email" name="email"
                            placeholder="email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>

                         <div class="form-group">                           
                            <textarea v-model="form.bio" id="bio" name="bio"
                            placeholder="Quelque note sur l'employer(optionnel)"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>


                        
                         <div class="form-group">                           
                            <select name="type" v-model="form.type" id="type"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Choisir type de travaille</option>
                                    <option value="Controlleur">Controlleur</option>
                                     <option value="Chauffeur">Chauffeur</option>
                                      <option value="Controlleur">Receveur</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>

                        <div class="form-group">                           
                            <input v-model="form.numtel" type="text" name="numtel"
                            placeholder="Numero telephone"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('numtel') }">
                            <has-error :form="form" field="numtel"></has-error>
                        </div>

                         <div class="form-group">                           
                            <input v-model="form.salaire" type="text" name="salaire"
                                placeholder="salaire"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('salaire') }">
                            <has-error :form="form" field="salaire"></has-error>
                        </div>

                         <div class="form-group">                           
                            <input v-model="form.password" type="password" name="password"
                            placeholder="password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                </div>
                    <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                 <button v-show="!editMode" type="submit" class="btn btn-primary">Enregister</button>
                 <button v-show="editMode" type="submit" class="btn btn-success">Modifier</button>
             </div>

             </form>
             
            </div>
                </div>
                </div>
    </div>
</template>

<script>
    export default {
        data(){
                return {
                    editMode : false ,
                    loading : false , 
                    employer : {},
                    form: new Form({
                        id: '',
                        cin: '',                
                        name: '',
                        email :'',
                         bio : '',
                         type : '', 
                        numtel:'',                
                        password :  '', 
                        salaire :  '', 
                        photo : '', 
                    })
                }
        },
        methods: {

                getResults(page = 1) {
                       
                        axios.get('api/employer?page=' + page)

                            .then(response => {
                                this.employer = response.data;   
                            });
                           
                    },
              
                updateEmployer(id){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/employer/'+this.form.id)
                .then(() => {
                     Fire.$emit('AfterCreate');
                    // success
                    $('#AjouteEmployer').modal('hide');
                     swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                       
                        this.$Progress.finish();      
                    })
                    .catch(() => {
                             swal("Failed" , "Quelque chose a passer" , "warning")
                    });
                },
                editModal(employers){
                    this.editMode = true ;
                        this.form.reset();
                         $('#AjouteEmployer').modal('show');
                         this.form.fill(employers);
                },
                OpenModal(){
                        this.editMode = false ;
                        this.form.reset();
                         $('#AjouteEmployer').modal('show');
                },
                deleteEmployer(id){
                    swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                //Ajax request to delete user
                                if (result.value){
                                            this.form.delete('api/employer/'+id).then(() => {
                                            swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                            )
                                            Fire.$emit('AfterCreate');

                                        
                                        }).catch(() => {
                                                swal("Failed" , "Quelque chose a passer" , "warning")
                                        })
                                }
                        })

                },
                loadEmployer(){
                    axios.get('api/employer').then(({data})=> (this.employer = data))
                },
                createUser(){
                    this.$Progress.start()
                   this.form.post('/api/employer')
                   .then(() => {
                        Fire.$emit('AfterCreate');
                         $('#AjouteEmployer').modal('hide');
                        Toast.fire({
                        type: 'success',
                        title: 'Employer a ete créer'
                        })
                        this.$Progress.finish()
                   })
                   .catch(() => {

                   })
                   
                }
        },
        created() {
               
                Fire.$on('searching' , () => {
                     this.loading = true ;
                    let query = this.$parent.search;
                    axios.get('api/finduser?q='+ query) 
                    .then((data) =>  {
                          this.employer = data.data
                         
                    })
                    .catch(() => {
                       
                    })
                    this.loading = false ;

                }); 

                 this.loadEmployer();
                Fire.$on('AfterCreate' , () => {
                     this.loadEmployer();
                }) ;  
                //setInterval(() => this.loadEmployer() , 3000);
            }
    }
</script>
