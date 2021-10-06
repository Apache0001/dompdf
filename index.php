<?php

require __DIR__."/vendor/autoload.php";

use Source\Models\Order;

$order = new Order();

$order = $order->find()->limit(1200)->fetch(true);

