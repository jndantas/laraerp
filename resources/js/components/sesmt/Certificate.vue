<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">CA's</h3>

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
                                <th>CA</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Data de Cadastro</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="certificate in certificates.data" :key="certificate.id">
                                <td>{{certificate.id}}</td>
                                <td>{{certificate.document_number}}</td>
                                <td>{{certificate.start_date}}</td>
                                <td>{{certificate.end_date}}</td>
                                <td>{{certificate.created_at}}</td>

                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(certificate)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteCertificate(certificate.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="certificates" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar CA' : 'Nova CA' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateCA() : createCA()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.document_number" type="text" name="document_number"
                            placeholder="CA"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('document_number') }">
                            <has-error :form="form" field="document_number"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.start_date" type="date" name="start_date"
                            placeholder="Data Início"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('start_date') }">
                            <has-error :form="form" field="start_date"></has-error>
                        </div>
                            <div class="form-group">
                            <input v-model="form.end_date" type="date" name="end_date"
                            placeholder="Data Fim"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('end_date') }">
                            <has-error :form="form" field="end_date"></has-error>
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
                certificates: {},
                form: new Form({
                    id: '',
                    document_number: '',
                    start_date : '',
                    end_date : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/authorizationcertificate?page=' + page)
                    .then(response => {
                        this.certificates = response.data;
                    });
		    },
            updateCA(id){
                this.$Progress.start();
                this.form.put(route('authorizationcertificate.update', this.form.id))
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
            editModal(certificate){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(certificate);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteCertificate(id){
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
                        this.form.delete(route('authorizationcertificate.destroy', id)).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'CA foi apagado',
                                    'success'
                                    )
                                    Fire.$emit('AfterCreate');

                            }).catch(()=> {
                                Swal.fire("Falhou!", "Houve algum erro.", "warning");
                            });
                        }
                    })
            },
            loadCertificates(){
                axios.get(route('authorizationcertificate.index')).then(({ data }) => (this.certificates = data));
            },
            createCA(){
                this.$Progress.start();
                this.form.post(route('authorizationcertificate.store'))
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'CA Criada com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadCertificates();
            Fire.$on('AfterCreate', () => {
                this.loadCertificates();
            });
        }
    }
</script>

