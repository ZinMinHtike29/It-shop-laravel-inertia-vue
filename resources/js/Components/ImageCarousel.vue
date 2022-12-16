<template>
    <div class="position-relative">
        <div class="d-flex justify-content-center" style="height: 250px">
            <div class="" v-for="(i, index) in image" :key="index">
                <transition
                    enter-active-class="animate__animated animate__fadeInLeft animate__faster"
                    leave-active-class="animate__animated animate__fadeOutRight animate__faster"
                    mode="in-out"
                >
                    <img
                        :src="/storage/ + i.image"
                        class="d-block w-100"
                        v-if="currentImage == index"
                    />
                </transition>
            </div>
        </div>
        <div class="fa-icon">
            <i
                class="fa-solid fa-chevron-left me-3 fs-5 text-primary"
                @click="reduceindex"
            ></i>
            <i
                class="fa-solid fa-chevron-right fs-5 text-primary"
                @click="addindex"
            ></i>
        </div>
    </div>
</template>

<script>
export default {
    name: "ImageCarousel",
    props: {
        image: {},
    },
    data() {
        return {
            currentImage: 0,
        };
    },
    methods: {
        addindex() {
            if (this.currentImage >= this.image.length - 1) {
                this.currentImage = 0;
            } else {
                this.currentImage++;
            }
        },
        reduceindex() {
            if (this.currentImage <= 0) {
                this.currentImage = this.image.length - 1;
            } else {
                this.currentImage--;
            }
        },
    },
};
</script>

<style scoped>
.fa-icon {
    position: absolute;
    right: 10px;
    top: 10px;
}
</style>
