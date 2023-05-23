<template>
  <div>
    <button @click="linkConstructor">Search</button><br>

    <select v-model="Industry" id="Industry" @change="logSelectedValue($event.target.value, 'Industry')">
      <option v-for="industry in this.Industries" :value="industry.industry_name" >{{industry.industry_name}}</option>
    </select><br>
    <select v-model="Headcount" id="Headcount" @change="logSelectedValue($event.target.value, 'Headcount')">
      <option v-for="intervals in this.HeadcountIntervals" :value="intervals.headcount_interval" >{{intervals.headcount_interval}}</option>
    </select><br>
    <select v-model="HeadQuarters" id="Headquarter" @change="logSelectedValue($event.target.value, 'Headquarter')">
      <option v-for="hq in this.places" :value="hq.industry_name" >{{hq.industry_name}}</option>
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
    fetch(process.env.VUE_APP_ROOT_API+'filter/getIndustryNames/')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.Industries = dataaray
    })
    fetch(process.env.VUE_APP_ROOT_API+'filter/getHeadcount/')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.HeadcountIntervals = dataaray
    })
    fetch(process.env.VUE_APP_ROOT_API+'filter/getHeadquarters/')
      .then(response => response.json())
      .then(data => {
      const dataaray = data
      this.places = dataaray
    })
  },
  data() {
    return {
      WantedIndustry: document.getElementById('Industry'),
      WantedHeadcount: document.getElementById('Headcount'),
      WantedHeadquarter: document.getElementById('Headquarter'),
      Industries: [],
      HeadcountIntervals: [],
      places: []

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
    logSelectedValue(value, field) {
      switch (field) {
        case 'Industry':
          this.WantedIndustry = value;
          console.log('Selected Industry:', value);
          break;
        case 'Headcount':
          this.WantedHeadcount = value;
          console.log('Selected Headcount:', value);
          break;
        case 'Headquarter':
          this.WantedHeadquarter = value;
          console.log('Selected Headquarter:', value);
          break;
        default:
          break;
      }
    },
    linkConstructor() {

      fetch(process.env.VUE_APP_ROOT_API+'filter/getIdByIndustry/'+this.WantedIndustry)
        .then(response => response.json())
        .then(response => {
          let IndustryID = response.ID
        })
        .then(fetch(process.env.VUE_APP_ROOT_API+'filter/getIdByHeadQuarters/'+this.WantedHeadquarter))
          .then(response => response.json())
          .then(response =>{
            let HQID = response.ID
          })
          .then(fetch(process.env.VUE_APP_ROOT_API+'filter/getIdByHeadcount/'+this.WantedHeadcount))
            .then(response => response.json())
            .then(response => {
              let HeadCountID = response.ID
            })


    }
  }

}

</script>