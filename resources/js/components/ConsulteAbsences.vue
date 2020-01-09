<template>
    <div class="container">
  
        <div class="card col-md-16">
                            <div class="card-header">
                            <h3 class="card-title">Liste des Absences </h3>
                             </div>

                             <table class="table table-condensed">
                    
                         <thead class="thead-Success">

                    <tr >                       
                        <th>CIN</th>
                        <th>Name</th>
                         <th>Email</th>
                          <th>Absenter le</th>  
                           <th>jusqu'a</th> 
                           <th>verfication</th>
                           <th>action</th>                                            
                      </tr>

                         </thead>
                           <tbody>
                    
                  
                   <tr v-for="Absencess in Absences" :key="Absencess.id" > 
                            <td>{{Absencess.cin}}</td>                                      
                          <td>{{Absencess.name}}</td>
                          <td>{{Absencess.email}}</td>
                          <td>{{Absencess.absenter}}</td>
                          <td>{{Absencess.jusqua}}</td>
                          <td v-if="Absencess.certificat == null" style="color:#ff471a"> Absence Non justifier</td>
                           <td v-else style="color:#6666ff"> Absence  Justifier </td>
                          

                          <td><button>

                                   <button @click="OpenModal"   class=" btn btn-success fa fa-edit"></button> 
                                   /
                                    <button @click.prevent="deleteAbsences(Absencess.id)"  class=" btn btn-danger fa fa-trash"></button>   
                              
                              </button></td>
                        </tr>        
                           </tbody>
                           </table>
                <div class="modal fade" id="ModifAbsences" tabindex="-1" role="dialog" aria-labelledby="AjouteEmployerLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                     <h5  class="modal-title" id="AjouteEmployerLabel">Modifier Absences</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                         <form @submit.prevent="updateAbsences()">
                <div class="modal-body">

                    <div class="form-group">                           
                            <input v-model="form.cin" type="text" name="cin"
                            class="form-control"
                            placeholder="Numero carte identité"
                                >
                           
                        </div>
                         <div class="form-group">                           
                            <input v-model="form.name" type="text" name="name"
                            class="form-control"
                            placeholder="Nom"
                               >
                           
                        </div>
                        <div class="form-group">                           
                            <input v-model="form.email" type="email" name="email"
                            class="form-control"
                            placeholder="Email"
                               >
                           
                        </div>

                        <div class="form-group">   
                             <label >Absenter de</label>                               
                            <input v-model="form.absenter" type="date" name="absenter"
                            class="form-control"
                            
                               >
                           
                        </div>

                        <div class="form-group"> 
                            <label >Jusqu'a</label>                          
                            <input v-model="form.jusqua" class="form-control" type="date" name="jusqua">
         
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
</template>
<script>
export default {
   data(){
            return {
                Absences : {}  ,      
                sets : {} ,
                setcConge : {} ,

           form: new Form({
                        id:'',
                        cin: '',                
                        name: '',
                        email :'',
                        absenter:'',    
                         jusqua : '', 
                        
                    
                    })
            }
        },

        methods : {
                     deleteAbsences(id){
                    swal.fire({
                            title: 'Vous etes sure?',
                            text: "Vous pouvez pas retournez!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oui, Supprimer!'
                            }).then((result) => {
                                //Ajax request to delete user
                                if (result.value){
                                            axios.delete('api/absences/'+id).then(() => {
                                            swal.fire(
                                            'Deleted!',
                                            'Absences ete supprimer.',
                                            'success'
                                            )                                                 
                                        }).catch(() => {
                                                swal("Failed" , "Quelque chose a passer" , "warning")
                                        })
                                }
                        })

                },

                 updateAbsences(id){
                this.$Progress.start();
                // console.log('Editing data');
                axios.put('api/update/'+id)
                .then(() => {
                    
                    // success
                    $('#ModifAbsences').modal('hide');
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

                OpenModal(){
                        
                        this.form.reset();
                         $('#ModifAbsences').modal('show');
                },


        },

    created(){
            axios.get('api/ConsultAbsences').
            then(({data})=> (this.Absences = data))
    }
}
</script>
