judy
==========
(opis)

Wersja
--------------
0.0.1

Wymagania
--------------

- PHP 5.5.3
- Apache v2.4.6
- Zend Engine 2.5.0
- klient GitHub

Autorzy
--------------

- Kemal Erdem
- Mateusz Białczak
- Michał Antoszczuk


Opis instalacji systemu
--------------

### Linux ###

Aby uruchomić aplikację Zend Framework 2, należy włączyć konsolę, która posiada obsługę skryptów php.
Po przejściu do folderu z aplikacją Zend Framework 2 (Judy) należy wydać polecenie:

```
php composer.phar install
```

Aplikacja zostanie automatycznie zainstalowana (wszelkie błędy zostaną wyświetlone w oknie konsoli). Istnieje duże prawdopodobieństwo, że konieczne będzie ustawienie niektórych uprawnień dostępu, np. dla plików cache. Pliki cache znajdują się w katalogu data. Opisy ewentualnych błędów są bardzo czytelne i należy postępować
zgodnie ze wskazówkami.

Aby aplikacja działała poprawnie należy wydać jeszcze polecenia:
```
php composer.phar self-update 
php composer.phar update
```

W przypadku wystąpienia błędów, composer poinformuje, co robić dalej.

Następnie wypada uzupełnić config doctrine. Znajduje się on w pliku

```
/config/autoload/doctrine.global.php
```


Aby aplikacja działała poprawnie, należy zmienić folder domyślny z ```~/``` na ```~/public/``` w ustawieniach serwera.

Po instalacji aplikacji należy przejść do instalacji pośrednich funkcji.

System korzyta z takich projektów jak Bootstrap oraz Less, aby ułatwić pisanie styli i rozmieszczanie elementów na stronie.
Aby zainstalować bootstrapa, należy sklonować sobie ich repozytorium poleceniem:
```
git clone https://github.com/twbs/bootstrap
```
Po sklonowaniu repozytorium bdziemy w stanie samodzielnie "kompilować" pliki bootstrapa takie jak *.js, *.css.
Aby to wykonać, potrzebujemy oprogramowania o nazwie grunt. Instalacja:
```
npm install -g grunt-cli
```
Po instalacji grunta należy przejść do folderu ./bootstrap (nie należy umieszczać go przypadkiem w folderze głównym aplikacji! Najlepiej w osobnym folderze na to przeznaczonym) i wykonać polecenie:
```
npm install
```
Przegląda ono plik package.json **(konfiga tutaj dodać jak coś)**. Po całej tej instalacji możemy wykonać polecenie:
```
grunt dist
```
Polecenie to wygeneruje nam odpowiednie pliki w folderze ```./bootstrap/dist/```, które należy linkami symbolicznymi powiązać z odpowiadającymi im plikami w folderze ```public``` aplikacji.
Powiązanie powinno wyglądać mniej więcej tak:

```ln -sfn bootstrap/dist/css/* judy/public/css/```

Należy wiązać pliki (stąd ta gwiazdka), a nie foldery, ponieważ nie chcemy sobie dodawać nowych plików do naszego katalogu. Aby wszystko było dobrze, należy również stworzyć dowiązanie symboliczne do katalogu ```/bootstrap/less```.
Aby tego dokonać wydajemy polecenie:
```
ln -sfn bootstrap/less/* judy/vendor/less/
```
Podlinkuje to wszystkie pliki do naszego katalogu aplikacji. Zalecamy sprawdzenie, czy pliki już tam nie istnieją.

W takim przypadku możemy zlinkować w drugą stronę
```
ln -sfn judy/vendor/less/* bootstrap/less/
rm bootstrap/less/styles.less
```
Ostatnie polecenie miało na celu nie dodawanie naszego głównego pliku styli do bootstrapowych lessów.

#### Instalacja LESS ####
LESS jest to bardzo fajna rzecz, która - najprościej mówiąc - tworzy style. Aby ją zainstalować, wymagany jest node.js w wersji 0.8.* (w naszym przypadku jest to 0.10.20). Po zainstalowaniu node.js wydajemy polecenie:
```
npm install -g less
```

Aby wygenerować plik ze stylami, wydajemy polecenie:
```
lessc judy/vendor/less/styles.less judy/public/css/style.css
```

Wszelkie pytania proszę dopisywać do pliku questions.txt

### Windows (XAMPP) ###
Instalacja judy pod systemem Windows jest nieco bardziej skomplikowana. Dla uproszczenia zakładamy, ze całość będzie postawiona pod pakietem XAMPP.
Pakiet ten ściągnąć można pod adresem: 

http://www.apachefriends.org/en/xampp-windows.html

Po zainstalowaniu XAMPPa. Potrzebny będzie także klient GitHub, do ściągnięcia na stronie 

http://windows.github.com/

Następnie możemy zająć się instalacją naszej aplikacji.
Ściągnięte repozytorium proponujemy wrzucić do tymczasowego katalogu ```c:\judy\```.
Całą zawartość katalogu ic-website-judy należy skopiować do ```c:\xampp\htdocs\judy\```.
Aby zainstalować aplikację, należy wykonać komendę ```php composer.phar install``` za pomocą php umieszczonego w folderze XAMPPa.
W linii komend wpisujemy:
```
cd c:\xampp\htdocs\judy\
c:\xampp\php\php.exe composer.phar install
```

Jeśli instalator nie wykaże błędów, możemy przejść do kolejnego kroku.

Aby strona wyświetlała się poprawnie, należy zmienić ustawienia VirtualHost w serwerze Apache. Możemy to zrobić poprzez edycję pliku
```
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

dopisując na jego końcu:
```
NameVirtualHost *
  <VirtualHost *>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
  </VirtualHost>
  <VirtualHost *>
    DocumentRoot "C:/xampp/htdocs/judy/public"
    ServerName judy.local
  <Directory "C:/xampp/htdocs/judy/public">
    Order allow,deny
    Allow from all
  </Directory>
</VirtualHost>
```

Następnie musimy dodać na końcu pliku ```C:\Windows\System32\Drivers\etc\hosts```
linię ```127.0.0.1 judy.local```

Dzięki temu nasza strona będzie dostępna pod adresem http://judy.local

Teraz wystarczy zrestartować serwer Apache i udać się pod adres http://judy.local - panel powinien wyświetlić się poprawnie.

(ciąg dalszy nastąpi)

Plik konfiguracyjny bazy danych znajduje się pod adresem:
```C:\xampp\htdocs\judy\config\autoload\doctrine.global.php```

Tworzenie bazy danych:
```
cd C:\xampp\htdocs\judy\vendor\doctrine\doctrine-module\bin\
c:\xampp\php\php.exe doctrine-module.php orm:schema-tool:create
```
