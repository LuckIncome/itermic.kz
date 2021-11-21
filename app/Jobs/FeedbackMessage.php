<?php declare(strict_types=1);

namespace App\Jobs;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class FeedbackMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
    /**
     * @var $id - Message id
     */
    protected $id;

    /**
     * Create a new job instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = Feedback::find($this->id);

        if ($message) {
            Mail::send('site.emails.feedback', ['data' => $message], function ($mail) use ($message) {
                $mail->from('no-reply@skastana.kz', 'Сайт skastana.kz');
                $mail->subject('Сообщение с формы - Контакты');
                $mail->to(config('avl.feedback_mail'));
            });

            info('Сообщение - ' . $message->id . ' успешно отправлено.');
        }
    }
}
