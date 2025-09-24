<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification
{
    use Queueable;

    protected $password;
    protected $adminName;

    /**
     * Create a new notification instance.
     */
    public function __construct($password, $adminName = null)
    {
        $this->password = $password;
        $this->adminName = $adminName;
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
            ->subject('Welcome to CRM System - Your Account Has Been Created')
            ->greeting('Hello ' . $notifiable->full_name . '!')
            ->line('Your account has been created by ' . ($this->adminName ?? 'an administrator') . '.')
            ->line('You can now access the CRM system with the following credentials:')
            ->line('**Email:** ' . $notifiable->email)
            ->line('**Password:** ' . $this->password)
            ->line('Please change your password after your first login for security purposes.')
            ->action('Login to CRM System', url('/login'))
            ->line('If you have any questions, please contact your administrator.')
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
            'message' => 'Your account has been created. Please check your email for login credentials.',
        ];
    }
}
