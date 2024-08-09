# Translator
I made this package because editing language files one by one seemed ridiculous to me. All you have to do is install it and fill the GOOGLE_TRANSLATE_API_KEY variable with the api key you got from google clouds in the env file.

# Usage
```
php artisan translate:language en tr test
```
This command takes the language  test.php under resources/lang/en and translates everything written in it into Turkish.