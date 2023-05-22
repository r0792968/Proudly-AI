<template>
  <div>
    <h1>RESULTS</h1>
    <table>

    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      companys: []
    }
  },
    beforeRouteEnter (to, from, next) {
      const isLoggedIn = sessionStorage.getItem('LoggedInStatus')
      if (isLoggedIn) {
        next()
      } else {
        next('/login')
      }
    },
  methods: {
  }
};
</script>