<?php

declare(strict_types=1);

class Basket
{
    /** @var array <Product> $products */
    private array $products;

    /** @var array <DeliveryChargeRuleInterface> $deliveryChargeRules */
    private array $deliveryChargeRules;

    /** @var array <OfferInterface> $offers */
    private array $offers;

    /** @var array $basketItems */
    private array $basketItems = [];

    /**
     * @param array <Product> $products
     * @param array <DeliveryChargeRuleInterface> $deliveryChargeRules
     * @param array <OfferInterface> $offers
     */
    public function __construct(
        array $products,
        array $deliveryChargeRules,
        array $offers
    )
    {
        $this->products = $products;
        $this->deliveryChargeRules = $deliveryChargeRules;
        $this->offers = $offers;
    }

    /**
     * @throws Exception
     */
    public function add(string $code): void {

        $productAsArray = array_filter($this->products, fn(Product $product) => $product->getCode() === $code);

        if(empty($productAsArray)) {
            throw new Exception(sprintf('Product with code %s doesn\'t exist', $code));
        }

        if(key_exists($code, $this->basketItems)) {
            /** @var BasketItem $basketItem */
            $basketItem = $this->basketItems[$code];
            $basketItem->add();
        } else {
            $this->basketItems[$code] = new BasketItem(current($productAsArray), 1);
        }

    }

    public function total(): float {
        $totalWithoutFees = 0;
        $deliveryFees = PHP_FLOAT_MAX;

        foreach ($this->offers as $offer) {
            $offer->setReductions($this->basketItems);
        }

        foreach ($this->basketItems as $basketItem) {
            $totalWithoutFees += $basketItem->getTotalCost();
        }

        foreach ($this->deliveryChargeRules as $deliveryChargeRule) {
            //If there are multpiles deliverycharge rules we take the cheapest
            
            $newDeliveryFees = $deliveryChargeRule->calculateFees($totalWithoutFees);

            if ($newDeliveryFees < $deliveryFees) {
                $deliveryFees = $newDeliveryFees;
            }
        }

        return $totalWithoutFees + $deliveryFees;
    }

}