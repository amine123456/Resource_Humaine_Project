<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}

</style>


<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3" >
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./iset1.jpg')">
                    <h3 class="widget-user-username">{{this.form.name }}</h3>
                    <h5 class="widget-user-desc">{{this.form.type}}</h5>
                </div>
                <div class="widget-user-image">
                     <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar"> 
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">7 </h5>
                        <span class="description-text">Demande de conges</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                        <h5 class="description-header">6</h5>
                        <span class="description-text">Absence</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">1500</h5>
                        <span class="description-text">Employer</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                          
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                           
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                     <div class="form-group">
                                    <label for="inputcin" class="col-sm-2 control-label">Numero CIN</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.cin" class="form-control" id="inputName" placeholder="Numero Catre Identité" :class="{ 'is-invalid': form.errors.has('name') }">
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                     <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Type</label>

                                    <div class="col-sm-12">
                                    <input type="text" v-model="form.type" class="form-control" id="inputEmail" placeholder="Type"  :class="{ 'is-invalid': form.errors.has('type') }" readonly>
                                     <has-error :form="form" field="type"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Numéro Télephone </label>

                                    <div class="col-sm-12">
                                    <input  v-model="form.numtel" class="form-control" id="inputExperience" placeholder="Numéro de telephone" :class="{ 'is-invalid': form.errors.has('numtel') }">
                                    </input>
                                     <has-error :form="form" field="numtel"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" @change="updateProfile" name="photo" class="form-input">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label">Password (leave empty if not changing)</label>

                                    <div class="col-sm-12">
                                    <input type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Modifier</button>
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
</template>



<script>
    export default {
        data(){
            return {
                profile : {} ,
                 form: new Form({
                        
                        cin: '',                
                        name: '',
                        email :'',
                        type : '', 
                        numtel:'',                
                        password :  '', 
                        photo : '' ,
                        
                })
            }
        },
       
        mounted() {

            console.log('Component monted.')
           
        },

        methods:{

            getProfilePhoto(){
                   // return "img/profile/"+this.form.photo;
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },

            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profiles')
                .then(()=>{
                     Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();

                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }

                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                }
                reader.readAsDataURL(file);
            }
        },

        created() {
            axios.get("api/profiles")
            .then(({ data }) => (this.form.fill(data))
            );
           

            //axios.get('api/Profile').then(({data})=> (this.profile = data.data))
           
        }
    }
</script>
