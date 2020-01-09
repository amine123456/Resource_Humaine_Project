<template>
<div>


  <div class="card col-md-12">
                     <div class="card-header">
                        <h3 class="card-title">Liste des demandes accepter :</h3>

    <table class="table table-condensed   ">
                    
                         <thead class="thead-Success">

                              <tr>                       
                        <th>CIN</th>
                        <th>Name</th>
                         <th>Email</th>
                          <th>Type</th>  
                           <th>Accepter le</th>                                          
                      </tr>

                         </thead>
                           <tbody>
                    
                  
                   <tr v-for="Recruits in Recruit" :key="Recruit.id" > 
                            <td>{{Recruits.cin}}</td>                                      
                          <td>{{Recruits.name}}</td>
                          <td>{{Recruits.email}}</td>
                          <td>{{Recruits.type}}</td>
                          <td>{{Recruits.created_at}}</td>
                        </tr>        
                     <!-- </tr>
                          <!-- <td>
                                <button v-if="conges.status === 1"   class=" btn btn-success fa fa-edit" disabled></button>
                                <button v-else   class=" btn btn-success fa fa-edit" ></button>                               
                                /
                                 
                                  <button    class=" btn btn-danger fa fa-trash"  @click="deleteDemandeuser(conges.id)"></button>  
                          </td>  -->
                           </tbody>
                           </table>
                                                             
                            
                     </div>
                     </div> 
                    </div>
</template>

<script>
export default {
   data(){
            return {
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
                        date_naiss : '',
                        password :  '', 
                    
                    })
            }
        },

    created(){
            axios.get('api/RecruitAccepter').
            then(({data})=> (this.Recruit = data))
    }
}
</script>

