
# Guidance-Service-Management System


A Guidance Records Management System is a software application designed to facilitate the organization, storage, retrieval, and management of guidance-related records within an educational institution or counseling center. It typically includes features such as student profiles, academic and career guidance records, counseling session logs, appointment scheduling, progress tracking, and reporting capabilities. The system aims to streamline the process of tracking and managing student guidance activities, ensuring efficient delivery of counseling services and effective monitoring of student progress and development.

## Information

This app is built with built the app using laravel

### Technologies used in Backend

| Technology             |            Description             | Version |
| :--------------------- | :--------------------------------: | :-----: |
| Php                    |            PHP language            |  8.0.2  |
| Laravel                |     Laravel backend framework      |  ^8.65  |
| laravel/ui             |             UI Package             |  ^3.3   |
| realrashid/sweet-alert |        sweet-alert Package         |  ^5.0   |
| maatwebsite/excel      | Excel pacage for laravel framework |   3.1   |
| srmklive/paypal        |      paypal checkout Package       |  ~3.0   |

## Cloning and use

```bash or terminal
  # Cloning app
  git clone  https://github.com/AbderrahmaneAmerhhi/Restaurant-project-with-Laravel8

  # install composer
   composer install
   php artisan config:clear
   php artisan config:cache
  # copy .env.example => rename it to .env

  # generate App key
   php artisan key:generate

  # install node_modules
   npm install

```

## Configuration

```env
# in .env file config database

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourdatabse_name
DB_USERNAME=root
DB_PASSWORD=databasepassword

# config Mail add your mail configuration

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# add your Paypal configuration
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_API_USERNAME=YourUserName
PAYPAL_SANDBOX_API_PASSWORD=YourPassword
PAYPAL_SANDBOX_API_SECRET=YourSecret


```

## Migrate database and run app

```bash or terminal
  ########### open app in terminal or cmd or bash ... ###############
  # Migrate data base run in terminal
   php artisan migrate

  # seed database
   php artisan db:seed

  # run app
  php artisan serve
   ## in other terminal
    npm run dev

  # open app in
  http://127.0.0.1:8000

  # login to admin dashboard
   Url :http://127.0.0.1:8000/login
   Email :   admin@gmail.com
   Password : admin


```

## Features

-   Dynamic backend with laravel Backend framework
-   Responsive front-end with blade template html css bootstrap ...

#### Dashboard Features

-   Administrators can manage users/Students

-   Administrators can manage Violations


#### Student/User side

-   Students can view their penind and ongoing violations and detail on how to clear them

