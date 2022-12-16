<template>
    <div class="alert alert-success position-absolute">
        <i class="fa-solid fa-check"></i>
        {{ success }}
    </div>
</template>

<script>
export default {
    name: "toastr",
    props: {
        success: "",
    },
};
</script>

<style scoped></style>
