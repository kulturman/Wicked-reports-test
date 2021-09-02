<?php
spl_autoload_register(function ($class) {
    include __DIR__.'/'.$class . '.php';
});

$basket = new Basket(
    [
        new Product(32.95, 'Red Widget', 'R01'),
        new Product(24.95, 'Green Widget', 'G01'),
        new Product(7.95, 'Blue Widget', 'B01')
    ],
    [ new ChrismasDeliveryReduction() ], [ new ChristmasOfferRedWidget() ]
);

$basket->add('B01');
$basket->add('B01');
$basket->add('R01');
$basket->add('R01');
$basket->add('R01');
var_dump($basket->total());