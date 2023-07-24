<?php

declare(strict_types=1);

namespace IODigital\Core\Model\ResourceModel;

use Exception;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * This class can be used for entities which have a store view link
 */
abstract class AbstractStoreLinkedResource extends AbstractDb
{
    public function __construct(
        Context $context,
        protected EntityManager $entityManager,
        protected MetadataPool $metadataPool,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init($this->getStoreLinkMainTable(), $this->_idFieldName);
    }

    /**
     * Get store ids to which specified item is assigned
     *
     * @return array
     * @throws LocalizedException
     */
    public function lookupStoreIds(int $id)
    {
        $idFieldName = $this->getIdFieldName();
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from(
                ['store_link' => $this->getTable($this->getStoreLinkLinkTable())],
                $this->getStoreLinkLinkTableStoreIdField()
            )
            ->join(
                ['main_table' => $this->getMainTable()],
                'store_link.' . $this->getStoreLinkLinkTableEntityIdField() . ' = main_table.' . $idFieldName,
                []
            )
            ->where('main_table.' . $idFieldName . ' = :entity_id');

        return $connection->fetchCol($select, ['entity_id' => (int) $id]);
    }

    /**
     * Saving through entityManager to trigger saveHandlers
     *
     * @param AbstractModel $object
     * @return $this|AbstractStoreLinkedResource
     * @throws Exception
     */
    public function save(AbstractModel $object): self
    {
        $this->entityManager->save($object);

        return $this;
    }

    /**
     * Loading with entityManager to trigger readHandlers
     *
     * @param AbstractModel $object
     * @param mixed $value
     * @param string|null $field
     * @return AbstractStoreLinkedResource
     * @throws LocalizedException
     */
    public function load(AbstractModel $object, $value, $field = null): self
    {
        if ($field !== null && $field !== $this->getIdFieldName()) {
            parent::load($object, $value, $field);
            $value = $object->getId() ?? $value;
        }

        $object = $this->entityManager->load($object, $value);

        return $this;
    }

    /**
     * The name of the main table for the entity which is connected to stores
     */
    abstract public function getStoreLinkMainTable(): string;

    /**
     * The name of the table used to link the entity and stores together
     */
    abstract public function getStoreLinkLinkTable(): string;

    /**
     * The name of the field, in the store link table, referencing the main table id
     */
    abstract public function getStoreLinkLinkTableEntityIdField(): string;

    /**
     * The name of the field, in the store link table, referencing the store
     */
    public function getStoreLinkLinkTableStoreIdField(): string
    {
        return 'store_id';
    }
}
