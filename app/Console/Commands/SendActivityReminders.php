<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use App\Notifications\ActivityDueReminder;
use Illuminate\Support\Facades\Notification;

class SendActivityReminders extends Command
{
    protected $signature = 'activities:send-reminders';
    protected $description = 'Due olan aktiviteler için bildirim gönder';

    public function handle()
    {
        $now    = now();
        $target = $now->copy()->addHour();

        $activities = Activity::whereNotNull('due_at')
            ->whereBetween('due_at', [$now, $target])
            ->get();

        if ($activities->isEmpty()) {
            $this->info('Bu saat aralığında gönderilecek aktivite yok.');
            return 0;
        }

        foreach ($activities as $activity) {
            $user = optional($activity->subject)->user;
            if (! $user) {
                $this->warn("Activity {$activity->id} — user bulunamadı, atlandı.");
                continue;
            }
            Notification::send($user, new ActivityDueReminder($activity));
            $this->info("Activity {$activity->id} → User {$user->id} bildirim gönderildi.");
        }

        return 0;
    }
}