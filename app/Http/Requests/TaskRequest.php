<?php

namespace App\Http\Requests;

use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'            => ['required', 'string', 'max:255'],
            'priority'        => ['required', 'numeric', 'unique:tasks,priority'],
            'project_id'      => ['nullable', 'string', 'exists:projects,id'],
            'completion_date' => ['required', 'date'],
            'completion_time' => ['required', 'date_format:H:i'],
            'status'          => ['nullable', 'in:'.implode(',', array_map(fn ($case) => $case->value, TaskStatus::cases()))],
        ];

        if ($this->method() === 'PATCH') {
            $rules['priority'] = ['required', 'numeric', 'unique:tasks,priority,'.request()->route('task')?->id];
        }

        return $rules;
    }
}
