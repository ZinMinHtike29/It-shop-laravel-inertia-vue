<template>
    <div class="">
        <img :src="/storage/ + image" class="w-100" alt="" />
        <input type="file" class="form-control mt-1" @change="setImage" />
        <button
            class="btn btn-info my-3 float-end"
            @click="update"
            :disabled="updateImage == ''"
        >
            Update Image
        </button>
    </div>
</template>

<script>
export default {
    name: "UpdateImage",
    props: {
        image: "",
        imageId: "",
        productId: "",
        index: "",
    },
    data() {
        return {
            updateImage: "",
        };
    },
    methods: {
        setImage(e) {
            this.updateImage = e.target.files[0];
        },
        update() {
            let data = {
                index: this.index,
                oldImage: this.image,
                updateFile: this.updateImage,
                imageId: this.imageId,
                productId: this.productId,
            };
            this.$emit("value", data);
        },
    },
};
</script>

<style lang="stylus" scoped></style>
