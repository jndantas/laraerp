<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Empresas</h3>

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
                                <th>Razão Social</th>
                                <th>CNPJ</th>
                                <th>Qnt Funcionários</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="enterprise in enterprises.data" :key="enterprise.id">
                                <td>{{enterprise.id}}</td>
                                <td>{{enterprise.name | upText }}</td>
                                <td>{{enterprise.title | upText }}</td>
                                <td>{{enterprise.document_number}}</td>
                                <td>
                                    <span v-if="enterprise.employees_count > 0" class="badge badge-pill badge-success">{{ enterprise.employees_count }}</span>
                                    <span v-else class="badge badge-pill badge-warning">0</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(enterprise)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteEnterprise(enterprise.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="enterprises" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewEnterprise" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Empresa' : 'Nova Empresa' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateEnterprise() : createEnterprise()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nome Fantansia"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.title" type="text" name="title"
                            placeholder="Razão Social"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.document_number" type="text" name="document_number"
                            placeholder="CNPJ"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('document_number') }">
                            <has-error :form="form" field="document_number"></has-error>
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
                enterprises: {
                employees: []
                },
                form: new Form({
                    id: '',
                    name : '',
                    title : '',
                    document_number : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/enterprise?page=' + page)
                    .then(response => {
                        this.enterprises = response.data;
                    });
		    },
            updateEnterprise(id){
                this.$Progress.start();
                this.form.put('api/enterprise/'+this.form.id)
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
            editModal(enterprise){
                this.editmode = true;
                this.form.reset();
                $('#addNewEnterprise').modal('show');
                this.form.fill(enterprise);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNewEnterprise').modal('show');
            },
            deleteEnterprise(id){
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
                        this.form.delete('api/enterprise/' + id).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'Empresa foi apagada',
                                    'success'
                                    )
                                    Fire.$emit('AfterCreate');

                            }).catch(()=> {
                                Swal.fire("Falhou!", "Houve algum erro.", "warning");
                            });
                        }
                    })
            },
            loadEnterprises(){
                axios.get("api/enterprise").then(({ data }) => (this.enterprises = data));
            },
            createEnterprise(){
                this.$Progress.start();
                this.form.post('api/enterprise')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Empresa Criada com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadEnterprises();
            Fire.$on('AfterCreate', () => {
                this.loadEnterprises();
            });
        }
    }
</script>

