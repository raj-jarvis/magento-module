<?php
namespace Streak\Treasure\Controller\Adminhtml\Treasure;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $reqdata = $this->getRequest()->getPostValue();
       
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($reqdata) {
            $model = $this->_objectManager->create('Streak\Treasure\Model\Treasure');

            $id = $this->getRequest()->getParam('trs_id');
			
            if ($id) {
                $model->load($id);
                //$model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			$data['name'] = $reqdata['name'];
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Treasure has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['trs_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Treasure.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['trs_id' => $this->getRequest()->getParam('trs_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}