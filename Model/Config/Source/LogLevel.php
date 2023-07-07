<?php

declare(strict_types=1);

namespace IODigital\Core\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Psr\Log\LogLevel as PsrLogLevel;

class LogLevel implements OptionSourceInterface
{
    /**
     * Returns array of Psr Log Levels.
     *
     * @return array<array<string, string>>
     */
    public function toOptionArray()
    {
        return [
            [
                'label' => PsrLogLevel::EMERGENCY,
                'value' => PsrLogLevel::EMERGENCY,
            ],
            [
                'label' => PsrLogLevel::ALERT,
                'value' => PsrLogLevel::ALERT,
            ],
            [
                'label' => PsrLogLevel::CRITICAL,
                'value' => PsrLogLevel::CRITICAL,
            ],
            [
                'label' => PsrLogLevel::ERROR,
                'value' => PsrLogLevel::ERROR,
            ],
            [
                'label' => PsrLogLevel::WARNING,
                'value' => PsrLogLevel::WARNING,
            ],
            [
                'label' => PsrLogLevel::NOTICE,
                'value' => PsrLogLevel::NOTICE,
            ],
            [
                'label' => PsrLogLevel::INFO,
                'value' => PsrLogLevel::INFO,
            ],
            [
                'label' => PsrLogLevel::DEBUG,
                'value' => PsrLogLevel::DEBUG,
            ],
        ];
    }
}
