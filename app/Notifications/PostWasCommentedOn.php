<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostWasCommentedOn extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->post = $comment->post;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $comment_extract = "";
        if (strlen($this->comment->message) <= 50) {
            $comment_extract = $this->comment->message;
        } else {
            $comment_extract = substr($this->comment->message, 0, 20) . "...";
        }

        $comment_path = route('posts.show', ['post' => $this->post])
            . '#c' . $this->comment->id;

        return (new MailMessage)
            ->line('Your post \'' . $this->post->title . '\' was commented on.')
            ->line('the user ' . $this->comment->user . ' wrote:')
            ->line($comment_extract)
            ->action('To see the comment, click here: ', url($comment_path) )
            ->line('Thank you for using my application!');
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
