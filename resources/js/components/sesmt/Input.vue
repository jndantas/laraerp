<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Histórico de Entradas</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NF</th>
                                    <th>EPI</th>
                                    <th>Tamanho</th>
                                    <th>Data de Entrada</th>
                                    <th>Funcionário</th>
                                    <th>Valor</th>
                                    <th>Qntd</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="input in inputs.data" :key="input.id">
                                    <td>{{input.id}}</td>
                                    <td>{{input.document_number}}</td>
                                    <td>{{input.product.name }}</td>
                                    <td>{{input.product.measure }}</td>
                                    <td>{{input.date |myDate}}</td>
                                    <td>{{input.user.name}}</td>
                                    <td>{{input.value}}</td>
                                    <td>{{input.qntd}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="inputs" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
                <!-- /.card -->
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
                inputs: {},
                form: new Form({
                    id: '',
                    name : '',
                    qntd: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/input?page=' + page)
                    .then(response => {
                        this.inputs = response.data;
                    });
		    },

            loadDatas(){
                axios.get(route('stock_entries.index')).then(({ data }) => (this.inputs = data));
            },
        },
        created() {
            this.loadDatas();
            Fire.$on('AfterCreate', () => {
                this.loadDatas();
            });
        }
    }
</script>

