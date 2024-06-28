<?php

declare(strict_types=1);

namespace IODigital\Core\Model\ResourceModel;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * This class can be used for readHandlers for entities which have a store view link
 * Do keep in mind that the right resourceModel should be passed as argument.
 *
 * Note: This class is actually not abstract to make it possible create a virtual type of this class.
 */
class AbstractStoreLinkedReadHandler implements ExtensionInterface
{
    public function __construct(
        protected AbstractStoreLinkedResource $resourceModel
    ) {
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws LocalizedException
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $stores = $this->resourceModel->lookupStoreIds((int) $entity->getId());
            $entity->setData('store_id', $stores);
        }

        return $entity;
    }
}
