<?php

namespace Streak\Treasure\Block\Adminhtml\Treasure;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize treasure edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'trs_id';
        $this->_blockGroup = 'Streak_Treasure';
        $this->_controller = 'adminhtml_treasure';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Treasure'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                    ],
                ]
            ],
            -100
        );

        $this->buttonList->update('delete', 'label', __('Delete Treasure'));
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('treasure')->getId()) {
            return __("Edit Treasure '%1'", $this->escapeHtml($this->_coreRegistry->registry('treasure')->getTitle()));
        } else {
            return __('New Treasure');
        }
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('treasure/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '{{tab_id}}']);
    }

    /**
     * Prepare layout
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('page_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'content');
                }
            };
        ";
        return parent::_prepareLayout();
    }

}