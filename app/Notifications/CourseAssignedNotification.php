<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class CourseAssignedNotification extends Notification
{
    use Queueable;
    public function __construct(public $course) {}
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toArray($notifiable)
    {
        $ageGroupSlug = Str::slug($this->course->age_group);
        $areaSlug = Str::slug($this->course->area);
        return [
            'title' => 'Course Assigned',
            'message' => "You have been assigned to the course '{$this->course->course_full_name}'",
            'time' => now()->toDateTimeString(),
           'url' => url('/courses/' . $ageGroupSlug . '/' . $areaSlug), // Adjust route if needed
        ];
    }
}
