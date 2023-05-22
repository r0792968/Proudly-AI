<template>
  <div>
    <input type="text" v-model="searchText" placeholder="Search">
    <button @click="redirectToResults">Search</button>

    <select v-model="Industry">
      <option v-for="industry in this.Industries" value="Industry">{{industry.industry_name}}</option>
    </select>
    <select v-model="Headcount">
      <option value="filter1">1-10</option>
      <option value="filter1">11-50</option>
      <option value="filter1">51-200</option>
      <option value="filter1">201-500</option>
      <option value="filter1">501-1000</option>
      <option value="filter1">1001-5000</option>
      <option value="filter1">5001-10000</option>
      <option value="filter1">10001+</option>
    </select>
    <select v-model="HeadQuarters">
      <option value="filter1">APAC</option>
      <option value="filter1">APJ</option>
      <option value="filter1">Benelux</option>
      <option value="filter1">DACH</option>
      <option value="filter1">EMEA</option>
      <option value="filter1">MENA</option>
      <option value="filter1">Nordics</option>
      <option value="filter1">Oceania</option>
      <option value="filter1">Europe</option>
      <option value="filter1">North America</option>
      <option value="filter1">Asia</option>
      <option value="filter1">Africa</option>
      <option value="filter1">South America</option>
    </select>

  </div>
</template>

<script>
export default {
  name: 'search-page',
    props: {
      msg: String
  },
  mounted(){
    fetch('http://127.0.0.1:8000/api/filter/getIndustryNames/')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.Industries = dataaray
      console.log(this.Industries)
    })
  },
  data() {
    return {
      searchText: '',
      Filter1: 'filter1',
      Industries: []

    };
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
    redirectToResults() {
    //   const query = ;
      this.$router.push({ path: '/Result', query });
    }
  }
};
</script>