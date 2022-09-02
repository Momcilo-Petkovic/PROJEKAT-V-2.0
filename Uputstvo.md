<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->





<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h3 align="center">Events Niš</h3>

  <p align="center">
    Momčilo Petković
    <br />
    Indeks: 308 
    <br />
  </p>
</div>







<!-- ABOUT THE PROJECT -->
## O Projektu

"Events Niš" je sajt na kojem se mogu naći zakazane žurke / svirke u Nišu prikazane raspoređene od najskorije do najdavnije. Korisnici koji pristupe sajtu mogu rezervisati mesto za konkretnu žurku ili svirku

Tipovi korisničkih naloga:
* Guest - Korisnik koji nije prijavljen
* User - Korisnik koji može ostavljati komentare kako bi bliže opisao mesto, i takođe može brisati svoje komentare
* Manager - Ima mogućnost brisanja komentara bilo kojih korisnika
* Admin - Ima mogućnost brisanja komentara bilo kojih korisnika, ali i dosta drugih funkcija kao što su funkcije za dodavanje i brisanje podataka, funkcija za odobravanje / odbijanje rezervacija i izvod rezervacija u PDF formatu


## Uputstvo

Prvobitno se moraju izvršiti sve migracije kako bi se stvorila baza podataka.
```sh
   php artisan migrate
```

Nakon što je baza podataka stvorena, potrebno je seedovati kako bi se izvršili svi inserti.
```sh
   php artisan db:seed --class=DatabaseSeeder
```

Seedovanjem baze, pored kreacije raznih mesta i nastupa, stvoriće se i dva naloga - Admin i Manager nalog

Ovim nalozima se može pristupiti na /admin/login

Nalog menadžera:
manager@gmail.com
password

Nalog admina:
admin@gmail.com
password

Potrebno je pokrenuti server.
```sh
   php artisan serve
```

Korisnički nalog se može stvoriti na /register, i može se ulogovati na /login



## Korišćene tehnologije

<br>

* Laravel
```sh
   composer global require "laravel/installer=~1.1"
```
* Jetstream
```sh
   composer require laravel/jetstream
```
* Tailwind CSS
```sh
   npm install -D tailwindcss postcss autoprefixer
```
* DOMPDF Wrapper for Laravel
```sh
   composer require barry/laravel-dompdf
```
