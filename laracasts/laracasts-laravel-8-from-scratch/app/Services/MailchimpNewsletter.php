<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

/*
 * Esta clase tendrá el código relacionado con la API mailchimp, se conectará con la API, etc.
 */

class MailchimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {
        //
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client()->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }


    /*
     * Esto va a pasar a estar comentado porque vamos a moverlo a AppServiceProvider.php, el motivo es que puede estar
     * aqui si se trata de una clase sencilla sin constructor, pero si le añadimos un constructor vamos a tener que
     * añadir a la "toybox" la información que pueda necesitar.
     */
//    protected function client()
//    {
//        return (new ApiClient())->setConfig([
//            'apiKey' => config('services.mailchimp.key'),
//            'server' => 'us6'
//        ]);
//    }
}
