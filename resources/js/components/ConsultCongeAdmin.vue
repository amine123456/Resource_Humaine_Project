<template>
    <div class="container">
        <div class="row">
            
                
                    <div class="card col-md-12">
                     <div class="card-header">
                        <h3 class="card-title">Liste des demandes :</h3>


                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Id</th>
                        <th>Status</th>
                        <th>Registred At</th>
                        <th>Date de debut</th>
                        <th>Date fin</th>
                        <th>Modify</th>                  
                    </tr>
                  
                   <tr v-for="conges in conge.data" :key="conges.id" >
                          <td>{{conges.nom}}</td>
                           <td>{{conges.id}}</td>                    
                         <td v-if="conges.status === 2" class="text-danger">En Attend</td>
                          <td  v-else-if="conges.status === 1" class="text-primary">Accepted</td>
                          <td v-else  class="text-danger" >Rejected</td>
                            <td>{{conges.created_at}}</td>
                          <td>{{conges.starting_day}}</td>
                          <td>{{conges.date_fin}}</td>
                          <input type="text"   v-model="conges.status" class="form-control"  hidden>
                         
                           
                           
                          
                          <td>
                                <button   class=" btn btn-success fa fa-edit"></button>                               
                                /
                                      <button v-if="conges.status === 1"    class="btn btn-info fa fa-check " disabled ></button> 
                                      <button v-else  class="btn btn-info fa fa-check "  @click="updateAccept(conges.id , conges.status)" ></button>
                                       
                                 /
                                    
                                    <button v-if="conges.status === 0"   class="btn btn-secondary fa fa-times " disabled ></button> 
                                      <button v-else  class="btn btn-secondary fa fa-times "  @click.prevent="updateReject(conges.id , conges.status)" ></button>
                                 /
                                  <button  class="btn btn-danger fa fa-trash " @click="deleteDemande(conges.id)" ></button>
                          </td>        
                         
                                                        
                    </tr>
                   
                        </tbody>
                    </table>
             </div> 

             <div class="card footer">
                 <pagination :data="conge" @pagination-change-page="getResults"></pagination>                
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
                employer:{} ,          
                 form: new Form({ 
                     id:'',              
                    name: '',
                    type : '' ,
                    status:'',
                    
                                   
                }),
            }
        },

            methods: {

                getResults(page = 1) {
                        axios.get('api/congeAdmin?page=' + page)
                            .then(response => {
                                this.conge = response.data;
                            });
                    },




                updateAccept(id,status){             
                 this.$Progress.start();
                  //this.conge.status = 1 ; 
                  // console.log(this.conge.status);
                   console.log(id);
                   console.log(status);
                  
                    axios.put('api/conge/'+id)
                    .then(() => {
                //     console.log('Editing data');
                      swal.fire(
                        'Accepted!',
                        'Cet demande a ete accepter.',
                        'success'
                        )
                       
                        this.$Progress.finish(); 
                         Fire.$emit('afterAction');     
                    })
                    .catch(() => {
                             swal("Failed" , "Quelque chose a passer" , "warning")
                    });
                 },

                     updateReject(id,status){             
                    this.$Progress.start();
                  //this.conge.status = 1 ; 
                  // console.log(this.conge.status);
                  
                    
                    axios.put('api/conge/'+id)
                    .then(() => {
                //     console.log('Editing data');
                      swal.fire(
                        'Refused!',
                        'Cet demande a ete refuser.',
                        'success'
                        )
                       
                        this.$Progress.finish(); 
                        Fire.$emit('afterAction');     
                    })
                    .catch(() => {
                             swal("Failed" , "Quelque chose a passer" , "warning")
                    });
                 },


                 deleteDemande(id){
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
                                }
                        })

                },

                loadConge(){
                         axios.get('api/congeAdmin').
                        then(({data})=> (this.conge = data))
                },

            },
         created() {

              this.loadConge();
                Fire.$on('afterAction' , () => {
                     this.loadConge();
                }) ; 


            
           axios.get("api/profiles")
            .then(({ data }) => (this.form.fill(data))
            )             

            
            
           
            axios.get('api/employer').
            then(({data})=> (this.employer = data.data))
                
            }
    }
</script>
