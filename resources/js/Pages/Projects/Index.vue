<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  projects: {
    type: Object
  }
})

const form = useForm({});
function deleteProject(project) {
  // Show an alert first whether they want to delete this record.
  if (! confirm('Are you sure, you want to delete this record?')) {
    return;
  }

  // Process delete if user confirms above.
  form.delete(route('projects.destroy', project.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2
            class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
        >
          Projects
        </h2>
        <PrimaryButton @click="$inertia.visit(route('projects.create'))">Create Project</PrimaryButton>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
        >
          <div class="bg-white rounded-md shadow overflow-x-auto p-3">
            <table class="w-full table table-auto">
              <thead>
              <tr class="data-table-header">
                <th class="text-left hidden md:table-cell">Name</th>
                <th class="text-left hidden md:table-cell">Description</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for="project in projects">
                  <td class="text-left">{{ project.name }}</td>
                  <td>{{ project.description }}</td>
                  <td class="flex flex-row gap-2 justify-center">
                    <button class="text-primary" @click="$inertia.visit(route('projects.edit', project.id))">Edit</button>
                    <form @submit.prevent="deleteProject(project)">
                      <button class="text-red-500" type="submit">Delete</button>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
