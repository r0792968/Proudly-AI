<template>
  <div>

    <select v-model="selectedIndustryID">
      <option v-for="industry in this.Industries" :value="industry.ID">{{industry.industry_name}}</option>
    </select><br>
    <select v-model="selectedHeadcount">
      <option v-for="intervals in this.HeadcountIntervals" >{{intervals.headcount_interval}}</option>
    </select><br>
    <select v-model="selectedHQ">
      <option v-for="hq in this.Places">{{hq.industry_name}}</option>
    </select><br>
    <button @click="linkConstructor">Search</button>
  </div>
</template>

<script>
export default {
  name: 'search-page',
    props: {
      msg: String
  },
  mounted(){
    fetch(process.env.VUE_APP_ROOT_API+'company/filter/allindustries')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.Industries = dataaray
    })
    fetch(process.env.VUE_APP_ROOT_API+'company/filter/allheadcounts')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.HeadcountIntervals = dataaray
    })
    fetch(process.env.VUE_APP_ROOT_API+'company/filter/allheadquarters')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.Places = dataaray
    })
  },
  data() {
    return {
      Industries: [],
      HeadcountIntervals: [],
      Places: [],
      selectedIndustryID: null,
      selectedHeadcount: null,
      selectedHQ: null,
      link: "https://www.linkedin.com/sales/search/company?"

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
      this.$router.push({ path: '/Result', query });
    },
    linkConstructor() {
      this.link += "industry=" + this.selectedIndustryID

      fetch(process.env.VUE_APP_ROOT_API+"company/filter/headquarters",{
          headers: {
            'name': this.selectedHQ
          }})
        .then(response => response.json())
        .then(response => {
          this.link += "&geoIncluded="
          this.link += response.ID
        })
        fetch(process.env.VUE_APP_ROOT_API+"company/filter/headcount",{
          headers: {
            'interval': this.selectedHeadcount
          }})
          .then(response => response.json())
          .then(response => {
          this.link += "&companySize="
          this.link += response.ID
          console.log(this.link)
          })
    }
  }

}

</script>