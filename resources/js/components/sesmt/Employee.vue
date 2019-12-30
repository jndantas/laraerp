<template>
    <div class="container-fluid">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Funcionários</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link to="/dashboard" tag="a">Dashboard</router-link></li>
                            <li class="breadcrumb-item active">Funcionários</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">dashboard</div>

                        <div class="card-body">
                        I'm an example component.
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

