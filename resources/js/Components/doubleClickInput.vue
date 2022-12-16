<template>
    <div>
        <span
            @dblclick="clickStatus = !clickStatus"
            class="rounded-pill d-inline"
            v-if="!clickStatus"
            >{{ title }}</span
        >
        <input
            v-if="clickStatus"
            type="text"
            class="form-control-sm p-1 rounded-pill"
            v-model="title"
            @keyup.enter="update()"
        />
        <small class="text-danger" v-if="this.title == ''"
            >Need To Fill The Category Field !</small
        >
    </div>
</template>

<script>
export default {
    name: "doubleClickInput",
    props: {
        title: "",
        Id: "",
        Index: "",
        InputStaus: false,
    },
    data() {
        return {
            clickStatus: false,
        };
    },
    methods: {
        update() {
            if (this.title != "") {
                this.$emit("updateValue", {
                    id: this.Id,
                    title: this.title,
                    index: this.Index,
                });
                this.clickStatus = false;
            }
        },
    },
};
</script>

<style lang="stylus" scoped></style>
