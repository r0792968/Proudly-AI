<template>
  <div class="login">
      <div >
      <h2>Login</h2>
      <form @submit.prevent="login">
        <label for="username">Username:</label>
        <input type="text" id="username" v-model="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" v-model="password" required>

        <input type="submit" value="Login">
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: 'login-page',
  props: {
    msg: String
  },
  data () {
    return {
      username: '',
      password: '',
      isLoggedIn: false
    }
  },
  methods: {
    login () {
      // Here, you would typically send the login request to a server for validation
      // For the sake of simplicity, we'll assume the login is successful
      // In a real application, you would implement proper authentication and authorization
      this.isLoggedIn = true
    }
  }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
