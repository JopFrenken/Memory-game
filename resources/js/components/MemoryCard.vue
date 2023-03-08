<template>
    <div class="flip-card" @click="flip">
        <div class="flip-card-inner" :class="{ 'flipped': isFlipped }">
            <div class="flip-card-front"></div>
            <div class="flip-card-back">
                <img :src="image" alt="memory-card">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'image': String
    },

    mounted(){
        console.log(this.image);
    },

    data() {
        return {
            isFlipped: false
        }
    },

    methods: {
        flip() {
            this.isFlipped = !this.isFlipped;
        }
    }
}
</script>

<style>
/* The flip card container */
.flip-card {
    background-color: transparent;
    width: 150px;
    height: 120px;
    border: 1px solid #f1f1f1;
    perspective: 1000px;
}

/* Position the front and back side */
.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

/* Apply the flip  */
.flip-card-inner.flipped {
    transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front,
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

/* Style the front side */
.flip-card-front {
    background-color: #bbb;
    color: black;
}

/* Style the back side */
.flip-card-back {
    background-color: rgb(162, 219, 229);
    color: white;
    transform: rotateY(180deg);
    display: flex;
    align-content: center;
    justify-content: center;
    padding: 15px;
}
</style>
