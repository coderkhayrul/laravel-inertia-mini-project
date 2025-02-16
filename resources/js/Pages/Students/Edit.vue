<script setup>
import InputError from "@/Components/InputError.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";

defineProps({
    classes: {
        type: Object,
        required: true,
    },
    student: {
        type: Object,
        required: true,
    },
});

let sections = ref([]);
let student = usePage().props.student.data;

const form = useForm({
    name: student.name,
    email: student.email,
    class_id: student.class.id,
    section_id: student.section_id,
});

watch(
    () => form.class_id,
    (newValue) => {
        getSections(newValue);
    }
);

onMounted(() => {
    getSections(form.class_id);
});

const getSections = (classId) => {
    axios
        .get("/api/sections?class_id=" + classId)
        .then((response) => {
            sections.value = response.data;
        })
        .catch((error) => {
            console.log(error.response.data);
        });
};

const updateStudent = () => {
    form.put(route("students.update", student.id));
};
</script>

<template>
    <Head title="Student Update" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Update Student
                </h2>
                <Link
                    :href="route('students.index')"
                    class="px-3 py-2 text-white rounded-md bg-sky-600"
                >
                    Back Student
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="updateStudent">
                            <div class="mb-4">
                                <label
                                    for="name"
                                    class="block mb-2 text-sm font-bold text-gray-700"
                                >
                                    Name:</label
                                >
                                <input
                                    type="text"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    placeholder="Enter Name"
                                    id="name"
                                    v-model="form.name"
                                />
                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="email"
                                    class="block mb-2 text-sm font-bold text-gray-700"
                                >
                                    Email Address:</label
                                >
                                <input
                                    type="email"
                                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    placeholder="Enter Email"
                                    id="email"
                                    v-model="form.email"
                                />
                                <InputError
                                    :message="form.errors.email"
                                    class="mt-2"
                                />
                            </div>
                            <div class="mb-4">
                                <label
                                    for="class_id"
                                    class="block mb-2 text-sm font-bold text-gray-700"
                                >
                                    Class:</label
                                >
                                <select
                                    class="w-full px-3 py-2 leading-tight text-gray-700 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="class_id"
                                    v-model="form.class_id"
                                >
                                    <option
                                        v-for="item in classes.data"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.class_id"
                                    class="mt-2"
                                />
                            </div>

                            <div class="mb-4">
                                <label
                                    for="section_id"
                                    class="block mb-2 text-sm font-bold text-gray-700"
                                >
                                    Section:</label
                                >
                                <select
                                    class="w-full px-3 py-2 leading-tight text-gray-700 rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="section_id"
                                    v-model="form.section_id"
                                >
                                    <option value="">Select Section</option>
                                    <option
                                        v-for="section in sections.data"
                                        :key="section.id"
                                        :value="section.id"
                                    >
                                        {{ section.name }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.section_id"
                                    class="mt-2"
                                />
                            </div>

                            <button
                                type="submit"
                                class="px-4 py-2 my-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                            >
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
