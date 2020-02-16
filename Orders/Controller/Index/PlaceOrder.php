<?php

namespace Codelegacy\Orders\Controller\Index;

class PlaceOrder extends \Magento\Framework\App\Action\Action
{
  /**
  * Recipient email config path
  */
  const XML_PATH_EMAIL_RECIPIENT = 'customer/email/place_order';

  const XML_PATH_EMAIL_RECIPIENT_ADMIN = 'admin/email/place_order';
  /**
  * @var \Magento\Framework\Mail\Template\TransportBuilder
  */
  protected $_transportBuilder;

  /**
  * @var \Magento\Framework\Translate\Inline\StateInterface
  */
  protected $inlineTranslation;

  /**
  * @var \Magento\Framework\App\Config\ScopeConfigInterface
  */
  protected $scopeConfig;

  /**
  * @var \Magento\Store\Model\StoreManagerInterface
  */
  protected $storeManager;
  /**
  * @var \Magento\Framework\Escaper
  */
  protected $_escaper;
  /**
  * @param \Magento\Framework\App\Action\Context $context
  * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
  * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
  * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
  * @param \Magento\Store\Model\StoreManagerInterface $storeManager
  */

  public function __construct(
  		\Magento\Framework\App\Action\Context $context,
  		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
  		\Magento\Framework\Message\ManagerInterface $messageManager,
      \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
      \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
      \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
      \Magento\Store\Model\StoreManagerInterface $storeManager,
      \Magento\Framework\Escaper $escaper
  	) {
  		$this->_resultJsonFactory = $resultJsonFactory;
  		$this->_messageManager = $messageManager;
      $this->_transportBuilder = $transportBuilder;
      $this->inlineTranslation = $inlineTranslation;
      $this->scopeConfig = $scopeConfig;
      $this->storeManager = $storeManager;
      $this->_escaper = $escaper;
  		return parent::__construct($context);
  	}

