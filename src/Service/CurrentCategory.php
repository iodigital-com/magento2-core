<?php

declare(strict_types=1);

namespace IODigital\Core\Service;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\Registry;

class CurrentCategory
{
    protected const CURRENT_CATEGORY = 'current_category';

    public function __construct(
        protected Registry $registry
    ) {
    }

    public function getCurrentCategory(): ?CategoryInterface
    {
        return $this->registry->registry(static::CURRENT_CATEGORY);
    }

    public function setCurrentCategory(?CategoryInterface $category): CurrentCategory
    {
        $this->registry->register(static::CURRENT_CATEGORY, $category);

        return $this;
    }
}
