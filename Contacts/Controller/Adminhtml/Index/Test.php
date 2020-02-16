<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Test extends \Magento\Backend\App\Action
{
  public function __construct(
  		Context $context,
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
      if(isset($data)){
        $resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $pid = $data['pid'];
        $values = $data['values'];
              // echo "<pre>"; print_r($values); die;
        $encoded_values = serialize($values);

        			//Select Data from table
        $sql = "SELECT * FROM product_wise_parts WHERE product_id = $pid";
        $result = $connection->fetchAll($sql);
        // echo "<pre>"; print_r(); die;
        $parts = $result[0]['parts'];
        $partsArr = unserialize($parts);

        return $this->_resultJsonFactory->create()->setData($partsArr);
      }

    }
}
