<?php
namespace Streak\Treasure\Block\Adminhtml\Treasure\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('treasure_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Treasure Information'));
    }
}