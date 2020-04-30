
# Poppest - The Most Popular Repositories in GitHub

- **Develepoled by:** [Julio L. Muller](https://juliolmuller.github.io/)
- **Released on:** Jun 16, 2019
- **Updated on:** Apr 30, 2020
- **Latest version:** 1.2.1
- **License:** MIT

## Overview

This is an application developed as a challenge, proposed by the company [Ateliware](https://ateliware.com.br/). The application consumes GitHub API, searching for the 30 most popular repositories for 5 programing languages. The application stores this data in its own database and may display details of each repository.

[Take a look at the app in production!](https://poppest.herokuapp.com/)

![Poppest snapshot](./app-overview.jpg)

## How to Set Up the Enviroment

Poppest is a web application developed with PHP Laravel and MySQL. So, to get it up and running in your local enviroment, you are going to meet a few requirements.

### Software Required

Make sure you have the following applications installed and have their enviroment variables properly configured:

- [PHP 7.2+](https://php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [MySQL](https://www.mysql.com/)

### Dependencies Installation

After downloading or cloning this repository, run the following command lines inside your project directory:

```bash
composer install
```

### Database Connection Setup

To allow Laravel to access setup database schema and connect to it, do through the following steps:

1. Rename the file `.env.example`, in project root, to `.env`;
2. In this file, change all the values attributed to those variables prefixed with `DB_*` according to your local database configuration;
3. Inside your database server, create a database, with the same name of the variable `DB_DATABASE` you just set;
4. Run laravel migration to create the required tables and to seed them with the initial configuration:

```bash
php artisan migrate --seed
```

The parameter `--seed` already insert the 5 chosen languages (PHP, Java, JavaScript, Python & C#) into table `languages` and pulls fresh data for `repositories` from the GitHub API for each one of those languages.

### Run the Server

For Laravel projects, you can use the web server of your choice, like Apache, you just need to point the application root as being the `/public/` folder. However, you can run the embeded Laravel's server instead, by running the following command line, in the project root:

```bash
php artisan serve
```

## Automated Tests

As part of the challenge, the project should contain scripts for testing (included in `/tests` folder). To run it, execute the following command line:

```bash
"./vendor/bin/phpunit"
```

The tests execute 40 assertions related to HTTP requests (routes), database content and data consistency.

NOTE: *these tests are only for the server-side app, written in PHP. Front-end testing, which would include the React aaplication, was not done.*

## Technologies

Here are the main technologies used to build this project:

### Back-End

- Programing Language: [PHP 7](https://php.net/)
- Server-Side Framework: [Laravel 5.8](https://laravel.com/)
- HTTP Client: [Ixudra PHP cURL](https://github.com/ixudra/curl)
- External API: [GitHub Search API](https://developer.github.com/v3/search/)
- Relational Database: [Oracle MySQL](https://www.mysql.com/)

### Front-End

- JavaScript Libraries/Frameworks: [React 16](https://reactjs.org) & [jQuery 3](https://jquery.com/)
- Styles: [Bootstrap 4](https://getbootstrap.com/)
- HTTP Client: [Axios](https://github.com/axios/axios)
- Front-End Header Template: [brojask's](https://bootsnipp.com/brojask)

### Deploy

- Cloud Platform: [Heroku](https://www.heroku.com/)

### Dev Tools

- Server Development Package: [XAMPP for Windows](https://www.apachefriends.org/pt_br/index.html)
- Text Editor: [Visual Studio Code](https://code.visualstudio.com/)
- Console Emulator: [Cmder](https://cmder.net/)
- PHP Package Manager: [Composer](https://getcomposer.org/)
- JS Package Manager: [Node.js](https://nodejs.org/en/)
- API Development Enviroment: [Postman](https://www.getpostman.com/)
- PHP Testing: [PHPUnit](https://phpunit.de/)
- Versioning Tool: [Git](https://git-scm.com/)
- Remote Repository: [GitHub](https://github.com/)
