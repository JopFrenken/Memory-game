<template>
    <div class="page-container">
        <div class="highscores-container"></div>
        <button @click="test()">ee</button>
        <div class="card-grid d-flex flex-column">
            <span class="timer mb-5"
                ><Stopwatch :start="startedGame"></Stopwatch
            ></span>
            <div class="memory-game card-container mt-3">
                <MemoryCard
                    v-for="(card, index) in randomizeArray"
                    :key="index"
                    :image="card.image"
                    :data-card="card.data"
                    @click="flipCard(card.data, $event)"
                />
            </div>
        </div>
    </div>
    <WonGameModal></WonGameModal>
</template>

<script>
import router from "../router";
import { useToast } from "vue-toastification";
import MemoryCard from "../components/MemoryCard.vue";
import Stopwatch from "../components/Stopwatch.vue";
import WonGameModal from "../components/WonGameModal.vue";
export default {
    data() {
        return {
            cards: [
                { image: "img/triforce.png", data: "zelda" },
                { image: "img/mario.webp", data: "mario" },
                { image: "img/kirby.webp", data: "kirby" },
                { image: "img/portal.png", data: "portal" },
                { image: "img/gta.png", data: "gta" },
                { image: "img/smash.png", data: "smash" },
                { image: "img/sonic.png", data: "sonic" },
                { image: "img/pokeball.png", data: "pokemon" },
                { image: "img/mk.png", data: "mk" },
                { image: "img/metroid.png", data: "metroid" },
                { image: "img/triforce.png", data: "zelda" },
                { image: "img/mario.webp", data: "mario" },
                { image: "img/kirby.webp", data: "kirby" },
                { image: "img/portal.png", data: "portal" },
                { image: "img/gta.png", data: "gta" },
                { image: "img/smash.png", data: "smash" },
                { image: "img/sonic.png", data: "sonic" },
                { image: "img/pokeball.png", data: "pokemon" },
                { image: "img/mk.png", data: "mk" },
                { image: "img/metroid.png", data: "metroid" },
            ],
            dataArr: [],
            clickedEl: [],
            isFlipped: false,
            startedGame: false,
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
        if (document.querySelector(".modal-backdrop") != null) {
            document.querySelector(".modal-backdrop").remove();
        }
    },

    methods: {
        test() {
            $(".wonmodal").modal("show");
        },
        // handles the flip logic
        flipCard(data, event) {
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
                            setTimeout(() => {
                                alert("YOOOO");
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
    },
};
</script>

<style>
.card-grid {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    grid-template-rows: repeat(4, 1fr);
    gap: 10px;
}
</style>
