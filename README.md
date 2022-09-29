## Setup

- Make sure you have compose installed
- From root of the repo, run:
```
composer install
```
## Usage

- From root of the repo, run:
```
php -S localhost:8000 -t public
```

- Go to localhost:8000 in a browser or send a get request to localhost:8000 from Postman

## Notes and thoughts

- I've added configs for default base currency and API keys in the env file, and kept my code flexible enough for a currency type to be passed in, due to lack of experience with Lumen, I couldn't find a way within the framework to define optional parameter in the route definition to behave the way I want it to, with my time, I'm sure I can either find a way within the framework, or a way to extend it, so the optional parameter can be passed it. Alternatively I could have coded the logic to accept URL parameter as well.
- I've only done a basic automated test to check the request returns a 200 status, it seems Lumen's test library has less functionality compared to Laravel, with more time I would have created better tests
- A new API service could be changed by creating a new class that implements the CurrencyExchangeableInterface interface and be swapped in at the controller constructor level
