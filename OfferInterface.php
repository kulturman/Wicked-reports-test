<?php
declare(strict_types=1);

interface OfferInterface
{
    public function setReductions(array $basketItems): void;
}