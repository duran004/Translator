<?php

namespace Dcyilmaz\Translator\Helpers;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslateHelper
{
    public static function translate($text, $targetLanguage = 'tr')
    {
        $translate = new TranslateClient([
            'key' => env('GOOGLE_TRANSLATE_API_KEY'),
        ]);

        $result = $translate->translate($text, [
            'target' => $targetLanguage,
        ]);

        return $result['text'];
    }
}
