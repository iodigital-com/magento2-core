<?php

declare(strict_types=1);

namespace IODigital\Core\Service;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    public const XML_PATH_DEV_LOG_LEVEL = 'dev/log/level';

    public function __construct(
        protected ScopeConfigInterface $scopeConfig
    ) {
    }

    public function getLogLevel(): string
    {
        return (string) $this->scopeConfig->getValue(static::XML_PATH_DEV_LOG_LEVEL);
    }
}
