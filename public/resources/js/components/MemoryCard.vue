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