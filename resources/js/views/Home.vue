<template>
  <div>
    <AddTodo v-on:add-todo="addTodo" />
    <Todos v-bind:todos="todos" v-on:del-todo="deleteTodo" />
  </div>
</template>


<script>
import Todos from '../components/Todos';
import AddTodo from '../components/AddTodo';
import axios from 'axios';

export default {
  name: 'Home',
  components: {
    Todos,
    AddTodo
  },
  data() {
    return {
      todos: []
    }
  },
  methods: {
    addTodo(newTodo) {
      const { title, completed } = newTodo;
      axios.post('http://127.0.0.1:8001/api/todos', {
        title,
        completed
      })
        .then(res => this.todos = res.data.data)
        .catch(err => console.log(err));
    },
    deleteTodo(id) {
      axios.delete(`http://127.0.0.1:8001/api/todos/${id}`)
        .then(this.todos = this.todos.filter(todo => todo.id !== id))
        .catch(err => console.log(err));
    }
  },
  created() {
    axios.get('http://127.0.0.1:8001/api/todos')
      .then(res => this.todos = res.data.data)
      .catch(err => console.log(err));
  }
}
</script>