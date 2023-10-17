<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Adicionar livro</h4>
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
                    <button type="button" @click="saveLivro" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Create',
    data() {
        return {
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

    methods: {
        saveLivro() {
            var myThis = this;

            axios.post('http://localhost:8000/api/livros', this.model.livro)
                .then(res => {
                    console.log(res.data);
                    alert(res.data.message);

                    this.model.livro = {
                        titulo: '',
                        autor: '',
                        classificacao: '',
                        resenha: ''
                    }

                    this.errorList = '';
                })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status === 422) {
                            myThis.errorList = error.response.data.errors;
                        }
                    } else if (error.request    ){
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }
                })
        }
    }
}

</script>