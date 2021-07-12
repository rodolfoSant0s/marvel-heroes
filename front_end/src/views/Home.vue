<template>
  <div class="home">
    <Header/>
    <h5>Enter the hero's name below and click the search button. It is only possible to fetch 3 heroes at a time.</h5>
    <input class="search-input" type="search" placeholder="Search Hero By Name" v-model="search"> <button class="buttonSearch" type="button" @click="getHeroByName">Search Hero</button>
    <div class="list">
      <div v-for="(item, index) in heroes" :key="index">
        <CardHero :hero="item" :deleteHero="deleteHero" />
      </div>
    </div>
  </div>
</template>

<script>
import utils from '../utils'
import axios from 'axios'
import CardHero from '../components/CardHero.vue'
import Header from '../components/Header.vue'

export default {
  name: 'Home',
  components: {
    CardHero,
    Header,
  },
  data() {
    return {
      heroes: [
          {
          loading: true,
          error: false,
          },
          {
          loading: true,
          error: false,
          },
          {
          loading: true,
          error: false,
          },                
        ], // Fiz estre tratamento para inicializar a pagina com 3 componentes aguardando informação
      error: false,
      utils: utils,
      showCard: false,
      search: ''
    }
  },
  mounted() {
    utils.heroes_selected.forEach((hero, index) => {
      axios.get(utils.base_url+'getHeroById/'+hero, {
        headers: {},
      })
        .then((response) =>  {
          this.heroes[index] = response.data
          this.heroes[index].loading = true
          this.getStorieByHero(hero, index)
        })
        .catch((error) => {
          console.log(error)
          this.heroes[index].error = true 
        });      
    });

  },
  methods: {
    getHeroByName() {
      if(this.heroes.length >= 3) {
        return this.$swal.fire({
                icon: 'error',
                title: 'Remove a Hero to search for another',
                toast: false,
                showConfirmButton: true,
                position: 'top-center',
              });
      }

      if(this.search == '') {
        return this.$swal.fire({
                icon: 'error',
                title: 'Enter a name to proceed',
                toast: false,
                showConfirmButton: true,
                position: 'top-center',
              });
      }      

      let infoAlert = this.$swal.fire({
          icon: 'info',
          title: 'Find character...',
          toast: true,
          showConfirmButton: false,
          position: 'top-center',
      }); 

      this.heroes.push({
          loading: true,
          error: false,
          },
      )
      let index = this.heroes.length-1;
      axios.post(utils.base_url+'getHeroByName', {
          name: this.search
        })
        .then((response) => {
          infoAlert.close()
          this.heroes[index] = response.data
          this.heroes[index].loading = true
          this.getStorieByHero(response.data.id, index)
        })
        .catch((error) => {
          infoAlert.close()
          this.heroes.splice(index, 1);
          console.log(error)
          return this.$swal.fire({
                  icon: 'error',
                  title: 'Unable to find the hero',
                  toast: false,
                  showConfirmButton: true,
                  position: 'top-center',
                });          
        });
    },
    getStorieByHero(hero, index) {
        axios.get(utils.base_url+'getStoriesByHeroId/'+hero)
          .then((response) => {
            this.heroes[index].stories = response.data
            this.heroes[index].loading = false 
          })
          .catch((error) => {
            console.log(error)
            this.heroes[index].errorStorie = true
          });
    },
    deleteHero(id) {
      console.log('Delete Hero '+id)
      this.heroes.forEach((hero, index) => {
        if(hero.id == id) {
          this.heroes.splice(index, 1);
        }
      });
    }
  },
}
</script>
<style>
    .list {
      margin-top: 20px;
      display: flex;
      justify-content: space-around;

    }

    .search-input {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #7b7a7a;    
      margin-bottom: 15px;  
    }

    .buttonSearch {
      padding: 9px;
    }

    .close {
      cursor: pointer;
      /* width: 35px; */
      font-size: 30px;
      color: #c0c5cb;
      align-self: flex-end;
      background-color: transparent;
      border: none;
      /* margin-bottom: 10px; */
      float: right;
      margin: 5px;      
    }

    /* Customizando layout responsivo */
    @media screen and (max-width: 1250px) {
        .list {
            display: block;
            margin: 0 15px
        }
    }
  
</style>