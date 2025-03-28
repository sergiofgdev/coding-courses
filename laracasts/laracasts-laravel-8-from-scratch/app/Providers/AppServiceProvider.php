<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Nos permite de alguna forma añadir estos datos a la toybox, lo que nos permite añadir un constructor a la clase
     * MailchimpNewsletter, ya que de por sí Laravel no sabría que es lo que es el $client, por eso desde aqui lo añadimos
     * a la "toybox"
     */
    public function register(): void
    {
        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us6'
            ]);

            return new MailchimpNewsletter($client); //Aquí es la única referencia a Mailchimp que hacemos
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //Esto nos permite utilizarlo como middleware de esta forma no necesitamos crear un middleware como teníamos antes
        //que era MustBeAdministrator y controlaba si el nombre de usuario del login era el buscado
        Gate::define('admin', function (User $user) {
            return $user->username === 'Sergio';
        });

        //Este no es realmente necesario, es para crear en blade una opción personalizable, en este caso llamada @admin
        //en vez de @can
        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        });
    }
}
