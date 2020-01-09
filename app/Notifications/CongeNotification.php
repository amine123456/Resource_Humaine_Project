<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\User;

class CongeNotification extends Notification
{
    use Queueable;
    public $user ;
   
  
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user ;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
           
            // 'user_id'=>$this->user->id,
            // 'user_name'=>$this->user->name,
            'name' => $this->user->name , 
            'message' => $this->user->name.' a fait une demande de conge',
           
            
           

        ];
    }
   

   
    // public function toBroadcast($notifiable) {
    //     return new BroadcastMessage([
    //         'user_id'=>$this->user->id,
    //         'user_name'=>$this->user->name,
    //     ]);
    // }
    
}
