<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de EPI's</h3>

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
                                    <th>Tamanho</th>
                                    <th>CA</th>
                                    <th>Categoria</th>
                                    <th>Qntd Disponível</th>
                                    <th>Estoque mínimo</th>
                                    <th>Movimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products.data" :key="product.id">
                                    <td>{{product.id}}</td>
                                    <td>{{product.name | upText }}</td>
                                    <td>{{product.measure}}</td>
                                    <td>{{product.authorization_certificate.document_number}}</td>
                                    <td>{{product.category.name}}</td>
                                    <td>
                                        <span v-if="product.stock <= 1" class="badge badge-pill badge-danger">{{ product.stock }}</span>
                                        <span v-else-if="(product.stock <= product.stock_min )" class="badge badge-pill badge-warning">{{ product.stock }}</span>
                                        <span v-else-if="product.stock > product.stock_min" class="badge badge-pill badge-success">{{ product.stock }}</span>
                                    </td>
                                    <td>{{product.stock_min}}</td>
                                    <td>
                                        <a href="#" :href="route('inputStock', product.id)">
                                            <i class="fas fa-sign-in-alt green"></i>
                                        </a>
                                        /
                                        <a :href="route('outputStock', product.id)">
                                            <i class="fas fa-sign-out-alt red"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-edit blue" @click="editModal(product)"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteData(product.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="products" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">{{ editmode ? 'Editar EPI' : 'Novo EPI' }}</h5>
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
                            <input v-model="form.measure" type="text" name="measure"
                            placeholder="Tamanho"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('measure') }">
                            <has-error :form="form" field="measure"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.stock_min" type="number" name="stock_min"
                            placeholder="Mínimo para lembrete"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('stock_min') }">
                            <has-error :form="form" field="stock_min"></has-error>
                        </div>
                        <div class="form-group">
                            <select name="authorization_certificate_id" v-model="form.authorization_certificate_id" id="authorization_certificate_id" class="form-control" :class="{ 'is-invalid': form.errors.has('authorization_certificate_id') }">
                                <option value='' >Selecione um CA</option>
                                <option v-for='data in authorization_certificates' :value='data.id'>{{ data.document_number }}</option>
                            </select>
                            <has-error :form="form" field="authorization_certificate_id"></has-error>
                        </div>
                        <div class="form-group">
                            <select name="category_id" v-model="form.category_id" id="category_id" class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                <option value='' >Selecione uma Categoria</option>
                                <option v-for='data in categories' :value='data.id'>{{ data.name }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
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
                products: {},
                categories: [],
                authorization_certificates: [],
                form: new Form({
                    id: '',
                    name : '',
                    measure : '',
                    category_id : '',
                    authorization_certificate_id : '',
                    stock_min: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/product?page=' + page)
                    .then(response => {
                        this.products = response.data;
                    });
            },
            updateData(id){
                this.$Progress.start();
                this.form.put('/api/product/' + this.form.id)
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
            editModal(product){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(product);
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
                        this.form.delete('api/product/' + id).then(()=>{
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
                axios.get(route('product.index')).then(({ data }) => (this.products = data));
            },

            getCategories: function(){
                axios.get("api/getCategories").then(({ data }) => (this.categories = data));
            },
            getCertificates: function(){
                axios.get(route('getCertificates')).then(({ data }) => (this.authorization_certificates = data));
            },
            createData(){
                this.$Progress.start();
                this.form.post(route('product.store'))
                .then(() => {
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                    Toast.fire({
                        type: 'success',
                        title: 'Produto Criado com sucesso !!'
                    })
                    this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadDatas();
            this.getCategories();
            this.getCertificates();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

