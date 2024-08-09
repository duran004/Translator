<?php

namespace Dcyilmaz\Translator;

use Illuminate\Support\ServiceProvider;
use Dcyilmaz\Translator\Commands\TranslateLanguage;

class TranslatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind('translator', function ($app) {
            return new Translator();
        });
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TranslateLanguage::class,
            ]);
        }
        // GOOGLE_TRANSLATE_API_KEY kontrolü
        if (empty(env('GOOGLE_TRANSLATE_API_KEY'))) {
            $this->warnEnvVariable();
        }
    }

    protected function warnEnvVariable()
    {
        $message = "\n\033[33m";
        $message .= "Please set the GOOGLE_TRANSLATE_API_KEY in your .env file.";
        $message .= "\033[0m\n";

        echo $message;
    }
}
