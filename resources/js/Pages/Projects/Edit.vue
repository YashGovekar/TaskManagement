<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    project: {
        type: Object,
    },
});

const form = useForm({
  name: props.project?.name,
  description: props.project?.description,
});

function updateProject() {
  form.put(route('projects.update', props.project.id), {
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
                  <form @submit.prevent="updateProject" class="mt-6 space-y-6">
                    <div>
                      <InputLabel for="current_password" value="Name" />

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
                      <InputLabel for="current_password" value="Description" />

                      <TextInput
                          id="description"
                          v-model="form.description"
                          type="text"
                          class="mt-1 block w-full"
                      />

                      <InputError
                          :message="form.errors.description"
                          class="mt-2"
                      />
                    </div>

                    <div class="flex items-center gap-4">
                      <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                      <Transition
                          enter-active-class="transition ease-in-out"
                          enter-from-class="opacity-0"
                          leave-active-class="transition ease-in-out"
                          leave-to-class="opacity-0"
                      >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600 dark:text-gray-400"
                        >
                          Saved.
                        </p>
                      </Transition>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
