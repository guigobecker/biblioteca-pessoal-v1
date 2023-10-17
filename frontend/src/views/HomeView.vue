<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>
          Livros
          <RouterLink to="/create" class="btn btn-primary float-end">
            Adicionar
          </RouterLink>
        </h4>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Título</th>
              <th>Autor</th>
              <th>Classificação</th>
              <th>Resenha</th>
              <th>Data de adição</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(livro, index) in this.livros" :key="index">
              <td>{{ livro.titulo }}</td>
              <td>{{ livro.autor }}</td>
              <td>{{ livro.classificacao }}</td>
              <td>{{ livro.resenha }}</td>
              <td>{{ livro.created_at }}</td>
              <td>
                <RouterLink :to="{ path: '/livros/'+ livro.id +'/edit' }" class="btn btn-success">
                  Editar
                </RouterLink>
                <button type="button" class="btn btn-danger">Deletar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'livros',
  
  data() {
    return {
      livros: [],
    }
  },
  
  mounted() {
    this.getLivros();
  },

  methods: {
    getLivros() {
      axios.get('http://localhost:8000/api/livros').then(res => {
        this.livros = res.data.livros;
      })
    }
  }
}

</script>