<template>
      <div class="d-flex justify-content-center flex-column align-items-center mt-2">
        <h1>Guess the number game</h1>
      </div>
      <div>
        <div class="all-inputs-container border m-2 p-2 px-5">
          <div class="input d-flex flex-column mt-3">
            <label for="name">Your name</label>
            <input name="name" type="text" class="mt-1 name" v-model="gameData.name">
          </div>
          <div class="input d-flex flex-column mt-3">
            <label for="minimum">Set minimum</label>
            <input name="minimum" type="number" class="mt-1 min" v-model="gameData.minNumber">
          </div>
          <div class="input d-flex flex-column mt-3">
            <label for="maximum">Set maximum</label>
            <input name="maximum" type="number" class="mt-1 max" v-model="gameData.maxNumber">
          </div>
          <div class="input d-flex flex-column mt-3">
            <label for="tries">Max number of tries</label>
            <input name="tries" type="number" class="mt-1 tries" v-model="gameData.maxTries">
          </div>
          <div class="input d-flex flex-column mt-3">
            <label for="seconds">Max number of seconds</label>
            <input name="seconds" type="number" class="mt-1 seconds" v-model="gameData.maxSeconds">
          </div>
          <button class="btn btn-primary mt-5" @click="startGame">Start game</button>
        </div>
      </div>
    <table class="m-2 mt-4 px-5">
      <thead>
        <tr class="theader">
          <th class="px-3 py-1">#</th>
          <th class="px-3 py-1">place</th>
          <th class="px-3 py-1">Name</th>
          <th class="px-3 py-1">Minimum</th>
          <th class="px-3 py-1">Maximum</th>
          <th class="px-3 py-1">Max seconds</th>
          <th class="px-3 py-1">Max tries</th>
          <th class="px-3 py-1">Num guesses</th>
          <th class="px-3 py-1">Time to beat</th>
          <th class="px-3 py-1">Answer</th>
          <th class="px-3 py-1">Play date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in sortedUsers" :key="index">
          <td class="px-3">{{ user.id }}</td>
          <td class="px-3">{{ index + 1 }}</td>
          <td class="px-3">{{ user.name }}</td>
          <td class="px-3">{{ user.minimum }}</td>
          <td class="px-3">{{ user.maximum }}</td>
          <td class="px-3">{{ user.seconds }}</td>
          <td class="px-3">{{ user.tries }}</td>
          <td class="px-3">{{ user.guesses }}</td>
          <td class="px-3">{{ user.seconds_to_beat }}</td>
          <td class="px-3">{{ user.answer }}</td>
          <td class="px-3">{{ user.play_date }}</td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script>
  import router from "../router";
  import {useToast} from "vue-toastification";
  import gameDataApi from "../api/gamedata"
  export default {
    data(){
      return {
        gameData: {
          name: "",
          minNumber: 0,
          maxNumber: 0,
          maxTries: 0,
          maxSeconds: 0,
        },
        users: []
      }
    },

    computed: {
      sortedUsers() {
        return this.users.sort((a, b) => a.seconds_to_beat - b.seconds_to_beat);
      },
    },

    mounted(){
      if(document.querySelector('.modal-backdrop') != null) {
        document.querySelector('.modal-backdrop').remove();
      }
      this.getUsers();
      let numberInputs = document.querySelectorAll('input[type="number"]')
      numberInputs.forEach(input => {
        input.addEventListener('input', e => {
          input.value = input.value.replace(/[^0-9]/g, '');
        })
      })
    },

    methods: {
      startGame(){
          const toast = useToast();
            if (!$('input').filter(function() { return $.trim(this.value) === ''; }).length) {
                if($('.min').val() >= 0){
                    if($('.max').val() > $('.min').val()){
                        if($('.tries').val() > 0 && $('.seconds').val() > 0){
                            gameDataApi.setUser(this.gameData).then((res) => {
                                // console.log(res);
                            })
                            router.push('/game');
                        } else {
                            toast.error("The tries and/or seconds can't be 0.")
                        }
                    } else {
                      console.log($('.min').val());
                      console.log($('.max').val());
                      toast.error("Maximum can't be the same/equal as the minimum")
                    }
                } else {
                    toast.error("Minimum can't be less than 0")
                }
            } else {
              toast.error('Please fill in the inputs.')
            }
      },

      getUsers(){
          gameDataApi.getUsers().then((res) => {
            res.data.users.forEach((element) => {
              this.users.push(element);
              console.log(this.users);
              })
          })  
      }
    }
  }
  </script>
<style>
  table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-of-type(even) {
  background-color: #dddddd;
}

.theader{
  background-color: #dddddd;
}
</style>