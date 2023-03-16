<template>
    <div class="flip-card">
        <div class="flip-card-front"></div>
        <div class="flip-card-back">
            <img :src="image" alt="memory-card" />
        </div>
    </div>
</template>
<script>
export default {
    props: {
        image: String,
        dataCard: String,
    },

    data() {
        return {
            count: 0,
        };
    },
};
</script>
<style>
/* The flip card container */
.flip-card {
    background-color: transparent;
    width: 150px;
    height: 120px;
    border: 1px solid #f1f1f1;
    perspective: 1000px;
    position: relative;
    text-align: center;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.flip-card.flipped,
.flip-card.found {
    pointer-events: none;
    transform: rotateY(180deg);
}

/* Position the front side */
.flip-card-front {
    position: absolute;
    pointer-events: none;
    width: 100%;
    height: 100%;
    background-color: #bbb;
    color: black;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}

/* Position the back side */
.flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    background-color: rgb(162, 219, 229);
    color: white;
    transform: rotateY(180deg);
    display: flex;
    align-content: center;
    justify-content: center;
    padding: 15px;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
</style>
