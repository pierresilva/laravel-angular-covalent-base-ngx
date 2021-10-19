<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Reset Password Notification'))
            ->line(__('You are receiving this email because we received a password reset request for your account.'))
            ->line(__('This password reset link will expire in :count minutes.', ['count' => '5']))
            ->action(__('Reset Password'), (env('APP_ENV') == 'local') ? config('app.url_front') . '/auth/password-reset/' . $this->token : config('app.url') . '/auth/password-reset/' . $this->token)
            ->line(__('If you did not request a password reset, no further action is required.'))
            ->line(__('Thank you for using our application!'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'level' => 'success',
            'subject' => __('Verify Email Address'),
            'salutation' => __('Hello') . $notifiable->first_name,
            'intro_lines' => [
                __('Please click the button below to verify your email address.')
            ],
            'action' => [
                _('Verify Your Email Address'),
                $this->verificationUrl
            ],
            'outro_lines' => [
                __('If you did not create an account, no further action is required.')
            ]
        ];
    }
}
