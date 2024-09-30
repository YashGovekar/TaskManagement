<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TasksTable from "@/Components/TasksTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
  tasks: {
    type: Object
  }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
          <div class="flex justify-between items-center">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
              Tasks
            </h2>
            <PrimaryButton @click="$inertia.visit(route('tasks.create'))">Create New Task</PrimaryButton>
          </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <TasksTable :tasks="tasks" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
