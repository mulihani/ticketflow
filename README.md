

<p align="center"><a href="https://mulihani.com/home/en" target="_blank"><img src="https://ticketflow.mulihani.com/github/images/banner.png" alt="Ticket Flow Logo"></a></p>

## Technical support management system.

___

## About Ticket Flow

**Ticket Flow** is a technical support management system that facilitates the process of providing internal technical support to agencies, organizations, and companies. The system operates via three control panels for administrators, staff, and employees. Each control panel has characteristics and functions according to the user type.

**Ticket Flow** built using [Laravel](https://laravel.com/) framework and [Filament](https://filamentphp.com/).

___

## Features

* Authentication & User Manager.
* Three levels of users, each level has its own control panel.
    * **Administrator:** Controls the entire system.
    * **Staff:** Controls the tickets assigned to him. 
    * **User:** Requests technical support services.
* Flexible control of all parts of the system through a powerful dashboard.
* Ability to allow the system to operate only according to specific hours (e.g., from 08:00 to 17:00).
* Ability to specify **days** to shut down the system automatically (such as weekends).
* Export reports in PDF format.

___

## Requirement

* [# PHP: ^8.1](https://php.net) 
  **Ticket Flow** requires a minimum PHP version of 8.1.

___

## Installation

### 1. Clone the repository locally:

Clone the repository with `git clone`

```bash
git clone https://github.com/mulihani/ticketflow.git ticketflow && cd ticketflow
```
   
### 2. Edit database information in .env file with your data:

This step is **very important**. 
- First you must create a database. 
- Second you must copy file `.env.example` file to `.env` and edit database credentials:

>
> You can copy .env.example file manually or by using the command:
>```sh
>copy .env.example .env
>```
>

After copying the file, edit database credentials

```php
    DB_CONNECTION=mysql // Replace it with your database connection
    DB_DATABASE=your_database // Replace it with your database name
    DB_USERNAME=root // Replace it with your database username
    DB_PASSWORD= // Replace it with your database password
```

### 3. Install PHP dependencies:

```sh
composer install
```

### 4. Generate a unique application key:

```php
php artisan key:generate
```

### 5. Running Migrations:

Execute the migrate artisan command:

```sh
php artisan migrate
```

### 6. Seed essential data:

Execute the `db:seed` artisan command to seed essential data

```
php artisan db:seed
```
After executing the above command, you can login to **control panel** by going go **`/cpanel`** URL and login with credentials admin@admin.com - password
___

## Screenshots

### Ticket Flow Index Page
![Screenshot ticket flow index page](https://ticketflow.mulihani.com/github/images/Screenshots-index.png)
___

### Technical Support Request Form
![Screenshot support request form](https://ticketflow.mulihani.com/github/images/Screenshots-support-request-form.png)
___

### Ticket page
![Screenshot ticket show](https://ticketflow.mulihani.com/github/images/Screenshots-ticket-show.png)
___

### User Dashboard
![Screenshot user dashboard](https://ticketflow.mulihani.com/github/images/Screenshots-user-dashboard.png)
___

### User Tickets
![Screenshot user tickets](https://ticketflow.mulihani.com/github/images/Screenshots-user-tickets.png)
___

###  Admin Dashboard
![Screenshot admin dashboard](https://ticketflow.mulihani.com/github/images/Screenshots-admin-dashboard.png)
___

### Add New User
![Screenshot add user](https://ticketflow.mulihani.com/github/images/Screenshots-add-user.png)
___

### System Setting
![Screenshot system setting](https://ticketflow.mulihani.com/github/images/Screenshots-system-settings.png)
___

### Ticket Monitoring Screen
![Screenshot system setting](https://ticketflow.mulihani.com/github/images/Screenshots-ticket-monitoring-screen.png)
___

### Tickets Summary Report
![Screenshot pdf report](https://ticketflow.mulihani.com/github/images/Screenshots-pdf.png)
___

### Ticket Report
![Screenshot ticket pdf](https://ticketflow.mulihani.com/github/images/Screenshots-ticket-pdf.png)

___

## Ticket Flow Sponsors

We would like to extend our thanks to the following sponsors for funding Ticket Flow development. If you are interested in becoming a sponsor, please send an e-mail to Majed Mulihani via [majed@mulihani.com](mailto:majed@mulihani.com).

### Premium Partners

- **[VIELW](https://vielw.com/)**
- **[Mulihani](https://mulihani.com)**
- **[majed.blog](https://majed.blog/)**


## Security Vulnerabilities

If you discover a security vulnerability within Ticket Flow, please send an e-mail to Majed Mulihani via [majed@mulihani.com](mailto:majed@mulihani.com). All security vulnerabilities will be promptly addressed.

## License

The Ticket Flow is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
