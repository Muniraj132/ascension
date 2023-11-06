<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Massbooking;
use App\Models\MassbookingController;
  
class UserEmail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $bodyContent;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bodyContent)
    {
        $this->bodyContent = $bodyContent;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your form will be saved')
                    ->view('email.name');
    }
}