  	public function execute()
  	{

      $customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');

      if($customerSession->isLoggedIn()){

        $customerId = $customerSession->getId();
        $customerEmail = $customerSession->getCustomer()->getEmail();
        $data = $this->getRequest()->getParams();

        $productId = $data['product_id'];

        $product = $this->_objectManager->create('Magento\Catalog\Model\Product')->load($productId);
        $productName = $product->getName();
        // $productArr = array('id'=>$product->getId(),'name'=>$product->getName(),'price'=>$product->getPrice());
        $orderId = $data['order_id'];

        $ModelOrder = $this->_objectManager->create('Codelegacy\Orders\Model\PendingOrders')->load($orderId);
        $getOrderId = $orderId;
        $getCustomerId = $customerId;
        $getCustomerEmail = $ModelOrder->getCustomerEmail();
        $getCustomerName = $ModelOrder->getCustomerName();
        $getProductId = $ModelOrder->getProductId();
        $getProductDetails = $ModelOrder->getProductDetails();
        $getCustomDesign = $ModelOrder->getCustomDesign();
        // created at , updated at , status.

        $ModelPlaceOrder = $this->_objectManager->create('Codelegacy\Orders\Model\Orders');
        $ModelPlaceOrder->setOrderId($getOrderId);
        $ModelPlaceOrder->setCustomerId($getCustomerId);
        $ModelPlaceOrder->setCustomerName($getCustomerName);
        $ModelPlaceOrder->setCustomerEmail($getCustomerEmail);
        $ModelPlaceOrder->setProductId($getProductId);
        $ModelPlaceOrder->setProductDetails($getProductDetails);
        $ModelPlaceOrder->setCustomDesign($getCustomDesign);
        $ModelPlaceOrder->setStatus('1');
        $saved = $ModelPlaceOrder->save();

        if($saved){

          $orderId = $data['order_id'];

          $PlaceUpdateOrder = $this->_objectManager->create('Codelegacy\Orders\Model\PendingOrders')->load($orderId);
          $PlaceUpdateOrder->setStatus('1');
          $PlaceUpdateOrder->save();


          $post['order_id'] = $orderId;
          $post['email'] = $customerEmail;
          $post['productName'] = $productName;
          // $post['test'] = 'test';

          /*
          email for customer for placing order..
          */
          $this->inlineTranslation->suspend();
          try {

          $postObject = new \Magento\Framework\DataObject();
          $postObject->setData($post);

          $error = false;

          // Using below third party credentials for testing.
          $sender = [
          'name' =>'Kt',
          'email' =>'intranetadmin@codelegacytech.com',
          ];

          $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
          $transport = $this->_transportBuilder
          ->setTemplateIdentifier('customer_place_order') // this code we have mentioned in the email_templates.xml
          ->setTemplateOptions(
          [
          'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
          'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
          ]
          )
          ->setTemplateVars(['data' => $postObject])
          ->setFrom($sender)
          ->addTo($customerEmail,$getCustomerName)
          ->getTransport();

          $transport->sendMessage();
          $this->inlineTranslation->resume();


        } catch (\Exception $ec) {
          $this->inlineTranslation->resume();
          return $this->_resultJsonFactory->create()->setData('We can\'t process your request right now. Sorry, that\'s all we know.'.$ec->getMessage());
          // $this->messageManager->addError(
          // __('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage())
          // );
          }
          /*
          customer email ends.
          */


          /*
          email for admin after placing order..
          */
          $resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
          $connection = $resource->getConnection();
          $getUserQuery = "SELECT * FROM admin_user WHERE is_active = 1";
          $getAdminUserData = $connection->fetchRow($getUserQuery);
          $adminEmail = $getAdminUserData['email'];

          $this->inlineTranslation->suspend();
          try {
          $postObject = new \Magento\Framework\DataObject();
          $postObject->setData($post);

          $error = false;

          // Using below third party credentials for testing.
          $sender = [
          'name' =>'Kt',
          'email' =>'intranetadmin@codelegacytech.com',
          ];

          $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
          $transport = $this->_transportBuilder
          ->setTemplateIdentifier('admin_order_email') // this code we have mentioned in the email_templates.xml
          ->setTemplateOptions(
          [
          'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
          'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
          ]
          )
          ->setTemplateVars(['data' => $postObject])
          ->setFrom($sender)
          ->addTo($adminEmail,'Admin')
          ->getTransport();

          $transport->sendMessage();
          $this->inlineTranslation->resume();
          // return true;
          return $this->_resultJsonFactory->create()->setData("success");
          } catch (\Exception $e) {
          $this->inlineTranslation->resume();
          return $this->_resultJsonFactory->create()->setData('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage());
          // $this->messageManager->addError(
          // __('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage())
          // );
          }
          /*
          admin email ends.
          */

        }


      }

      //   echo "<pre>"; print_r($data); die;
      //
      //   $customerName = $data['saveName_email'];
      //   $email = $data['email'];
      //   $price = $data['prodPrice'];
      //   $productId = $data['product_id'];
      //
      //   $imageArr = $data['design']['imageGenerationData'];
      //
      //   $designArr = "";
      //
      //   if(!empty($data['design']['views']['actPartColor'])){
      //     $designArr = $data['design']['views']['actPartColor'];
      //   }
      //
      //   $view1 = $data['design']['imageGenerationData'][0]['dataurl'];
      //   $view2 = $data['design']['imageGenerationData'][1]['dataurl'];
      //
      //   /*
      //   below, getting and sorting cliparts and texts
      //     */
      //   $clip_img_left = "";
      //   $left_text = "";
      //   $clip_img_right = "";
      //   $right_text = "";
      //
      //   if(!empty($data['design']['views']['uploadedImg1'])){
      //     if(!empty($data['design']['views']['uploadedImg1']['image-left'])){
      //      $clip_img_left = $data['design']['views']['uploadedImg1']['image-left'];
      //     }
      //     if(!empty($data['design']['views']['uploadedImg1']['text-left'])){
      //      $left_text = $data['design']['views']['uploadedImg1']['text-left'];
      //     }
      //   }
      //
      //   if(!empty($data['design']['views']['uploadedImg2'])){
      //     if(!empty($data['design']['views']['uploadedImg2']['image-right'])){
      //      $clip_img_right = $data['design']['views']['uploadedImg2']['image-right'];
      //     }
      //     if(!empty($data['design']['views']['uploadedImg2']['text-right'])){
      //      $right_text = $data['design']['views']['uploadedImg2']['text-right'];
      //     }
      //   }
      //
      //
      //   $customDataArr = array(
      //     'viewsData'=>array('view1'=>$view1,'view2'=>$view2),
      //     'clipsData'=>array('left_view'=>$clip_img_left,'right_view'=>$clip_img_right),
      //     'textData'=>array('left_text'=>$left_text,'right_text'=>$right_text),
      //     'attributes'=>$designArr,
      //     'price'=>$price
      //   );
      //
      //   $ModelOrder = $this->_objectManager->create('Codelegacy\Orders\Model\PendingOrders');
      //   $ModelOrder->setCustomerId($customerId);
      //   $ModelOrder->setCustomerName($customerName);
      //   $ModelOrder->setCustomerEmail($email);
      //   $ModelOrder->setProductId($productId);
      //   $ModelOrder->setProductDetails('...prodct details');
      //   $ModelOrder->setCustomDesign(json_encode($customDataArr));
      //   $ModelOrder->setStatus('0');
      //   $ModelOrder->save();
      //
      //   return $this->_resultJsonFactory->create()->setData('success');
      // }else{
      //
      //   return $this->_resultJsonFactory->create()->setData('login_failure');
      // }

      // $resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
      // $connection = $resource->getConnection();
      // $storeManager = $this->_objectManager->get('\Magento\Store\Model\StoreManagerInterface');
      // $mediaUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
      // $productId = 1;




  	}
}
