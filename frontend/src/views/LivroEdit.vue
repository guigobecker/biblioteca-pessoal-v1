<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Editar livro</h4>
            </div>
            <div class="card-body">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                        {{ error[0] }}
                    </li>
                </ul>

                <div class="mb-3">
                    <label for="">Título</label>
                    <input type="text" v-model="model.livro.titulo" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Autor</label>
                    <input type="text" v-model="model.livro.autor" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Classificação</label>
                    <input type="digit" v-model="model.livro.classificacao" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="">Resenha</label>
                    <input type="text" v-model="model.livro.resenha" class="form-control">
                </div>

                <div class="mb-3">
                    <button type="button" @click="updateLivro" class="btn btn-primary">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Edit',
    data() {
        return {
            livroId: '',
            errorList: '',
            model: {
                livro: {
                    titulo: '',
                    autor: '',
                    classificacao: '',
                    resenha: ''
                }
            }
        }
    },
    mounted() {
        this.livroId = this.$route.params.id;
        this.getLivroData(this.$route.params.id);
    },

    methods: {
        getLivroData(livroId) {
            axios.get(`http://localhost:8000/api/livros/${livroId}/edit`).then(res => {
                this.model.livro = res.data.livro;
            })
            .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 404) {
                            alert(error.response.data.message);
                        }
                    }
            });
        },

        updateLivro() {
            var myThis = this;

            axios.put(`http://localhost:8000/api/livros/${this.livroId}/edit`, this.model.livro)
                .then(res => {
                    console.log(res.data);
                    alert(res.data.message);

                    this.errorList = '';
                })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            myThis.errorList = error.response.data.errors;
                        }

                        if (error.response.status === 404) {
                            alert(error.response.data.message);
                        }

                    } else if (error.request){
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                })
        }
    }
}

</script>