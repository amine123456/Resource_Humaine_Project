<template>
    <div class="container">
  
        <div class="card col-md-16">
                     <div class="card-header">
                        <h3 class="card-title"><em><strong>Ajouter Une Absences Non Justifier</strong></em></h3>
                        <hr>
                         <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Numero CIN</label>

                                    <div class="col-sm-12">
                                    <input type="text" v-model="form.cin" name="cin"  class="form-control" id="InputCin" placeholder="Numero Catre Identité"  >
                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input type="text" v-model="form.name" name="name"  class="form-control" id="inputName" placeholder="Nom e Prenom"  >
                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input type="text"  v-model="form.email" name="email"  class="form-control" id="inputName" placeholder="Email"  >
                                
                                    </div>
                                </div>
     
             <div class="form-group">
                    <label  class="col-sm-2 control-label">Absenter de </label>

                        <div class="col-sm-12">
                         <input type="Date" v-model="form.DebutAbsences" name="DebutAbsences"  class="form-control" id="DebutAbsences"  >
                    
                             </div>
                        </div>


                        <div class="form-group">
       <label  class="col-sm-2 control-label">Jusqu'a</label>

             <div class="col-sm-12">
              <input type="Date" v-model="form.FinAbsences" name="FinAbsences"  class="form-control" id="FinAbsences"   >
                    
                             </div>
                        </div>
   
               
                  <v-btn
               
                color="light-blue"
                @click="createAbsences"
                >
                    Enregistrer
    </v-btn> 
          </div>
        </div>
    </div>
</template>

<script>
 export default {
  data(){
              return{
          Absences : {}  ,      

           form: new Form({
                         cin: '',                
                        name: '',
                         email:'',
                        DebutAbsences: '' ,
                        FinAbsences : '' ,                                    
                    })
      
              }
    } ,

     methods: {
          createAbsences(){
                    this.$Progress.start()
                    this.form.post('/api/Justifier')
                      .then(() => {
                        Toast.fire({
                        type: 'success',
                        title: 'Absences Ajouter'
                        })
                        this.$Progress.finish()
                   })
                   .catch(() => {

                   })
                   
                }
        },
   
    computed: {
       
    }
  }
        
</script>