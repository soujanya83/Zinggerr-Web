<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Illuminate\Notifications\Messages\DatabaseMessage;
class CourseCreatedNotification extends Notification
{
    use Queueable;

    protected $course;

    public function __construct($course)
    {
        $this->course = $course;
    }

    public function via($notifiable)
    {
        return ['database']; // Store in database
    }

    public function toDatabase($notifiable)
    {
        $ageGroupSlug = Str::slug($this->course->age_group);
        $areaSlug = Str::slug($this->course->area);

        return [
            'title' => 'New Course Created',
            'message' => "A new course '{$this->course->course_full_name}' has been created.",
            'time' => now()->toDateTimeString(),
            'url' => url('/courses/' . $ageGroupSlug . '/' . $areaSlug), // URL with slug
        ];
    }
}
