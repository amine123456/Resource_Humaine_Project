<template>
<div class="card col-md-16">
                            <div class="card-header">
                            <h3 class="card-title">Liste des Conge Accepter </h3>
                             </div>
                            <table class="table table-condensed">
                    
                         <thead class="thead-Success">

                              <tr>                       
                        <th>nom</th>
                        <th>Registred At</th>
                         <th>Date de debut</th>
                          <th>Date fin</th>                                           
                      </tr>

                         </thead>
                           <tbody>
                    
                  
                   <tr v-for="conges in conge" :key="conges.id" > 
                            <td>{{conges.nom}}</td>                                      
                          <td>{{conges.created_at}}</td>
                          <td>{{conges.starting_day}}</td>
                          <td>{{conges.date_fin}}</td>
                                <!-- <td>{{                             
                                                                   
                              }}</td> -->
                     </tr>
                          <!-- <td>
                                <button v-if="conges.status === 1"   class=" btn btn-success fa fa-edit" disabled></button>
                                <button v-else   class=" btn btn-success fa fa-edit" ></button>                               
                                /
                                 
                                  <button    class=" btn btn-danger fa fa-trash"  @click="deleteDemandeuser(conges.id)"></button>  
                          </td>  -->
                           
                                                             
                            
                        </tbody>
                    </table>
      </div>
</template>

<script>
export default {
   data(){
            return {
                conge : {} ,
                 form: new Form({
                        id:'' ,                      
                        cin: '',                
                        name: '',
                        debutConge: '' ,
                        finConge : '' ,                    
                        
                })
            }
        },

    created(){
            axios.get('api/CongeAccepter').
            then(({data})=> (this.conge = data))
    }
}
</script>

