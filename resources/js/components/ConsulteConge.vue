<template>
    <div class="container">
        <div class="row">
           
                
                    <div class="card col-md-12">
                     <div class="card-header">
                        <h3 class="card-title">Liste des demandes :</h3>

                        <!-- <p v-if="conge" class="alert alert-warning" > Vous avez fait  conge  </p> -->

                    <div  class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <tbody>
                    <tr> 
                         <th>ID</th>                       
                        <th>Status</th>
                       
                        <th>Registred At</th>
                         <th>Date de debut</th>
                          <th>Date fin</th>
                          <!-- <th>Nombre de jours</th> -->
                            <th>Modify</th>                  
                    </tr>
                  
                   <tr v-for="conges in conge" :key="conges.id" > 
                       <td>{{conges.id}}</td>                                      
                         <td v-if="conges.status === 2" class="text-danger">En Attend</td>
                          <td  v-else-if="conges.status === 1" class="text-primary">Accepted</td>
                          <td v-else  class="text-danger" >Rejected</td>
                          <td>{{conges.created_at}}</td>
                          <td>{{conges.starting_day}}</td>
                          <td>{{conges.date_fin}}</td>
                                <!-- <td>{{                             
                                                                   
                              }}</td> -->

                          <td>
                                <button v-if="conges.status === 1"   class=" btn btn-success fa fa-edit" disabled></button>
                                <button v-else @click.prevent="editModal(conges)"  class=" btn btn-success fa fa-edit" ></button>                               
                                /
                                 
                                  <button    class=" btn btn-danger fa fa-trash"  @click.prevent="deleteDemandeuser(conges.id)"></button>  
                          </td> 
                           
                                                             
                    </tr> 
                        </tbody>
                    </table>


                     <div class="modal fade" id="ModifConge" tabindex="-1" role="dialog" aria-labelledby="AjouteEmployerLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="ModifCongeLabel">Modifier Conge</h5>

                     <form @submit.prevent="updateConge()">
                <div class="modal-body">
                    <div class="form-group">
                         <label for="">Date Debut </label>                              
                            <input v-model="form.dateDebut" type="date" name="cin"
                            placeholder="Date Debut"
                                class="form-control" >
                           
                        </div>


                        <div class="form-group">
                            <label for="">Date de Fin </label>                           
                            <input v-model="form.dateFin" type="date" name="name"
                            
                              class="form-control"    >
                        </div>


                         <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>                
                                <button  type="submit" class="btn btn-success">Modifier</button>
                            </div>
                     </div>
                     </form>
                </div> 
                </div>
                </div>
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
                conge:{},
               
                 form: new Form({ 
                     id:'',              
                     name: '', 
                     status:'',
                     dateDebut:'',  
                     dateFin:'',                         
                }),
            }
        },

        methods : {



            editModal(conge){
                   
                       this.form.reset();
                         $('#ModifConge').modal('show');
                         this.form.fill(conge);
                },
            



             updateConge(id){
                this.$Progress.start();
                // console.log('Editing data');
                axios.put('api/modifier/'+this.form.id)
                .then(() => {
                     Fire.$emit('AfterCreate');
                    // success
                    $('#ModifConge').modal('hide');
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
            deleteDemandeuser(id){
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
                                            axios.delete('api/conge/'+id).then(() => {
                                            swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                            )    
                                                                                         
                                        }).catch(() => {
                                                swal("Failed" , "Quelque chose a passer" , "warning")
                                        })
                                         Fire.$emit('afterAction');
                                }
                        })

                },
           

        },
       
         created() {
            
           axios.get("api/profiles")
            .then(({ data }) => (this.form.fill(data))
            ) 
            
             axios.get('api/conge').
            then(({data})=> (this.conge = data.data))

            axios.get('api/indexadmin').
            then(({data})=> (this.conge = data.data))
            
            
            }
    }
</script>
