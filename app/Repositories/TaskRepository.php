<?php

namespace App\Repositories;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Task::class);
    }

    /**
     * Logic to change priority when records are dragged
     */
    public function updatePriority(int $old_priority, int $new_priority): bool
    {
        $changed_record = Task::where('priority', $old_priority)->first(['id', 'priority']);
        $target_record = Task::where('priority', $new_priority)->first(['id', 'priority']);

        // Use transaction, in case one of the records fail to update.
        DB::beginTransaction();

        try {
            $changed_record->priority = $new_priority;
            $changed_record->save();

            $target_record->priority = $old_priority;
            $target_record->save();

            // Everything saved successfully, we can now commit the transaction.
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction.
            DB::rollBack();
            Log::error($e->getMessage());

            return false;
        }
    }
}
