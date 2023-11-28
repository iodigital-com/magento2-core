<?php

declare(strict_types=1);

namespace IODigital\Core\Service;

use Magento\Framework\Module\Manager;

class Edition
{
    protected const COMMERCE_MODULE = 'Magento_Enterprise';

    public function __construct(
        protected Manager $moduleManager
    ) {
    }

    public function isEnterprise(): bool
    {
        return $this->moduleManager->isEnabled(static::COMMERCE_MODULE);
    }
}
