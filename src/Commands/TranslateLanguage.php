<?php

namespace Dcyilmaz\Translator\Commands;

use Illuminate\Console\Command;
use Dcyilmaz\Translator\Helpers\TranslateHelper;

class TranslateLanguage extends Command
{
    protected $signature = 'translate:language {source} {target} {file}';

    protected $description = 'Translate language files from source language to target language using Google Translate';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $source = $this->argument('source');
            $target = $this->argument('target');
            $file = $this->argument('file');

            $sourcePath = resource_path("lang/{$source}/{$file}.php");
            $targetPath = resource_path("lang/{$target}/{$file}.php");

            if (!file_exists($sourcePath)) {
                $this->error("Source language file not found: {$sourcePath}");
                return;
            }

            //create target language directory if not exists
            if (!is_dir(resource_path("lang/{$target}"))) {
                mkdir(resource_path("lang/{$target}"));
            }

            $translations = include($sourcePath);
            $translatedTexts = [];

            if (file_exists($targetPath)) {
                $translatedTexts = include($targetPath);
            }

            foreach ($translations as $key => $text) {
                if (!array_key_exists($key, $translatedTexts)) {
                    $translatedTexts[$key] = TranslateHelper::translate($text, $target);
                    $this->info("Translated: {$text} => {$translatedTexts[$key]}");
                }
            }

            $translatedContent = "<?php\n\nreturn " . var_export($translatedTexts, true) . ";\n";
            file_put_contents($targetPath, $translatedContent);

            $this->info("Language file translated successfully: {$targetPath}");
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
