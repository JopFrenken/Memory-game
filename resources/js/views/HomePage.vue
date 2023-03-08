<template>
    <div class="page-container">
        <div class="highscores-container"></div>
        <div class="card-grid">
            <div class="memory-game card-container">
                <MemoryCard
                    v-for="(card, index) in randomizeArray"
                    :key="index"
                    :image="card.image"
                    :dataCard="card.data"
                    @click="flipCard(card.data, $event)"
                />
            </div>
        </div>
    </div>
</template>

<script>
import router from "../router";
import { useToast } from "vue-toastification";
import MemoryCard from "../components/MemoryCard.vue";
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
        };
    },

    components: {
        MemoryCard,
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

    mounted() {},

    methods: {
        // handles the flip logic
        flipCard(data, event) {
            this.dataArr.push(data);
            // checks if items in array are equal
            const allEqual = (arr) => arr.every((val) => val === arr[0]);

            this.clickedEl.push(event.target.parentNode);

            if (this.dataArr.length === 2) {
                // $('selector').click(false);
                if (allEqual(this.dataArr)) {
                    this.clickedEl.forEach((ele) => {
                        // ele.style.display = "none";
                    });

                    // this.clickedEl.forEach((element) => {
                    // 	element.classList.remove('flipped');
                    // })
                    console.log("the same");
                } else if (!allEqual(this.dataArr)) {
                    setTimeout(() => {
                        this.clickedEl.forEach((e) => {
                            e.classList.remove("flipped");
                            console.log(e);
                        });
                        this.clickedEl = [];
                    }, 1000);

                    // this.clickedEl.forEach((element) => {
                    // 	element.classList.remove('flipped')
                    // })
                    console.log("not the same");
                }
                this.dataArr = [];
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
