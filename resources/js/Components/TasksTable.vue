<script setup>
import {ref} from "vue";
import {router, useForm} from "@inertiajs/vue3";

const props = defineProps({
  tasks: {
    type: Object
  }
})

// Define rows data
const rows = ref(props.tasks);

let draggedIndex = ref(null);
let oldPriority = ref(null);

// When drag starts, get the old priority and row picked
const onDragStart = (index, priority) => {
  draggedIndex.value = index;
  oldPriority.value = priority;
};

// Process logic when drag of a task ends and process the priority change logic
const onDrop = (index, newPriority) => {
  const droppedOnRow = rows.value[index];

  const draggedRow = rows.value.splice(draggedIndex.value, 1)[0];
  rows.value.splice(index, 0, draggedRow);

  draggedRow.priority = newPriority;
  droppedOnRow.priority = oldPriority.value;

  const form = useForm({
    old_priority: oldPriority,
    new_priority: newPriority,
  });

  form.patch(route('tasks.update.priority'), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: function (res) {
      rows.value = res.props.tasks;
    }
  });
};

function deleteTask(task) {
  // Show an alert first whether they want to delete this record.
  if (! confirm('Are you sure, you want to delete this record?')) {
    return;
  }

  // Process delete if user confirms above.
  useForm({}).delete(route('tasks.destroy', task.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
    },
  });
}
</script>

<template>
  <table class="w-full table table-auto">
    <thead>
    <tr class="data-table-header">
      <th class="text-left hidden md:table-cell">Priority</th>
      <th class="text-left hidden md:table-cell">Task</th>
      <th class="text-left hidden md:table-cell">Project Associated</th>
      <th class="text-left hidden md:table-cell">Completion On</th>
      <th class="text-left hidden md:table-cell">Status</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <tr
        v-for="(task, index) in rows"
        :key="task.id"
        :draggable="true"
        @dragstart="onDragStart(index, task.priority)"
        @dragover.prevent
        @drop="onDrop(index, task.priority)"
    >
      <td class="text-left">#{{ task.priority }}</td>
      <td class="text-left">{{ task.name }}</td>
      <td class="text-left">{{ task.project?.name }}</td>
      <td class="text-left">{{ task.completion_date_time }}</td>
      <td>{{ $snakeToProperCase(task.status) }}</td>
      <td class="flex flex-row gap-2 justify-center">
        <button class="text-primary" @click="$inertia.visit(route('tasks.edit', task.id))">Edit</button>
        <form @submit.prevent="deleteTask(task)">
          <button class="text-red-500" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>