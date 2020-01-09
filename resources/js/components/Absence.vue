<template>
    <div class="container">
  
        <div class="card col-md-16">
                     <div class="card-header">
                        <h3 class="card-title" style="color:#DAA520">Ajouter Une Absences Justifier</h3><hr>
               <!-- <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="Cin"
      :counter="8"
      :rules="CinRules"
      label="CIN"
      required
    ></v-text-field>

     <v-text-field
      v-model="name"
      :counter="50"
      :rules="nameRules"
      label="Name"
      required
    ></v-text-field>

    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      required
    ></v-text-field><br>

     -->

     <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Numero CIN</label>

                                    <div class="col-sm-12">
                                    <input type="text" name="cin" v-model="form.cin" class="form-control" id="InputCin" placeholder="Numero Catre Identité"  >
                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input type="text" name="Name" v-model="form.name"  class="form-control" id="inputName" placeholder="Nom e Prenom"  >
                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input type="text" name="email" v-model="form.email" class="form-control" id="inputName" placeholder="Email"  >
                                
                                    </div>
                                </div>
     
   <div class="form-group">
       <label  class="col-sm-2 control-label">Absenter de </label>

             <div class="col-sm-12">
              <input type="Date" name="DebutAbsences" v-model="form.DebutAbsences"  class="form-control" id="DebutAbsences"  >
                    
                             </div>
                        </div>


                        <div class="form-group">
       <label  class="col-sm-2 control-label">Jusqu'a</label>

             <div class="col-sm-12">
              <input type="Date" name="FinAbsences" v-model="form.FinAbsences" class="form-control" id="FinAbsences"   >
                    
                             </div>
                        </div>
   

           <div class="form-group">
                        <label class="control-label">Rejoingez ici la certificat de verification</label><br>
                        <input type="file"  @change="ajouterAbsence" name="certificat" multiple data-preview-file-type="any"  />
                        </div>
            <div class="form-group">

      <!-- <button class="form-input" @click.prevent="createAbsences" type="submit">Enregistrer</button> -->
      <hr>
       <v-btn   
      color="#DAA520"
      @click="createAbsences"
      >
      Enregistrer
    </v-btn> 
    </div>
    

    

    <!-- <v-btn
      color="red"
      @click="reset"
    >
      Reset Form
    </v-btn> -->

   
  <!-- </v-form> -->
            </div>
        </div>
    </div>
</template>

<script>
 
 import moment from 'moment'
 
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
                        certificat:'',                                   
                    })
      
              }
    } ,
   
    methods: {

      ajouterAbsence(e){
          let file = e.target.files[0];
          console.log(file);
          let reader = new FileReader();
          reader.onloadend = (file) => {
            // console.log('Result' , reader.result);
            this.form.certificat = reader.result;
          }
          reader.readAsDataURL(file);
          
      },
      
      createAbsences(){
                    this.$Progress.start()
                    this.form.post('/api/NoNJustifier')
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
