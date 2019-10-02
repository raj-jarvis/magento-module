<?php
namespace Streak\Treasure\Model;

class Treasure extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Streak\Treasure\Model\ResourceModel\Treasure');
    }
}
?>