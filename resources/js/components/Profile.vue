<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 350px;
}
.widget-user .card-footer{
    padding-top: 50px !important;
}
</style>

<template>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pt-3">
                    <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background-image:url('./img/user-cover.jpg')">
                <h3 class="widget-user-username text-right">{{this.form.name}}</h3>
                <h5 class="widget-user-desc text-right">{{this.form.type}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
                </div>
            </div>
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Atividades</a></li>
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Configurações</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                      <h3 class="text-center">Atividades do Usuário</h3>
                  </div>

                <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-12">
                                <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Experiência</label>
                            <div class="col-sm-12">
                            <textarea class="form-control" v-model="form.bio" id="inputExperience" placeholder="Experiência" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="col-sm-2 control-label">Foto do Perfil</label>
                            <div class="col-sm-12">
                                <input type="file" @change="updateProfile" name="photo" class="form-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-12 control-label">Senha (deixe vazio para não atualizar)</label>
                            <div class="col-sm-12">
                            <input type="password"
                                v-model="form.password"
                                class="form-control"
                                id="password"
                                placeholder="Senha"
                                :class="{ 'is-invalid': form.errors.has('password') }"
                            >
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12">
                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                    </form>

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>

        </div>

</template>

<script>
import Swal from 'sweetalert2';
    export default {
        data(){
            return {
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods:{

            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
                return photo;
            },

            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                //console.log('enviado');
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                //let vm = this;
                let limit = 1024 * 1024 * 2;
                if(file['size'] < limit){
                    reader.onloadend = (file) => {
                        //console.log('RESULT', reader.result)
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Você está carregando uma imagem grande',
                    })
                }
            }
        },
        created() {
            axios.get("api/profile")
            .then(( { data } ) => (this.form.fill(data)));
        }
    }
</script>

