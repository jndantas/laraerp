<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Exames</h3>

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
                                    <th>Sigla</th>
                                    <th>Duração</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="exam in exams.data" :key="exam.id">
                                    <td>{{exam.id}}</td>
                                    <td>{{exam.name }}</td>
                                    <td>{{exam.code}}</td>
                                    <td>{{exam.duration}}</td>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-edit blue" @click="editModal(exam)"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteData(exam.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="exams" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Exame' : 'Novo Exame' }}</h5>
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
                            <input v-model="form.code" type="text" name="code"
                            placeholder="Sigla"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('code') }">
                            <has-error :form="form" field="code"></has-error>
                        </div>

                        <div class="form-group">
                            <select name="duration" v-model="form.duration" id="duration" class="form-control" :class="{ 'is-invalid': form.errors.has('duration') }">
                                <option value="">Selecione Duração</option>
                                <option value="30">1 Mês</option>
                                <option value="90">3 Meses</option>
                                <option value="180">6 Meses</option>
                                <option value="365">12 Meses / 1 ano</option>
                                <option value="540">18 Meses</option>
                                <option value="730">24 Meses / 2 anos</option>
                                <option value="1095">36 Meses / 3 anos</option>
                                <option value="1460">48 Meses / 4 anos</option>
                                <option value="1825">56 Meses / 5 anos</option>
                            </select>
                            <has-error :form="form" field="duration"></has-error>
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
                exams: {},
                form: new Form({
                    id: '',
                    name : '',
                    code : '',
                    duration : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/exam?page=' + page)
                    .then(response => {
                        this.exams = response.data;
                    });
		    },
            updateData(id){
                this.$Progress.start();
                this.form.put('api/exam/'+this.form.id)
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
            editModal(exam){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(exam);
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
                        this.form.delete('api/exam/' + id).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'Acidente foi apagada',
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
                axios.get("api/exam").then(({ data }) => (this.exams = data));
            },
            createData(){
                this.$Progress.start();
                this.form.post('api/exam')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Exame Criado com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadDatas();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

