<?php

namespace Codelegacy\Orders\Controller\Index;

class CreateOrder extends \Magento\Framework\App\Action\Action
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

      $data = $this->getRequest()->getParams();

      // echo "<pre>"; print_r($data['design']['views']['uploadedImg2']); die;

      $customerSession = $this->_objectManager->create('Magento\Customer\Model\Session');

      if($customerSession->isLoggedIn()){

        $customerId = $customerSession->getId();

        $data = $this->getRequest()->getParams();

        // echo "<pre>"; print_r($data); die;

        $customerName = $data['saveName_email'];
        $email = $data['email'];
        $price = $data['prodPrice'];
        $productId = $data['product_id'];

        $imageArr = "";
        if(!empty($data['design']['imageGenerationData'])){
          $imageArr = $data['design']['imageGenerationData'];
        }


        $left_text_Text = "";
        $left_text_Color = "";
        $left_text_Font = "";

        $right_text_Text = "";
        $right_text_Color = "";
        $right_text_Font = "";

        if(!empty($data['design']['views']['uploadedImg1'])){
          if(!empty($data['design']['views']['uploadedImg1']['text-left'])){
            $left_text_Text = $data['design']['views']['uploadedImg1']['text-left'];
          }
          if(!empty($data['design']['views']['uploadedImg1']['text-left-color'])){
            $left_text_Color = $data['design']['views']['uploadedImg1']['text-left-color'];
          }
          if(!empty($data['design']['views']['uploadedImg1']['text-left-font'])){
            $left_text_Font = $data['design']['views']['uploadedImg1']['text-left-font'];
          }
        }

        if(!empty($data['design']['views']['uploadedImg2'])){
          if(!empty($data['design']['views']['uploadedImg2']['text-right'])){
            $right_text_Text = $data['design']['views']['uploadedImg2']['text-right'];
          }
          if(!empty($data['design']['views']['uploadedImg2']['text-right-color'])){
            $right_text_Color = $data['design']['views']['uploadedImg2']['text-right-color'];
          }
          if(!empty($data['design']['views']['uploadedImg2']['text-right-font'])){
            $right_text_Font = $data['design']['views']['uploadedImg2']['text-right-font'];
          }
        }

        $designArr = "";

        if(!empty($data['design']['views']['actPartColor'])){
          $designArr = $data['design']['views']['actPartColor'];
        }

        $view1 = $data['design']['imageGenerationData'][0]['dataurl'];
        $view2 = $data['design']['imageGenerationData'][1]['dataurl'];

        /*
        below, getting and sorting cliparts and texts
          */
        $clip_img_left = "";
        $left_text = "";
        $clip_img_right = "";
        $right_text = "";

        if(!empty($data['design']['views']['uploadedImg1'])){
          if(!empty($data['design']['views']['uploadedImg1']['image-left'])){
           $clip_img_left = $data['design']['views']['uploadedImg1']['image-left'];
          }
          if(!empty($data['design']['views']['uploadedImg1']['text-left'])){
           $left_text = $data['design']['views']['uploadedImg1']['text-left'];
          }
        }

        if(!empty($data['design']['views']['uploadedImg2'])){
          if(!empty($data['design']['views']['uploadedImg2']['image-right'])){
           $clip_img_right = $data['design']['views']['uploadedImg2']['image-right'];
          }
          if(!empty($data['design']['views']['uploadedImg2']['text-right'])){
           $right_text = $data['design']['views']['uploadedImg2']['text-right'];
          }
        }


        $customDataArr = array(
          'viewsData'=>array('view1'=>$view1,'view2'=>$view2),
          'clipsData'=>array('left_view'=>$clip_img_left,'right_view'=>$clip_img_right),
          'textData'=>array('left_text'=>$left_text,'left_text_color'=>$left_text_Color,'left_text_font'=>$left_text_Font,
                            'right_text'=>$right_text,'right_text_color'=>$right_text_Color,'right_text_font'=>$right_text_Font),
          'attributes'=>$designArr,
          'price'=>$price
        );

        $ModelOrder = $this->_objectManager->create('Codelegacy\Orders\Model\PendingOrders');
        $ModelOrder->setCustomerId($customerId);
        $ModelOrder->setCustomerName($customerName);
        $ModelOrder->setCustomerEmail($email);
        $ModelOrder->setProductId($productId);
        $ModelOrder->setProductDetails('...prodct details');
        $ModelOrder->setCustomDesign(json_encode($customDataArr));
        $ModelOrder->setStatus('0');
        $ModelOrder->save();

        return $this->_resultJsonFactory->create()->setData('success');
      }else{

        return $this->_resultJsonFactory->create()->setData('login_failure');
      }

      // $resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
      // $connection = $resource->getConnection();
      // $storeManager = $this->_objectManager->get('\Magento\Store\Model\StoreManagerInterface');
      // $mediaUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
      // $productId = 1;




  	}
}
