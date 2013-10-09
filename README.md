judy
==========

Requirements
--------------

PHP 5.5.3
Apache v2.4.6
Zend Engine 2.5.0

Authors
--------------

Kemal Erdem
Mateusz Białczak
Michał Antoszczuk

Opis instalacji systemu
--------------
Aby uruchomić aplikację zend framework 2 należy włączyć konsolę która posiada obsługę skryptów php.
Po przejściu do folderu z aplikacja Zend Framework 2 (Judy) należy wydać polecenie:
php composer.phar install
aplikacja zostanie automatycznie zainstalowana (wszelkie błędy zostaną wyświetlone w oknie konsoli)
istnieje duże prawdopodobieństwo iż konieczne będzie ustawienie niektórych uprawnień dostępu np dla plików 
cache. Pliki cache znajdują się w katalogu data. Opisy ewentualnych błędów są bardzo czytelne i należy postępować
zgodnie ze wskazówkami.

Aby aplikacja działała poprawnie należy wydać jeszcze polecenia:
php composer.phar self-update 
php composer.phar update

W przypadku wystąpienia błędów composer poinformuje co robić dalej.

Następnie wypada uzupełnić config doctrine. Znajduje się on w pliku /config/autoload/doctrine.global.php

Aby aplikacja działała poprawnie należy zmienić folder domyślny z ~/ na ~/public/ w ustawieniach serwera

Po instalacji aplikacji należy przejść do instalacji pośrednich funkcji.

System korzyta z takich projektów jak Bootstrap oraz Less, aby ułatwić pisanie styli i rozmieszczanie elementów na stronie.
Aby zainstalować bootstrapa należy sklonować sobie ich gita https://github.com/twbs/bootstrap
Po zrobieniu klona będziemy w stanie samodzielnie "kompilować" pliki bootstrapa takie jak *.js, *.css
Aby to wykonać potrzebujemy oprogramowania o nazwie grunt
(użytkownicy linuxa mogą zainstalować je poprzez npm install -g grunt-cli)
po instalacji grunta należy przejść do folderu /bootstrap (nie umieszczać go przypadkiem w folderze 
głównym aplikacji najlepiej w osobnym folderze na to przeznaczonym) i wykonać polecenie npm install
które przegląda sobie plik package.json (konfiga tutaj dodać jak coś). Po całej tej instalacji możemy wykonać
grunt dist
polecenie to wygeneruje nam odpowiednie pliku w folderze /bootstrap/dist/ które należy linkami symbolicznymi
powiązać z odpowiadającymi im plikami w folderze public aplikacji powiązanie powinno wyglądać mniej więcej tak:
ln -sfn bootstrap/dist/css/* judy/public/css/
(należy wiązać pliki (stąd ta gwiazdka) nie foldery ponieważ nie chcemy sobie dodawać nowych plików do naszego
katalogu. Aby wszystko było dobrze należy również stworzyć dowiązanie symboliczne do katalogu /bootstrap/less.
Aby tego dokonać wydajemy polecenie:
ln -sfn bootstrap/less/* judy/vendor/less/
Podlinkuje to wszystkie pliki do naszego katalogu aplikacji zalecam sprawdzenie czy pliku już tam nie istnieją
w takim przypadku linkujemy możemy linkować w drugą stronę
ln -sfn judy/vendor/less/* bootstrap/less/
rm bootstrap/less/styles.less
ostatnie polecenie miało na celu nie dodawanie naszego głównego pliku styli do bootstrapowych lessów

Istalacja LESS
LESS jest to bardzo fajna rzecz która tworzy style (najprościej mówiąc) aby ją zainstalować wymagany jest node.js
w wersji bodajże 0.8.* (ja używam 0.10.20) po zainstalowaniu node.js wydajemy polecenie
npm install -g less
tak tutaj również korzystamy z naszego npm
Aby wygenerować plik ze stylami wydajemy polecenie:
lessc judy/vendor/less/styles.less judy/public/css/style.css

To było by chyba na tyle. Wszelkie pytania proszę dopisywać do pliku questions.txt
