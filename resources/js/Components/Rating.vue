<template>
    <div class="d-flex align-items-center">
        <div class="me-2 p-2 rounded">
            <i
                class="fa-regular fa-star me-1 text-primary"
                @click="addRating(1)"
                :class="value >= 1 ? 'text-primary' : ''"
                v-if="value < 1"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                @click="addRating(1)"
                :class="value >= 1 ? 'text-primary' : ''"
                v-if="value >= 1"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                @click="addRating(2)"
                :class="value >= 2 ? 'text-primary' : ''"
                v-if="value < 2"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                @click="addRating(2)"
                :class="value >= 2 ? 'text-primary' : ''"
                v-if="value >= 2"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                @click="addRating(3)"
                :class="value >= 3 ? 'text-primary' : ''"
                v-if="value < 3"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                @click="addRating(3)"
                :class="value >= 3 ? 'text-primary' : ''"
                v-if="value >= 3"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                @click="addRating(4)"
                :class="value >= 4 ? 'text-primary' : ''"
                v-if="value < 4"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                @click="addRating(4)"
                :class="value >= 4 ? 'text-primary' : ''"
                v-if="value >= 4"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                @click="addRating(5)"
                :class="value >= 5 ? 'text-primary' : ''"
                v-if="value < 5"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                @click="addRating(5)"
                :class="value >= 5 ? 'text-primary' : ''"
                v-if="value >= 5"
            ></i>
        </div>
        <div class="">
            <button
                class="btn btn-outline-primary"
                @click="emitRatingValue"
                :disabled="ratingStatus"
            >
                Add Rating
            </button>
        </div>
    </div>
    <div class="" v-if="valueStaus">
        <small class="text-danger">Rating Value Is Require!</small>
    </div>
</template>

<script>
export default {
    name: "Rating",
    data() {
        return {
            value: "",
            ratingStatus: false,
            valueStaus: false,
        };
    },
    methods: {
        addRating(value) {
            this.value = value;
        },
        emitRatingValue() {
            this.valueStaus = this.value == "" ? true : false;
            if (!this.valueStaus) {
                this.ratingStatus = true;
                this.$emit("value", this.value);
            }
        },
    },
};
</script>

<style scoped>
.fa-star {
    font-size: 20px;
}
</style>
