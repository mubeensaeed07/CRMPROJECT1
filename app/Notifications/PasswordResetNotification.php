<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    protected $newPassword;

    /**
     * Create a new notification instance.
     */
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Password Reset - CRM System')
            ->greeting('Hello ' . $notifiable->full_name . '!')
            ->line('Your password has been reset by an administrator.')
            ->line('Your new login credentials are:')
            ->line('**Email:** ' . $notifiable->email)
            ->line('**New Password:** ' . $this->newPassword)
            ->line('Please change your password after your first login for security purposes.')
            ->action('Login to CRM System', url('/login'))
            ->line('If you did not request this password reset, please contact your administrator immediately.')
            ->salutation('Best regards, CRM Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your password has been reset. Please check your email for new credentials.',
        ];
    }
}
