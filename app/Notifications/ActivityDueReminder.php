<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Activity;

class ActivityDueReminder extends Notification
{
    use Queueable;

    protected Activity $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Aktivite Hatırlatma')
            ->greeting("Merhaba {$notifiable->name},")
            ->line("“{$this->activity->comment}” aktiviten için son tarih yaklaşıyor.")
            ->line("Tip: {$this->activity->type}")
            ->line("Tarih: {$this->activity->due_at->format('d.m.Y H:i')}")
            ->action('Aktiviteleri Görüntüle', url('/crm/activities'))
            ->line('İyi çalışmalar!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'activity_id'  => $this->activity->id,
            'subject_type' => $this->activity->subject_type,
            'subject_id'   => $this->activity->subject_id,
            'comment'      => $this->activity->comment,
            'due_at'       => $this->activity->due_at->toDateTimeString(),
        ];
    }
}