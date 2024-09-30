<?php

namespace App\Enums;

/**
 * Status of a task
 */
enum TaskStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
