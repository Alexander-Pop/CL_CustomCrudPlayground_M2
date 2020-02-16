<?php
namespace Codelegacy\Font\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Codelegacy\Font\Model\ResourceModel\Font\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

       $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');

        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();



        foreach ($collection as $item) {

          $rootPath1  =  $directory->getPath('media').$item['thumbnail_image'];
          $rootPath2  =  $directory->getPath('media').$item['glow_image'];

          //  checking if file exists in folder if exist then delete.
          if(is_file($rootPath1)){

            unlink($rootPath1);

          }else{ }


          if(is_file($rootPath2)){

            unlink($rootPath2);

          }else{ }
          
                $item->delete();
                // display success message
                $this->messageManager->addSuccess(__('A total of %1 Codelegacy have been deleted.', $collectionSize));

        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
