# ShopCheckout
## Zadanie rekrutacyjne Smartbees
---------------------------------------------------------------
* Baza danych do wgrania znajduje się w pliku "shopcashout.sql"
* Pliki Jquery w folderze "jsfiles"
* Pliki PHP w folderze "phpfiles"
* Pliki graficzne w folderze "pngfiles"
* Plik zawierający style w folderze "styles"
---------------------------------------------------------------
Plików nie należy przemieszczać pomiędzy folderami aby uniknąć konieczności zmiany odwołań.

Bazę danych wykonano w phpMyAdmin, serwer uruchomiony w środowisku XAMPP.

Dane służące do połączenia z bazą danych:
```php 
($host = 'localhost', $user = 'root', $password = '' , $name = 'shopcashout');
```
W razie potrzeby zmienić nazwę hosta(Plik connection.php).

Stronę uruchamiano poprzez wpisanie localhost w wyszukiwarce. (Adres 127.0.0.1 nie działał ze względu na problemy z captchą)

Dodatkowo napotkałem problemy z Captchą V3, które występowały przez dwa dni. Klucz nie był przekazywany dalej ajaxem, przez problemy z wsparciem lokalnego działania. 
Postanowiłem użyć Captchy V2, która dużo lepiej radzi sobie na serwerze postawionym lokalnie.

------ 
Aby uruchomić aplikację wykorzystałem oprogramowanie XAMPP. 
Pliki pobrane z repozytorium przenoszę do domyślnego folderu w którym można uruchomić aplikację (W programie XAMPP folder htdocs)
Po uruchomieniu modułów Apache oraz MySQL w wyszukiwarce przechodzę do localhost/phpmyadmin, gdzie wgrywam dołączoną w repozytorium bazę danych(shopcashout.sql).
Po upewnieniu się poprawności załadowania bazy danych, w wyszukiwarce wpisuję localhost. 


