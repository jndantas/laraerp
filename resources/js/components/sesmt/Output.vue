<template>
    <div class="container">
        <div class="row pt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Histórico de Saídas</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>EPI</th>
                                    <th>Data de Saída</th>
                                    <th>Qntd</th>
                                    <th>Funcionário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="output in outputs.data" :key="output.id">
                                    <td>{{output.id}}</td>
                                    <td>{{output.product.name | upText }}</td>
                                    <td>{{output.date}}</td>
                                    <td>{{output.qntd}}</td>
                                    <td>{{output.employee.name}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="outputs" @pagination-change-page="getResults"></pagination>
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
                outputs: {},
                form: new Form({
                    id: '',
                    name : '',
                    qntd: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/output?page=' + page)
                    .then(response => {
                        this.outputs = response.data;
                    });
		    },

            loadDatas(){
                axios.get("api/output").then(({ data }) => (this.outputs = data));
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

