<template>
    <div class="container">

        <div class="card col-md-16">
                     <div class="card-header">
                        <h3 class="card-title">Liste des demandes de recrutement :</h3>
     
           <!-- <div class="card col-md-16">
                     <div class="card-header">
                        <h3 class="card-title">Liste des demandes de recrutement :</h3>


                    <div class="card-body  table-responsive ">
                    <table class="table table-hover">
                    <tbody>
                    <tr >
                         <th>Status</th>
                        <th>CIN</th>
                        <th>Nom</th>
                        <th>Num tel</th>
                        <th>Demande de</th>
                        
                        
                         <th>permis</th>
                        <th>Registred At</th>
                        <th>Modify</th>
                                
                    </tr>
                  
                   <tr v-for="Recruits in Recruit" :key="Recruits.id" >
                        <td  v-if="Recruits.status === 1" class="text-primary">Accepted</td>
                          <td v-else  class="text-danger" >Rejected</td>
                            
                            <td>{{Recruits.cin}}</td>
                             <td>{{Recruits.name}}</td>                    
                         <!-- <td v-if="conges.status === 2" class="text-danger">En Attend</td>
                          -->
                            
                             <!-- <td>{{Recruits.numtel}}</td>
                              <td>{{Recruits.type}}</td>
                               
                              
                               <td>{{Recruits.permis}}</td>
                              
                             <td>{{Recruits.created_at}}</td>
                         


                         <td>
                                   
                                        <button v-if="Recruits.status === 1"    class="btn btn-info fa fa-check " disabled ></button> 
                                         <button v-else  class="btn btn-info fa fa-check "  @click="updateAccept(Recruits.id,Recruits.status)" ></button>
                                     
                                         <button v-if="Recruits.status === 0"   class="btn btn-secondary fa fa-times " disabled ></button> 
                                      <button v-else  class="btn btn-secondary fa fa-times "  @click.prevent="updateReject(Recruits.id , Recruits.status)" ></button>
                             </td> -->
                          <!-- <input type="text"   v-model="conges.status" class="form-control"  hidden>
                         
                           
                           
                          
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
                          -->
                             
                        

                         
                                                           
                    
                                
                    <!-- </tr>
                   
                        </tbody>
                    </table> -->
    <div >
                    
    <v-card style="margin-bottom:10px"   v-for="Recruits in Recruit.data" :key="Recruits.id"> 
       

        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">{{Recruits.name}}</h3>
            <div> 

                <div>
                
                <span class="grey--text">Numero Carte identitie : </span>{{Recruits.cin}} <br>
                <span class="grey--text">numero telephone : </span>{{Recruits.numtel}} <br>
                <span class="grey--text">adresse : </span>{{Recruits.adresse}} <br>
                <span class="grey--text">Demande de : </span>{{Recruits.type}} <br>
                 <span class="grey--text">Email : </span>{{Recruits.email}} <br>
                 <span class="grey--text">Telecharger Cv : </span>  <a  :href="'/storage/CVV/'+Recruits.CV" >download</a><br> 
                 <span class="grey--text">Registrer le : </span>{{Recruits.created_at}} <br>
                  <span class="grey--text">Permis : </span> <span v-if="Recruits.permis === 0"> Non </span> 
                                                                <span v-else> Oui </span>
               </div>       
            </div>
          </div>
        </v-card-title>

        <v-card-actions>
          
          <v-btn flat color="blue" @click="updateAccept(Recruits.id,Recruits.status)">Accept</v-btn>
          <v-btn flat color="red" @click.prevent="updateReject(Recruits.id , Recruits.status)">Refuse</v-btn>
        </v-card-actions>
        
        </v-card> 
         <pagination :data="Recruit" @pagination-change-page="getResults"></pagination>       
   </div>
       
                 
                    

        </div>

       </div>          
    </div>
   

</template>

<script>
    export default {
        data(){
              return{
          Recruit : {}  ,      
          sets : {} ,
          setcConge : {} ,

           form: new Form({
                        id: '',
                        cin: '',                
                        name: '',
                        email :'',
                        numtel:'',    
                         type : '', 
                         CV : '' ,
                        date_naiss : '',
                        password :  '', 
                    
                    })



          
              }
    } ,
    methods : {
                


                 getResults(page = 1) {
                        axios.get('api/RecruitData?page=' + page)
                            .then(response => {
                                this.Recruit = response.data;
                            });
                    },

                    
                 updateAccept(id,status){             
                 this.$Progress.start();
                  //this.conge.status = 1 ; 
                  // console.log(this.conge.status)
                              
                    axios.put('api/RecruitData/'+id)
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

                   updateReject(id){
                    swal.fire({
                            title: 'Are you sure?',
                            text: "si vous refuser la demandes elle sera supprimer",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oui, refuser !'
                            }).then((result) => {
                                //Ajax request to delete user
                                if (result.value){
                                            axios.delete('api/RecruitData/'+id).then(() => {
                                            swal.fire(
                                            'Rejected!',
                                            'Cet demande a ete rejeter.',
                                            'success'
                                            )                                                 
                                        }).catch(() => {
                                                swal("Failed" , "Quelque chose a passer" , "warning")
                                        })
                                }
                        })

                },


    //               updateReject(id,status){             
    //                 this.$Progress.start();
    //               //this.conge.status = 1 ; 
    //               // console.log(this.conge.status);
                  
                    
    //                 axios.put('api/RecruitData/'+id)
    //                 .then(() => {
    //             //     console.log('Editing data');
    //                   swal.fire(
    //                     'Accepted!',
    //                     'Cet demande a ete refuser.',
    //                     'success'
    //                     )
                       
    //                     this.$Progress.finish(); 
    //                     Fire.$emit('afterAction');     
    //                 })
    //                 .catch(() => {
    //                          swal("Failed" , "Quelque chose a passer" , "warning")
    //                 });
    //              },
    },
      
        mounted() {
           
        },
        created() {
            axios.get("api/RecruitData").
            then(({data})=> (this.Recruit = data))
            }
    }
</script>
