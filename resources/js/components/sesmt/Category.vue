<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categoria de EPI's</h3>

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
                                <th>Nº de EPI's</th>
                                <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories.data" :key="category.id">
                                <td>{{category.id}}</td>
                                <td>{{category.name | upText }}</td>
                                <td>
                                    <span v-if="category.products_count > 0" class="badge badge-pill badge-success">{{ category.products_count }}</span>
                                    <span v-else class="badge badge-pill badge-warning">0</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-edit blue" @click="editModal(category)"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteCategory(category.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="categories" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar Categoria' : 'Nova Categoria' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                    <div class="modal-body">
                        <div class="form-group">
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nome"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
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
                categories: {},
                form: new Form({
                    id: '',
                    name : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/category?page=' + page)
                    .then(response => {
                        this.categories = response.data;
                    });
		    },
            updateCategory(id){
                this.$Progress.start();
                this.form.put('api/category/'+this.form.id)
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
            editModal(category){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(category);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteCategory(id){
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
                        this.form.delete('api/category/' + id).then(()=>{
                                Swal.fire(
                                    'Apagado',
                                    'Categoria foi apagada',
                                    'success'
                                    )
                                    Fire.$emit('AfterCreate');

                            }).catch(()=> {
                                Swal.fire("Falhou!", "Houve algum erro.", "warning");
                            });
                        }
                    })
            },
            loadCategories(){
                axios.get("api/category").then(({ data }) => (this.categories = data));
            },
            createCategory(){
                this.$Progress.start();
                this.form.post('api/category')
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Categoria Criada com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadCategories();
            Fire.$on('AfterCreate', () => {
                this.loadCategories();
            });
        }
    }
</script>

