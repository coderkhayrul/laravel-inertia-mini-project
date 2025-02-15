<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, router } from "@inertiajs/vue3";

defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const updatePageNumber = (link) => {
    let pageNumber = link.url.split("page=")[1];

    router.visit("/students?page=" + pageNumber, {
        preserveState: true,
    });
    // console.log(pageNumber);
};
</script>

<template>
    <div class="my-2">
        <div class="mx-auto max-w-7xl lg:px-8">
            <!-- Pagination here -->
            <div class="flex justify-between">
                <div>
                    <span class="text-gray-700 dark:text-gray-400">
                        Showing
                        <span class="font-medium">
                            {{ data.meta.from }}
                        </span>
                        to
                        <span class="font-medium">
                            {{ data.meta.to }}
                        </span>
                        of
                        <span class="font-medium">
                            {{ data.meta.total }}
                        </span>
                        results
                    </span>
                </div>
                <div>
                    <button
                        @click.prevent="updatePageNumber(link)"
                        v-for="(link, index) in data.meta.links"
                        :disabled="link.url === null"
                        :key="index"
                        class="px-4 py-2 text-white bg-indigo-500 rounded-md paginationButton"
                        :class="{
                            'text-white bg-indigo-700 hover:bg-indigo-700':
                                link.active,
                            'text-gray-500 bg-gray-300': !link.active,
                        }"
                    >
                        <span v-html="link.label"> </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.paginationButton {
    margin-right: 2px;
}
</style>
