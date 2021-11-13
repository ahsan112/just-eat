### overview 

This is a clone of the just eat checkout flow
built using custom implementaion of MVC architecture and query builder in php 

ability to add items to cart with optional extras 
can switch between collection and delivery with the total price
changing occordingly 
checkout with braintree payment

### Usage

Using docker to get started

``` bash
docker-compose up --build 
```

install packages with composer 
``` bash
docker-compose run --rm composer install
```


add braintree merchantId_sandbox, publicKey_sandbox and privateKey_sandbox to the env file 

note: that it will run without providing these you just wont be able to place the order 

should be running on localhost:8000


------------

