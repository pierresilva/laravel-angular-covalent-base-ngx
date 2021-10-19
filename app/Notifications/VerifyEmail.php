<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $verificationUrl;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {

        //
        $this->user = $user;
        $this->verificationUrl = $user->verificationUrl($user);
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
            ->level('success')
            ->subject(__('Verify Email Address'))
            ->greeting(__('Hello') . ' ' . $notifiable->first_name . '!')
            ->line(__('Please click the button below to verify your email address.'))
            ->action(__('Verify Your Email Address'), $this->verificationUrl)
            ->line(__('If you did not create an account, no further action is required.'));
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
