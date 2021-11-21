<?php namespace App\Http\Controllers\Avl\Settings;

use App\Http\Controllers\Avl\AvlController;
use App\Models\{Feedback};


class FeedbackController extends AvlController
{

    public function index()
    {

        $feedbacks = Feedback::orderBy('created_at', 'desc')->get();

        return view('avl.settings.feedback.index', [
            'feedbacks' => $feedbacks
        ]);
    }

}
