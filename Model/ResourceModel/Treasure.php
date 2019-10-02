<?php
namespace Streak\Treasure\Model\ResourceModel;

class Treasure extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('treasuredata', 'trs_id');
    }
}
?>