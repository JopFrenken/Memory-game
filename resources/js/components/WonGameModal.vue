<template>
    <div
        class="modal wonmodal"
        tabindex="-1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">You won!</h5>
                    <span>Clicks: {{ clicked }}</span>
                </div>
                <div class="modal-body">
                    <label for="score">Please fill in your name</label>
                    <input
                        type="text"
                        name="score"
                        id="score"
                        maxlength="15"
                        class="form-control mt-3 input-name"
                        v-model="name"
                    />
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" @click="saveScore()"
                        >Save score & restart game</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import gameApi from "../api/game";
export default {
    props: {
        clicked: {
            type: Number,
        },
    },

    data() {
        return {
            name: "",
        };
    },

    methods: { // calls send-data method
        saveScore() {
            if (this.name !== "") {
                this.$emit("send-data", this.name);
                document.querySelector('.input-name').textContent = "";
            }
        },
    },
};
</script>