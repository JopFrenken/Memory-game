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
                </div>
                <div class="modal-body">
                    <label for="score">Please fill in your name</label>
                    <input
                        type="text"
                        name="score"
                        id="score"
                        class="form-control mt-3"
                        v-model="name"
                    />
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" @click="saveScore()"
                        >Save score</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
        };
    },

    methods: {
        saveScore() {
            if (this.name !== "") {
                console.log(this.name);
            }
        },
    },
};
</script>

<style></style>
