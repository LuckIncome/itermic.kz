<?php

namespace App\Http\Controllers\Site\Feedback;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Jobs\FeedbackMessage;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{

    /**
     * @param FeedbackRequest $request
     * @return array
     */
    public function storeFeedback(FeedbackRequest $request): array
    {
        try {
            $feedback = new Feedback();
            $feedback->lang = app()->getLocale();
            $feedback->name = $request->input('name');
            $feedback->phone = $request->input('phone');
            $feedback->ip = $request->ip();

            if ($feedback->save()) {

//                FeedbackMessage::dispatch($feedback->id);

                return ['success' => 'Успешно отправлено'];
            }
        } catch (\Exception $exception) {
            Log::error('Ошибка при отправки сообщения.');
        }

    }
}
