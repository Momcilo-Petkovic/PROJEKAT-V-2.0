<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   P R O J E K A T - V - 2 . 0 
 
 


## README FROM DEVELOPER
Day 1: 
- I just created a new laravel project, and today I look forward to implementing multi auth

- I decided to use jetstream for my multi authentication system, so I installed it via composer and installed jetstream:livewire


- I got confused cause after installing jetstream, running npm run dev works different, saying "use --host to expose"
 , I think i found a solution saying I should now use npm run build instead. 

- "With Vite, running npm run dev will only build your frontend and start watching any changes to your code to rebuild automatically. To actually start your server, you need to run php artisan serve in a separate command window."
(I hope the build I ran command won't affect my progress later on) (As much as I understand I just won't have to do npm run dev 
anymore and it should work as npm run watch?? These updates make it really hard to learn since the tutorials appear to be outdated now)

- I created a new database in PHP my admin, named it events-nis-v2 and added it to the .env file

- Jetstream login system for users seems to be working fine :)

- I enabled user profile photos in config > jetstream.php > uncomment the profile photo feature
- Also Updated APP_URL in .env
- php artisan storage:link
(Profile photos now work)


- When I consider changin the dashboard I should go back and watch the video at 34:00

- I just created an Admin Controller, Model and Migration
- I copied the Schema for users table into admins table
- I copied the User model into the Admin model and changed the class name
- I created a new AdminFactory
- Inside the factory i statically defined the username and email for the Admin accound 
(I don't want to give everyone the ability to be an Admin, that wouldn't make sense)
- Did some tweaks to the DatabaseSeeder.php (\App\Models\Admin::factory()->create();)
- I modified auth.php so I can make a guard for Admin
- Modified FortifyServiceProvider in app\providers
- Created routes in web.php
- Created a loginForm function in AdminController
- Created AdminRedirectIfAuthenticated Middleware
- Multi auth successfuly implemented, there are now users and admins

- Now with all this done, I'd like to change the default laravel start page (welcome.blade.php)
- Actually, I figured out that won't be a problem, in older version of laravel I remember that was way more complicated

- I decided it's time to give functionality to the Admin dashboard


- CUSTOM ADMIN LOGOUT BUTTON FINALLY WORKING, NOW I CAN FINALLY STYLE MY ADMIN PAGE AS I WISH

- Home page made

- All the performaces are being displayed and can be sorted by type trough the nav bar

- All the places have their details view now

- Reservations for performances can be made through the place details view and are stored in the database

- Place descriptions are being displayed on place details view



