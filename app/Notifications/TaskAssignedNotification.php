<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\TaskModel;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;
    protected $assignedBy;

    public function __construct(TaskModel $task)
    {
        $this->task = $task;
        $this->assignedBy = auth::check() ? auth::user()->name : 'System';
    }

    public function via($notifiable)
    {
        return ['database']; // Add 'mail' if you want email too
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Task Assigned',
            'message' => "You have been assigned a new task: {$this->task->task_title}.",
            'url' => url('/assign/tasks'),
            'time' => now()->toDateTimeString(),
            // 'assigned_by' => $this->assignedBy,
        ];
    }
}
