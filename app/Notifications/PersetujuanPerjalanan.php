<?php

namespace App\Notifications;

use App\Channels\WhatsAppChannel;
use App\Channels\Messages\WhatsappMessage;
use App\Models\PerjalananDinas;
use App\Models\PerjalananDinasUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PersetujuanPerjalanan extends Notification
{
    use Queueable;

    public $perjalananDinasUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PerjalananDinasUser $perjalananDinasUser)
    {
        $this->perjalananDinasUser = $perjalananDinasUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsapp($notifiable)
    {
        $name = $this->perjalananDinasUser->user->name;

        return (new WhatsappMessage)
            ->content("Surat Perjalanan Dinas dan Surat Tugas dengan Nama {$name} sudah bisa diambil ke Tata Usaha");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
