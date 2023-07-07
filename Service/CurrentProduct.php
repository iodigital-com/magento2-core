<?php

declare(strict_types=1);

namespace IODigital\Core\Service;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Registry;

class CurrentProduct
{
    protected const CURRENT_PRODUCT = 'current_product';

    public function __construct(
        protected Registry $registry
    ) {
    }

    public function getCurrentProduct(): ?ProductInterface
    {
        return $this->registry->registry(static::CURRENT_PRODUCT);
    }

    public function setCurrentProduct(?ProductInterface $product): CurrentProduct
    {
        $this->registry->register(static::CURRENT_PRODUCT, $product);

        return $this;
    }
}
