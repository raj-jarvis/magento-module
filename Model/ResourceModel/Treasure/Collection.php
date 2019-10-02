<?php

namespace Streak\Treasure\Model\ResourceModel\Treasure;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Streak\Treasure\Model\Treasure', 'Streak\Treasure\Model\ResourceModel\Treasure');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>