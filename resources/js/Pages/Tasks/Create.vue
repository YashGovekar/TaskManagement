<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    task: {
        type: Object,
    },
    statuses: {
        type: Object,
    },
    projects: {
        type: Object,
    },
});

const form = useForm({
  name: '',
  priority: '',
  completion_date: '',
  completion_time: '',
  status: 'todo',
  project_id: '',
});

function storeTask() {
  form.post(route('tasks.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                >
                  <form @submit.prevent="storeTask" class="mt-6 space-y-6">
                    <div>
                      <InputLabel for="name" value="Name*" />

                      <TextInput
                          id="name"
                          v-model="form.name"
                          type="text"
                          class="mt-1 block w-full"
                      />

                      <InputError
                          :message="form.errors.name"
                          class="mt-2"
                      />
                    </div>

                    <div>
                      <InputLabel for="priority" value="Priority*" />

                      <TextInput
                          id="priority"
                          v-model="form.priority"
                          type="number"
                          class="mt-1 block w-full"
                      />

                      <InputError
                          :message="form.errors.priority"
                          class="mt-2"
                      />
                    </div>

                    <div>
                      <InputLabel for="completion_date" value="Completion Date*" />

                      <TextInput
                          id="completion_date"
                          v-model="form.completion_date"
                          type="date"
                          :min="(new Date().toISOString().split('T')[0])"
                          class="mt-1 block w-auto"
                      />

                      <InputError
                          :message="form.errors.completion_date"
                          class="mt-2"
                      />
                    </div>


                    <div>
                      <InputLabel for="completion_time" value="Completion Time*" />

                      <TextInput
                          id="completion_date"
                          v-model="form.completion_time"
                          type="time"
                          class="mt-1 block w-auto"
                      />

                      <InputError
                          :message="form.errors.completion_time"
                          class="mt-2"
                      />
                    </div>

                    <div>
                      <InputLabel for="project" value="Associated Project (If any)" />

                      <select v-model="form.project_id">
                        <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                      </select>

                      <InputError
                          :message="form.errors.project_id"
                          class="mt-2"
                      />
                    </div>

                    <div>
                      <InputLabel for="status" value="Status" />

                      <select v-model="form.status">
                        <option v-for="status in statuses" :key="status" :value="status">{{ $snakeToProperCase(status) }}</option>
                      </select>

                      <InputError
                          :message="form.errors.status"
                          class="mt-2"
                      />
                    </div>

                    <div class="flex items-center gap-4">
                      <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
