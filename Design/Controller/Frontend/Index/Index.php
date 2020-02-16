<?php

namespace Codelegacy\Design\Controller\Frontend\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Mail\Template\TransportBuilder;

class Index extends \Magento\Framework\App\Action\Action
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
    		$customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');
        echo "demo"; die;
    		if($customerSession->isLoggedIn()){
    			return $this->_resultJsonFactory->create()->setData('true');
    		}else{
    			return $this->_resultJsonFactory->create()->setData('false');
    		}
  	}
}
