<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Orders\Controller\Adminhtml\Index;

use Magento\Framework\UrlInterface;
// use Magento\Backend\App\Action;
// use Magento\Backend\App\Action\Context;
// use Magento\Framework\Filesystem\Driver\File;
// use Magento\Framework\Filesystem;
// use Magento\Framework\App\Filesystem\DirectoryList;

class Delete extends \Magento\Backend\App\Action
{

      //   protected $_filesystem;
      //   protected $_file;
      //
      // public function __construct(
      //     Context $context,
      //     Filesystem $_filesystem,
      //     File $file
      // )
      // {
      //     parent::__construct($context);
      //     $this->_filesystem = $_filesystem;
      //     $this->_file = $file;
      // }


    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Codelegacy_Orders::codelegacy_orders');
    }

    /*
      @mediaStoragePath
    */
    public function getMediaPath() {
      return UrlInterface::URL_TYPE_MEDIA;
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('codelegacy_orders_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create('Codelegacy\Orders\Model\Orders');
                $model->load($id);
                $title = $model->getTitle();

                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

                $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');

                $rootPath1  =  $directory->getPath('media').$model['thumbnail_image'];
                $rootPath2  =  $directory->getPath('media').$model['glow_image'];

                //  checking if file exists in folder if exist then delete.
                if(is_file($rootPath1)){

                  unlink($rootPath1);

                }else{ }


                if(is_file($rootPath2)){

                  unlink($rootPath2);

                }else{ }

                      $model->delete();
                      // display success message
                      $this->messageManager->addSuccess(__('The codelegacy has been deleted.'));



                // go to grid
                /*$this->_eordersManager->dispatch(
                    'adminhtml_codelegacy_orders_on_delete',
                    ['title' => $title, 'status' => 'success']
                );*/
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                /*$this->_eordersManager->dispatch(
                    'adminhtml_codelegacy_orders_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );*/
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['codelegacy_orders_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a codelegacy orders to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
