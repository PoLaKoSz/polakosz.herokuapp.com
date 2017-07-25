# polakosz.000webhost.com

Ez a projekt [Angular CLI](https://github.com/angular/angular-cli) 1.0.2-es verziójával lett generálva (direkt ezzel a verzióval, és nem újabbal).

Az alábbi projektem a [személyes weblapom](https://polakosz.000webhostapp.com/) forráskódját tartalmazza.

Az [alábbi](/../../issues/3) issue-ban található meg minden olyan dolog, ami megvalósításra szorul, vagy már orvosolva lett.

## Projekt tesztelése
1. Minden szükséges modul telepítése, ami a package.json-ban megtalálható: `npm install`
2. Minden szükséges modul telepítése, ami a composer.json-ban megtalálható: `composer install`
3. `.env` fájl létrehozása az `.env.example` mintájára
4. `.env` fájl módosítása a megfelelő adatokra (pl.: valós adatbázis adatok megadása)
4. Egyedi `APP_KEY` generálása az `.env` fájlhoz: `php artisan key:generate`
## ... 000webhost.com-on
- `public` mappa átnevezése `public_html` mappává
- `.env` fájl módosítása, ha szükséges (pl.: adatbázis adatok, `APP_DEBUG=true | false`