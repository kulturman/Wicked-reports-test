<?php
declare(strict_types=1);

class ChrismasDeliveryReduction implements DeliveryChargeRuleInterface
{
    public function calculateFees(float $basketTotalCost): float
    {
        if ($basketTotalCost < 50) {
            return 4.95;
        }
        if ($basketTotalCost < 90) {
            return 2.95;
        }
        return 0;
    }
}