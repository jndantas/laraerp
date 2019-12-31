<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Funcionários</h3>

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
                                    <th>CPF</th>
                                    <th>Cargo</th>
                                    <th>Empresa</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="employee in employees.data" :key="employee.id">
                                <td>{{employee.id}}</td>
                                <td>{{employee.name | upText }}</td>
                                <td>{{employee.document_number}}</td>
                                <td>Cargo</td>
                                <td>Empresa</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(employee)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteData(employee.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="employees" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Funcionário' : 'Novo Funcionário' }}</h5>
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
                            <input v-model="form.document_number" type="text" name="document_number"
                            placeholder="CPF"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('document_number') }">
                            <has-error :form="form" field="document_number"></has-error>
                        </div>

                        <div class="form-group">
                            <select name="enterprise_id" v-model="form.enterprise_id" id="enterprise_id" class="form-control" :class="{ 'is-invalid': form.errors.has('enterprise_id') }">
                                <option value="">Selecione a Categoria</option>
                            </select>
                            <has-error :form="form" field="enterprise_id"></has-error>
                        </div>

                        <div class="form-group">
                            <select name="position_id" v-model="form.position_id" id="position_id" class="form-control" :class="{ 'is-invalid': form.errors.has('position_id') }">
                                <option value="">Selecione a Categoria</option>
                            </select>
                            <has-error :form="form" field="position_id"></has-error>
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
                employees: {},
                form: new Form({
                    id: '',
                    name : '',
                    document_number : '',
                    enterprise_id : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/employee?page=' + page)
                    .then(response => {
                        this.employees = response.data;
                    });
		    },
            updateData(id){
                this.$Progress.start();
                this.form.put('api/employee/'+this.form.id)
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
            editModal(employee){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(employee);
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
                        this.form.delete('api/employee/' + id).then(()=>{
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
                axios.get("api/employee").then(({ data }) => (this.employees = data));
            },
            createData(){
                this.$Progress.start();
                this.form.post('api/employee')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Acidente Criada com sucesso !!'
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

