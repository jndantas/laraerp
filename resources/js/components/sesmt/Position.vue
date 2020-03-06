<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cargos</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Novo<i class="fas fa-plus pl-2"></i> </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Qntd Funcionários</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="position in positions.data" :key="position.id">
                                <td>{{position.id}}</td>
                                <td>{{position.name | upText }}</td>
                                <td>{{position.description}}</td>
                                <td>
                                    <span v-if="position.employees_count > 0" class="badge badge-pill badge-success">{{ position.employees_count }}</span>
                                    <span v-else class="badge badge-pill badge-warning">0</span>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(position)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteData(position.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="positions" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Cargo' : 'Novo Cargo' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateData() : createData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nome"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.description" type="text" name="description"
                            placeholder="Descrição" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Selecione Empresa:</label>
                            <select class='form-control' v-model='form.enterprise' name="enterprise" id="enterprise" @change='getSectors()' :class="{ 'is-invalid': form.errors.has('enterprise') }">
                              <option value='' >Selecione Empresa</option>
                              <option v-for='data in enterprises' :value='data.id'>{{ data.name }}</option>
                            </select>
                            <has-error :form="form" field="enterprise"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Selecione o Setor:</label>
                            <select class='form-control' v-model='form.sector' name="sector" id="sector" :class="{ 'is-invalid': form.errors.has('sector') }">
                              <option value='' >Selecione o Setor</option>
                              <option v-for='data in sectors' :value='data.id'>{{ data.name }}</option>
                            </select>
                            <has-error :form="form" field="sector"></has-error>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">{{ editmode ? 'Salvar' : 'Criar' }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
import Swal from 'sweetalert2';
    export default {
        data() {
            return {
                editmode: false,
                enterprise: 0,
                enterprises: [],
                sector: 0,
                sectors: [],
                positions: {
                    employees: []
                },
                form: new Form({
                    id: '',
                    name : '',
                    description : '',
                    enterprise : '',
                    sector : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/position?page=' + page)
                    .then(response => {
                        this.positions = response.data;
                    });
		    },
            getEnterprises: function(){
              axios.get('/api/getEnterprises')
              .then(function (response) {
                 this.enterprises = response.data;
              }.bind(this));

            },
            getSectors: function() {
                axios.get('/api/getSectors',{
                 params: {
                   enterprise_id: this.form.enterprise
                 }
              }).then(function(response){
                    this.sectors = response.data;
                }.bind(this));
            },
            updateData(id){
                this.$Progress.start();
                this.form.put('api/position/'+this.form.id)
                .then(() => {
                    $('#addNew').modal('hide');
                    Swal.fire(
                        'Atualizado',
                        'Informações Atualizadas',
                        'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(position){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(position);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteData(id){
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter isso.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Sim, apague!'
                }).then((result) => {

                    //enviar requisição para o servidor
                    if (result.value) {
                        this.form.delete('api/position/' + id).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'Cargo foi apagado',
                                    'success'
                                    )
                                    Fire.$emit('AfterCreate');

                            }).catch(()=> {
                                Swal.fire("Falhou!", "Houve algum erro.", "warning");
                            });
                        }
                    })
            },
            loadDatas(){
                axios.get("api/position").then(({ data }) => (this.positions = data));
            },
            createData(){
                this.$Progress.start();
                this.form.post('api/position')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Cargo Criado com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.getEnterprises()
            this.loadDatas();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

