<?php
declare(strict_types=1);

class ChristmasOfferRedWidget implements OfferInterface
{
    private const RED_WIDGET_ID = 'R01';

    public function setReductions(array $basketItems): void
    {
        if(isset($basketItems[self::RED_WIDGET_ID])) {
            /** @var BasketItem $redWidgetBasketItem */
            $redWidgetBasketItem = $basketItems[self::RED_WIDGET_ID];

            if ($redWidgetBasketItem->getQuantity() > 1) {
                //We remove half of the price
                $redWidgetBasketItem->doReduction($redWidgetBasketItem->getProduct()->getPrice() / 2);
            }
        }
    }
}