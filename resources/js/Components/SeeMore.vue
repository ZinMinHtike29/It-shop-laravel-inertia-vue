<template>
    <div>
        <p class="text-muted mb-0" v-if="!clickStatus">
            {{ userData.substr(0, 30) }}
            <span
                class="text-primary"
                @click="clickStatus = !clickStatus"
                v-if="userData.length > 30"
                >...See More</span
            >
        </p>
        <p class="text-muted mb-0" v-if="clickStatus">
            {{ userData }}
            <span class="text-primary" @click="clickStatus = !clickStatus"
                >See Less</span
            >
        </p>
    </div>
</template>

<script>
export default {
    name: "SeeMore",
    props: {
        userData: "",
    },
    data() {
        return {
            clickStatus: false,
        };
    },
};
</script>

<style lang="stylus" scoped></style>
