<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Acidentes</h3>

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
                                <th>Acidente</th>
                                <th>Data</th>
                                <th>Envolvidos</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="accident in accidents.data" :key="accident.id">
                                <td>{{accident.id}}</td>
                                <td>{{accident.description}}</td>
                                <td>{{accident.created_at}}</td>
                                <td>{{accident.employees.lenght}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(accident)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteData(accident.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="accidents" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Acidente' : 'Novo Acidente' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateData() : createData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.description" type="text" name="description"
                            placeholder="Descrição"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <textarea v-model="form.procedure" type="text" name="procedure"
                            placeholder="Procedimento Realizado"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('procedure') }"></textarea>
                            <has-error :form="form" field="procedure"></has-error>
                        </div>
                        <div class="form-group">
                            <select name="type_accident_id" v-model="form.type_accident_id" id="type_accident_id" class="form-control" :class="{ 'is-invalid': form.errors.has('type_accident_id') }">
                                <option value="">Selecione um tipo</option>
                                <option v-for='data in typeAccidents' :value='data.id'>{{ data.name }}</option>
                            </select>
                            <has-error :form="form" field="type_accident_id"></has-error>
                        </div>
                        <div class="form-group">
                            <select name="employee_id" v-model="form.employee_id" id="employee_id" class="form-control" :class="{ 'is-invalid': form.errors.has('employee_id') }">
                                <option value="">Funcionários envolvidos</option>
                                <option v-for='data in employees' :value='data.id'>{{ data.name }}</option>

                            </select>
                            <has-error :form="form" field="employee_id"></has-error>
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
                accidents: {},
                typeAccidents: [],
                employees: [],
                form: new Form({
                    id: '',
                    description : '',
                    procedure : '',
                    type_accident_id : '',
                    employee_id: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/accident?page=' + page)
                    .then(response => {
                        this.accidents = response.data;
                    });
		    },
            updateData(id){
                this.$Progress.start();
                this.form.put('api/accident/'+this.form.id)
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
            editModal(accident){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(accident);
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
                        this.form.delete('api/accident/' + id).then(()=>{
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
                axios.get("api/accident").then(({ data }) => (this.accidents = data));
            },
            getTypeAccidents: function(){
                axios.get("api/getTypeAccidents").then(({ data }) => (this.typeAccidents = data));
            },
            getEmployees: function(){
                axios.get("api/getEmployees").then(({ data }) => (this.employees = data));
            },
            createData(){
                this.$Progress.start();
                this.form.post('api/accident')
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
            this.getTypeAccidents();
            this.getEmployees();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

