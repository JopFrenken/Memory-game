<template>
    <div class="page-container container-fluid">
        <div class="top-page-container  mt-5 d-flex justify-content-md-around row flex-column flex-md-row">
            <div class="button-container col d-flex justify-content-center mt-md-0">
                    <button class="lb-button text-light w-50 h-100" @click="toggleLb()">Leaderboard</button>
                </div>
            <span class="timer d-flex justify-content-center col mt-md-0 mt-2">
                <Stopwatch ref="stopwatch" :start="startedGame" v-if="isGame"></Stopwatch>
            </span>
            <div class="button-container col d-flex justify-content-center mt-2 mt-md-0">
                <button class="reset-btn text-light w-50 h-100" @click="resetGame()" v-if="isGame">Reset</button>
            </div>
        </div>
        <div class="page-container d-flex justify-content-around row">
            <div class="card-grid d-flex flex-column col align-items-center justify-content-md-center justify-content-start mt-md-0 mt-5" v-if="isGame">
                    <div class="memory-game card-container mt-md-3 mt-0">
                        <MemoryCard
                            v-for="(card, index) in randomizeArray"
                            :key="index"
                            :image="card.image"
                            :data-card="card.data"
                            @click="flipCard(card.data, $event)"
                        />
                    </div>
                </div>
            <div class="highscores-container d-md-flex flex-column justify-content-center align-items-center col-3 ms-5 table-responsive" v-else>
                <table class="table align-middle highscore-table mt-5">
                    <thead class="thead">
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>clicks</th>
                            <th>time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(score, index) in allScores" :key="index" class="mx-3">
                            <th>{{ index + 1 }}</th>
                            <th>{{ score.name }}</th>
                            <th>{{ score.clicks }}</th>
                            <th>{{ score.elapsed_time / 1000 }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <WonGameModal :clicked="clicked" @send-data="sendData"></WonGameModal>
</template>

<script>
import router from "../router";
import { useToast } from "vue-toastification";
const toast = useToast();
import gameApi from "../api/game";
import MemoryCard from "../components/MemoryCard.vue";
import Stopwatch from "../components/Stopwatch.vue";
import WonGameModal from "../components/WonGameModal.vue";
export default {
    data() {
        return {
            cards: [
                { image: "img/zelda.png", data: "zelda" },
                { image: "img/mario.png", data: "mario" },
                { image: "img/gaiden.png", data: "gaiden" },
                { image: "img/megaman.png", data: "megaman" },
                { image: "img/duck.png", data: "duckhunt" },
                { image: "img/sans.webp", data: "undertale" },
                { image: "img/btoad.webp", data: "battletoads" },
                { image: "img/pikachu.png", data: "pokemon" },
                { image: "img/ness.webp", data: "earthbound" },
                { image: "img/drmario.png", data: "drmario" },
                { image: "img/zelda.png", data: "zelda" },
                { image: "img/mario.png", data: "mario" },
                { image: "img/gaiden.png", data: "gaiden" },
                { image: "img/megaman.png", data: "megaman" },
                { image: "img/duck.png", data: "duckhunt" },
                { image: "img/sans.webp", data: "undertale" },
                { image: "img/btoad.webp", data: "battletoads" },
                { image: "img/pikachu.png", data: "pokemon" },
                { image: "img/ness.webp", data: "earthbound" },
                { image: "img/drmario.png", data: "drmario" },
            ],
            dataArr: [],
            clickedEl: [],
            isFlipped: false,
            startedGame: false,
            clicked: 0,
            allScores: [],
            isGame: true
        };
    },

    components: {
        MemoryCard,
        Stopwatch,
        WonGameModal,
    },

    computed: {
        // randomizes array so the card order is random
        randomizeArray() {
            const array = [...this.cards];
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        },
    },

    mounted() {
        this.clicked = 0;
        if (document.querySelector(".modal-backdrop") != null) {
            document.querySelector(".modal-backdrop").remove();
        }

        this.getScores();

        console.log(this.allScores);
    },

    methods: {
        // handles the flip logic
        flipCard(data, event) {
            this.clicked++;
            let allFoundCards = document.querySelectorAll(".found");
            this.startedGame = true;
            // prevent clicking on other cards while flipping
            if (
                this.dataArr.length < 2 &&
                !event.target.classList.contains("flipped")
            ) {
                event.target.classList.add("flipped");
                // Get all Flipped cards
                let allFlippedCards = document.querySelectorAll(".flipped");

                // add the data to compare it later
                this.dataArr.push(data);

                if (allFlippedCards.length === 2) {
                    // Code for if they're the same card
                    if (this.dataArr[0] === this.dataArr[1]) {
                        allFlippedCards.forEach((card) => {
                            // so the game continues if 1 pair is found
                            card.classList.add("found");
                            card.classList.remove("flipped");
                        });
                        this.dataArr = [];
                        let allFoundCards = document.querySelectorAll(".found");
                        if (allFoundCards.length === 20) {
                            // timeout to finish the flip animation
                            setTimeout(() => {
                                $(".wonmodal").modal("show");
                            }, 1000);
                            this.startedGame = false;
                        }
                    } else {
                        // Remove flipped class from all flipped cards
                        setTimeout(() => {
                            allFlippedCards.forEach((card) =>
                                card.classList.remove("flipped")
                            );
                            this.dataArr = [];
                        }, 1000);
                    }
                }
            }
        },

        sendData(name) {
            gameApi
                .sendGameData(
                    name,
                    this.clicked,
                    this.$refs.stopwatch.timeElapsed
                )
                .then((res) => {
                    toast.success(res.data.msg);
                    this.resetGame();
                    this.allScores = [];
                    this.getScores();
                })
                .catch((e) => {
                    toast.error(e);
                });
        },

        // resets the all game mechanics
        resetGame() {
            let allFoundCards = document.querySelectorAll(".found");
            let allFlippedCards = document.querySelectorAll(".flipped");
            allFlippedCards.forEach((element) => {
                element.classList.remove("flipped");
            });
            allFoundCards.forEach((element) => {
                element.classList.remove("found");
            });
            $(".wonmodal").modal("hide");

            this.$refs.stopwatch.currentTime = 0;
            this.$refs.stopwatch.startTime = 0;
            
            setTimeout(() => {
                this.cards = this.randomizeArray;
                this.dataArr = [];
                this.clickedEl = [];
                this.isFlipped = false;
                this.startedGame = false;
                this.clicked = 0;

            }, 1000);
        },

        getScores() {
            gameApi.getScores().then((res) => {
                res.data.scores.forEach((element) => {
                    this.allScores.push(element);
                });
            });
        },

        toggleLb() {
            if(this.$refs.stopwatch != null) {
                this.resetGame();
                this.startedGame = false;
            }
            this.isGame ? this.isGame = false : this.isGame = true
        }
    },
};
</script>>
