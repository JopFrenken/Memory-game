<template>
    <div class="stopwatch">
        <span class="time">{{ formattedTime }}</span>
    </div>
</template>

<script>
export default {
    props: {
        start: {
            type: Boolean,
        },
    },
    data() {
        return {
            startTime: null,
            currentTime: null,
            timer: null,
        };
    },

    // When you click on card, start is true. This code watches that variable
    // and starts the timer when that happens. If false stops timer
    watch: {
        start: {
            immediate: true,
            handler(newValue) {
                if (newValue) {
                    this.startTimer();
                } else {
                    this.stopTimer();
                }
            },
        },
    },

    methods: {
        // Starts timer with milliseconds
        startTimer() {
            this.startTime = new Date();
            this.timer = setInterval(() => {
                this.currentTime = new Date();
            }, 10);
        },

        // clears timer and sets it to 0
        stopTimer() {
            clearInterval(this.timer);
        },
    },

    computed: {
        // Formats the time in: min:sec:ms
        formattedTime() {
            // If startTime is false, display "00:00.000"
            if (!this.startTime) {
                return "00:00.000";
            }

            // Calculate time elapsed in milliseconds
            const timeElapsed = this.currentTime - this.startTime;

            // Convert milliseconds to minutes
            const minutes = Math.floor(
                (timeElapsed % (1000 * 60 * 60)) / (1000 * 60)
            );

            // milliseconds to seconds
            const seconds = Math.floor((timeElapsed % (1000 * 60)) / 1000);
            const milliseconds = Math.floor(timeElapsed % 1000);

            // Concatenate the minutes, seconds and milliseconds and return the formatted string
            return (
                ("0" + minutes).slice(-2) +
                ":" +
                ("0" + seconds).slice(-2) +
                "." +
                ("00" + milliseconds).slice(-3)
            );
        },
    },
};
</script>

<style>
/* future styles */
</style>
