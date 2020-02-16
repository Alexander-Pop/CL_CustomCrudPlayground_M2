<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Codelegacy\Orders\Model\Orders;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\RequestInterface;

//use Magento\Framework\Stdlib\DateTime\DateTime;
//use Magento\Ui\Component\MassAction\Filter;
//use FME\News\Model\ResourceModel\Test\CollectionFactory;

class Save extends \Magento\Backend\App\Action
{

  /**
  * Recipient email config path
  */
  const XML_PATH_EMAIL_RECIPIENT = 'test/email/send_email';
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
        Context $context,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
    ) {
       // $this->filter = $filter;
       // $this->collectionFactory = $collectionFactory;
        $this->dataPersistor = $dataPersistor;
         $this->scopeConfig = $scopeConfig;
         $this->_escaper = $escaper;
        $this->_dateFactory = $dateFactory;
         $this->inlineTranslation = $inlineTranslation;

         $this->_transportBuilder = $transportBuilder;
         $this->storeManager = $storeManager;

        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        $email = $data['email'];
        $reply = $data['reply'];
        $name = $data['f_name']. " " .$data['l_name'];



          $post['name'] = $name;
          $post['email'] = $email;
          $post['reply'] = $reply;

          // print_r($post); die;
          $this->inlineTranslation->suspend();
          try {
          $postObject = new \Magento\Framework\DataObject();
          $postObject->setData($post);

          $error = false;

          $sender = [
          'name' =>'Kt',
          'email' =>'intranetadmin@codelegacytech.com',
          ];

          $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
          $transport = $this->_transportBuilder
          ->setTemplateIdentifier('send_reply_email_template') // this code we have mentioned in the email_templates.xml
          ->setTemplateOptions(
          [
          'area' => \Magento\Framework\App\Area::AREA_FRONTEND, // this is using frontend area to get the template file
          'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
          ]
          )
          ->setTemplateVars(['data' => $postObject])
          ->setFrom($sender)
          ->addTo($email,$name)
          ->getTransport();

          $transport->sendMessage();
          $this->inlineTranslation->resume();

          }
          catch (\Exception $e) {
          $this->inlineTranslation->resume();
          // $this->messageManager->addError(
          // __('We can\'t process your request right now. Sorry, that\'s all we know.'.$e->getMessage())
          // );
          // // $this->_redirect('*/*/');
          // return;
        }

        if ($data) {

            $id = $this->getRequest()->getParam('codelegacy_orders_id');

            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Block::STATUS_ENABLED;
            }
            if (empty($data['codelegacy_orders_id'])) {
                $data['codelegacy_orders_id'] = null;
            }


            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_objectManager->create('Codelegacy\Orders\Model\Orders')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This codelegacy_orders no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }


            // if (isset($data['thumbnail_image'][0]['name']) && isset($data['thumbnail_image'][0]['tmp_name'])) {
            //     $data['thumbnail_image'] ='/codelegacy_orders/'.$data['thumbnail_image'][0]['name'];
            // } elseif (isset($data['thumbnail_image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
            //     $data['thumbnail_image'] =$data['thumbnail_image'][0]['name'];
            // } else {
            //     $data['thumbnail_image'] = null;
            // }
            //
            // if (isset($data['glow_image'][0]['name']) && isset($data['glow_image'][0]['tmp_name'])) {
            //     $data['glow_image'] ='/codelegacy_orders/'.$data['glow_image'][0]['name'];
            // } elseif (isset($data['glow_image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
            //     $data['glow_image'] =$data['glow_image'][0]['name'];
            // } else {
            //     $data['glow_image'] = null;
            // }
            //
            // $data['parent_category'] = serialize($data['parent_category']);

            $model->setData($data);


            $this->inlineTranslation->suspend();
            try {
                    //////////////////// email
                $model->save();
                $this->messageManager->addSuccess(__('Reply has been sent successfully'));
                $this->dataPersistor->clear('codelegacy_orders');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['codelegacy_orders_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the codelegacy_orders.'));
                print_r($e);
            }

            $this->dataPersistor->set('codelegacy_orders', $data);
            return $resultRedirect->setPath('*/*/edit', ['codelegacy_orders_id' => $this->getRequest()->getParam('codelegacy_orders_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
