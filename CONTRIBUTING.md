# Steps to add a new language :

You want to add **Spanish*** language? 

- Fork the project
- Clone the project
- Copy the file translations/default.php to translations/spanish.php
- Replace the English values with Spanish values into the file translations/spanish.php
- Add language key in `$allowedLangs` array into `src/Weekend/Translate.php` file, line 24 (here `'spanish'`)
- Add language case in method `getSentence1()` into `src/Weekend/Translate.php` file, line 56
- Commit files
- Open a pull request

Thanks :)

***given as example**