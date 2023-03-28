<template>
    <div class="stopwatch">
        <span class="time h1 text-light">{{ formattedTime }}</span>
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
            timeElapsed: null,
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

    computed: {
        // Formats the time in: min:sec:ms
        formattedTime() {
            // If startTime is false, display "00:00.000"
            if (!this.startTime) {
                return "00:00.000";
            }

            // Calculate time elapsed in milliseconds
            this.timeElapsed = this.currentTime - this.startTime;

            // Convert milliseconds to minutes
            const minutes = Math.floor(
                (this.timeElapsed % (1000 * 60 * 60)) / (1000 * 60)
            );

            // milliseconds to seconds
            const seconds = Math.floor((this.timeElapsed % (1000 * 60)) / 1000);
            const milliseconds = Math.floor(this.timeElapsed % 1000);

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
};
</script>