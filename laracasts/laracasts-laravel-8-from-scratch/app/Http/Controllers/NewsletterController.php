<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use Exception;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    //En este controlador estamos utilizando __invoke porque solo va a tener esta funcion, va a ser un controlador
    //sencillo, por eso en web.php cuando lo utilizamos solo le pasamos la clase NewsletterController::class y no
    //pasamos un array como en el resto como por ejemplo [NewsletterController:class, 'create']

    public function __invoke(MailchimpNewsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

//        try {
            $newsletter->subscribe(request('email'));
//        } catch (Exception $e) {
//            throw ValidationException::withMessages([
//                'email' => 'This email could not be added to our newsletter list.'
//            ]);
//        }

        return redirect('/')
            ->with('success', 'You are now signed up for our newsletter!');
    }
}
