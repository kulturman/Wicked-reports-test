<?php
declare(strict_types=1);

interface DeliveryChargeRuleInterface
{
    public function calculateFees(float $basketTotalCost): float;
}