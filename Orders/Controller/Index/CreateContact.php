<?php

namespace Codelegacy\Orders\Controller\Index;
use \Magento\Framework\Controller\ResultFactory;

class CreateContact extends \Magento\Framework\App\Action\Action
{
  public function __construct(
  		\Magento\Framework\App\Action\Context $context,
  		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
  		\Magento\Framework\Message\ManagerInterface $messageManager
  	) {
  		$this->_resultJsonFactory = $resultJsonFactory;
  		$this->_messageManager = $messageManager;
  		return parent::__construct($context);
  	}

  	public function execute()
  	{
      $data = $this->getRequest()->getPostValue();
      $orders = $this->_objectManager->create('Codelegacy\Orders\Model\Orders');
      $orders->setData($data);
      $orders->save();

        $this->_messageManager->addSuccessMessage('Thanks for Contacting Us');
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());

        return $resultRedirect;
  	}
}
