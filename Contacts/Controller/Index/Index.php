<?php

namespace Codelegacy\Contacts\Controller\Index;

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
      echo "contacts";
      // $resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
      // $connection = $resource->getConnection();
      // $storeManager = $this->_objectManager->get('\Magento\Store\Model\StoreManagerInterface');
      // $mediaUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
      //
      // $productId = 1;

       /*
        here, getting the assigned design values of a product by its ID.
       */



    		// $customerSession = $this->_objectManager->get('Magento\Customer\Model\Session');
        // echo "demo"; die;
    		// if($customerSession->isLoggedIn()){
    		// 	return $this->_resultJsonFactory->create()->setData('true');
    		// }else{
    		// 	return $this->_resultJsonFactory->create()->setData('false');
    		// }
  	}
}
