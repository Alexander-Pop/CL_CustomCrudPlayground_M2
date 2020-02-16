<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\Contacts\Model\Contacts\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class Type implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

      $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

      $collection = $productCollection->create()
                  ->addAttributeToSelect('*')
                  ->load();

      $options = [];
      foreach ($collection as $product) {
          $options[] = [
              'label' => $product->getName(),
              'value' => $product->getId(),
          ];
      }
      return $options;

      // return [
      //     ['value' => '1', 'label' => __('Wash/Fade')],
      //     ['value' => '2', 'label' => __('Riped/Details')],
      //     ['value' => '3', 'label' => __('Paints/Art')]
      // ];
    }
}
