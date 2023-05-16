<template>
  <div class="login">
      <div >
      <h2>Login</h2>
      <form @submit.prevent="login">
        <label for="E-Mail">E-mail:</label>
        <input type="text" id="i-email" v-model="email" required>

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
      mail: document.getElementById('e-mail'),
      password: document.getElementById('password'),
      isLoggedIn: false
    }
  },
  methods: {
    login () {
      const OPTIONS = {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          // eslint-disable-next-line
          'mail': this.mail
        }
      }
      fetch('http://127.0.0.1:8000/api/getUser/somemail@gmail.com/test123', OPTIONS)
        .then(response => response.json())
        .then(response => console.log(response))
    }
  }
}
</script>
<style scoped>
h2 {
  text-align: center;
}

form {
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 100px;
}

form label {
  display: block;
  margin-bottom: 10px;
}

form input[type="text"],
form input[type="password"] {
  width: 100%;
  padding: 5px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

form input[type="submit"] {
  width: 100%;
  background-color: crimson;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #45a049;
}

</style>
