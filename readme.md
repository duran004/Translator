# Translator
I made this package because editing language files one by one seemed ridiculous to me. All you have to do is install it and fill the GOOGLE_TRANSLATE_API_KEY variable with the api key you got from google clouds in the env file.

# Install
```
composer require dcyilmaz/translator
```
# Google Cloud Translate API
https://console.cloud.google.com/apis/api/translate.googleapis.com/credentials 

# Usage
* First, add your GOOGLE_TRANSLATE_API_KEY API key to your env file.
* You should have a language file under your resources/lang/defaultlang(en-tr-..etc) folder. For example resources/lang/en/test.php
* Run command
```
php artisan translate:language en tr test
```
This command takes the language  test.php under resources/lang/en and translates everything written in it into Turkish.