### Installation

Change you app name in the .env
And add your mailtrap email credentials

```shell
$ composer update
$ php artisan migrate
$ npm install
$ npm run build
```

### Test

Make sure you have dusk properly installed

```shell
$ php artisan dusk --filter testTextBooking
```
