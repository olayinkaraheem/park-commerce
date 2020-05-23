# park-commerce

Park-commerce is a light-weight application written to implement a flexible Coupon feature of an e-commerce solution.



<!-- **UI template:** (https://olayinkaraheem.github.io/park-commerce/) -->


## Built With

- [Laravel](https://laravel.com)
- [Vuejs](https://vuejs.org)

## Installation

1. Download and install [Node.js](https://nodejs.org/en/)

1. Clone project

```bash
    > git clone https://github.com/olayinkaraheem/park-commerce.git
```

3. Install Dependencies

```bash
    > npm install
    > composer require
```

4. Run project
```bash
    > php artisan migrate --seed
    > php artisan serve
    > npm run dev
```

5. Run tests
```bash
    > ./vendor/bin/phpunit
```

## Testing Feature

### Local dev server

- **Login** localhost:8000/login
- **Cart** localhost:8000/cart



### Live App URL

[park-commerce.herokuapp.com](http://park-commerce.herokuapp.com/)


## Sample Data

### Login

```json
email: olayinka.raheem16@gmail.com
password: password
```

### Coupons

```json
FIXED10
PERCENT10
MIXED10
REJECTED10
```


## License

&copy; Olayinka Raheem

