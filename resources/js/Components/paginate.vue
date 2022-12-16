<template>
    <nav aria-label="...">
        <ul class="pagination">
            <li
                :class="[
                    'page-item rounded-2',
                    link.active ? 'border border-2 border-primary' : '',
                ]"
                v-for="(link, index) in customizeLink"
                :key="index"
            >
                <Link :href="link.url" class="page-link">{{ link.label }}</Link>
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    name: "paginate",
    components: {
        Link,
    },
    props: {
        links: {
            type: Array,
        },
    },
    computed: {
        customizeLink() {
            this.links[0].label = "Previous";
            this.links[this.links.length - 1].label = "Next";
            return this.links;
        },
    },
};
</script>

<style lang="stylus" scoped></style>
