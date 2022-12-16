<template>
    <div class="d-flex align-items-center">
        <div class="me-2 mt-2 rounded">
            <i
                class="fa-regular fa-star me-1 text-primary"
                :class="value >= 1 ? 'text-primary' : ''"
                v-if="value < 1"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                :class="value >= 1 ? 'text-primary' : ''"
                v-if="value >= 1"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                :class="value >= 2 ? 'text-primary' : ''"
                v-if="value < 2"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                :class="value >= 2 ? 'text-primary' : ''"
                v-if="value >= 2"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                :class="value >= 3 ? 'text-primary' : ''"
                v-if="value < 3"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                :class="value >= 3 ? 'text-primary' : ''"
                v-if="value >= 3"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                :class="value >= 4 ? 'text-primary' : ''"
                v-if="value < 4"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                :class="value >= 4 ? 'text-primary' : ''"
                v-if="value >= 4"
            ></i>
            <i
                class="fa-regular fa-star me-1 text-primary"
                :class="value >= 5 ? 'text-primary' : ''"
                v-if="value < 5"
            ></i>
            <i
                class="fa-solid fa-star me-1 text-primary"
                :class="value >= 5 ? 'text-primary' : ''"
                v-if="value >= 5"
            ></i>
        </div>
    </div>
</template>

<script>
export default {
    name: "Rating",
    props: {
        value: {},
    },
};
</script>

<style scoped>
.fa-star {
    font-size: 20px;
}
</style>
