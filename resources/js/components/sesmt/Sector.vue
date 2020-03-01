<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Setores</h3>

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
                                <th>Qntd Cargos</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="sector in sectors.data" :key="sector.id">
                                <td>{{sector.id}}</td>
                                <td>{{sector.name | upText }}</td>
                                <td>
                                    <span v-if="sector.positions_count > 0" class="badge badge-pill badge-success">{{ sector.positions_count }}</span>
                                    <span v-else class="badge badge-pill badge-warning">0</span>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(sector)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteData(sector.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="sectors" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewSector" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Setor' : 'Novo Setor' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateData() : createData()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nome" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                                <multiselect
                                    v-model="form.enterprise_id"
                                    :options="enterprises.map(enterprise => enterprise.id)"
                                    :custom-label="opt => enterprises.find(x => x.id == opt).name"
                                    :multiple="true"
                                    placeholder="Selecione uma ou mais"
                                    :select-label="'Selecione'"
                                    :deselect-label="'Selecione para remover'"
                                    :class="{ 'is-invalid': form.errors.has('enterprise_id') }">
                                </multiselect>
                                <has-error :form="form" field="enterprise_id"></has-error>
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
import { Multiselect } from 'vue-multiselect';
    export default {
    components: { Multiselect },
        data() {
            return {
                editmode: false,
                sectors: {},
                selected: null,
                enterprises: [],
                form: new Form({
                    id: '',
                    name : '',
                    enterprise_id : '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/sector?page=' + page)
                    .then(response => {
                        this.sectors = response.data;
                    });
            },
            updateData(id){
                this.$Progress.start();
                this.form.put(route('sector.update', this.form.id))
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
            createData(){
                this.$Progress.start();
                this.form.post('api/sector')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')
                    Toast.fire({
                        type: 'success',
                        title: 'Setor Criado com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            },
            editModal(sector){
                this.editmode = true;
                this.form.reset();
                $('#addNewSector').modal('show');
                this.form.fill(sector);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNewSector').modal('show');
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
                        this.form.delete(route('sector.destroy', id)).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'Setor foi apagado',
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
                axios.get(route('sector.index')).then(({ data }) => (this.sectors = data));
            },
            getEnterprises: function(){
                axios.get(route('getEnterprises')).then(({ data }) => (this.enterprises = data));
            },
        },
        created() {
            this.loadDatas();
            this.getEnterprises();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

