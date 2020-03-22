# makeadmin
Simple command for creating admin user Laravel App.

## Installation
Install through composer.
```bash
composer require valluminarias/makeadmin
```

## Creating the Admin User
If installed, `make:admin` artisan command will available.
```bash
php artisan make:admin
```

### The `make:command`
There are optional command parameters.

`--name`: Represent the name of the user.

`--email`: Represent the email of the user.

`--username|-u`: Represent the username of the user.

`--password|-p`: Password of the user.

### Example

```
php artisan make:admin --username my_user --password myVeryDifficultPassword
```

``If no arguments provided, it will prompt for user input.``