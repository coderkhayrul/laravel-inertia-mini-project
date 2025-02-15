<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    students: {
        type: Object,
        default: () => [],
        required: true,
    },
});

console.log(usePage().props.students);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    All Student
                </h2>
                <button class="px-3 py-2 text-white bg-indigo-600 rounded-md">
                    Add Student
                </button>
            </div>
        </template>

        <div class="mt-4">
            <div class="mx-auto max-w-7xl lg:px-8">
                <input
                    type="text"
                    class="rounded-md"
                    placeholder="Search Student Data..."
                />
            </div>
        </div>

        <div class="py-4">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Class</th>
                                    <th scope="col" class="px-6 py-3">
                                        Section
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="student in students.data"
                                    :key="student.id"
                                    class="border-b border-gray-200 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ student.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ student.email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ student.class.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ student.section.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ student.created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a
                                            href="#"
                                            class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit
                                        </a>
                                        <a
                                            href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            >Delete
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <Pagination :data="students" />
    </AuthenticatedLayout>
</template>
