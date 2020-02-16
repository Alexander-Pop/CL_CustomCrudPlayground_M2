<?php
/**
* @author Alex.
* Glory to Ukraine! Glory to the heros!
*/
namespace Codelegacy\color\Model\color\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 */
class ParentCategory implements OptionSourceInterface
{

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $request = $objectManager->get('\Magento\Framework\App\RequestInterface');
      $product_id = $request->getParam('custom_p_id');

      $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
      $connection = $resource->getConnection();

      if(!empty($product_id)){


        // $sql = "SELECT * FROM product_wise_parts WHERE product_id = $product_id ";
        // $result = $connection->fetchAll($sql);
        // $parts = $result[0]['parts'];
        // $partsArr = unserialize($parts);
        // echo "<pre>"; print_r($partsArr); die;
        //
        // $options = [];
        // foreach ($partsArr as $key => $label){
        //     $options[] = [
        //         'label' => $label,
        //         'value' => $key,
        //     ];
        // }
        // return $options;


          $arrayOptions = [
            'product1'=>[
              "LowerSole"=>"LowerSole",
              "MidSole"=>"MidSole",
              "TopSole"=>"TopSole",
              "Front"=>"Front",
              "Body"=>"Body",
              "Back"=>"Back",
              "Tongue"=>"Tongue",
              "Outer"=>"Outer",
              "Brand"=>"Brand"

              // "Sole"=>"Sole",
              // "AirBag"=>"AirBag",
              // "MidSole"=>"MidSole",
              // "Toe"=>"Toe",
              // "Front"=>"Front",
              // "Body"=>"Body",
              // "Back"=>"Back",
              // "Tongue"=>"Tongue",
              // "Inner"=>"Inner",
              // "Lace"=>"Lace",
              // "Outer"=>"Outer",
              // "Brand"=>"Brand"
          ],
          'product2'=>array(
            "Sole"=>"Sole",
            "MidSole"=>"MidSole",
            "Toe"=>"Toe",
            "ToeBox"=>"ToeBox",
            "BackLower"=>"BackLower",
            "BackStrip"=>"BackLower",
            "Tongue"=>"Tongue",
            "BackUpper"=>"BackUpper",
            "Inner"=>"Inner",
            "Body"=>"Body",
            "Eyelet"=>"Eyelet",
            "Lace"=>"Lace",
            "Brand"=>"Brand"
          ],
          'product3'=>array(
            "Sole"=>"Sole",
            "MidSole"=>"Sole",
            "BackHill"=>"BackHill",
            "Back"=>"Back",
            "Toe"=>"Toe",
            "Body"=>"Back",
            "Front"=>"Front",
            "Tongue"=>"Tongue",
            "Inner"=>"Inner",
            "Brand"=>"Brand",
            "Outer"=>"Outer",
            "Lace"=>"Lace"
          ],
          'product4'=>array(
            "Sole" => "Sole",
            "MidSole" => "MidSole",
            "Body" => "Body",
            "Pipping" => "Pipping",
            "Lace" => "Lace",
            "TonguePipe" => "TonguePipe",
            "Tongue" => "Tongue",
            "Upper" => "Upper",
            "Front" => "Front",
            "Back" => "Back",
            "Inner" => "Inner",
            "TongueUpper" => "TongueUpper",
            "BackMidSole" => "BackMidSole",
            "Eyelet" => "Eyelet"
          ],
          'product5'=>array(
            'Sole'=>'Sole',
            'MidSole'=>'MidSole',
            'Body'=>'Body',
            'Pipping'=>'Pipping',
            'Lace'=>'Lace',
            'TonguePipe'=>'TonguePipe',
            'Tongue'=>'Tongue',
            'Pipping'=>'Pipping',
            'Back'=>'Back',
            'Inner'=>'Inner',
            'BackMidSole'=>'BackMidSole',
            'Eyelet'=>'Eyelet',
            'Brand'=>'Brand'
          ],
          'product6'=>array(
            "Back"=>"Back",
            "Airbag"=>"Airbag",
            "MidSole"=>"MidSole",
            "Sole"=>"Sole",
            "MidSole"=>"MidSole",
            "Toe"=>"Toe",
            "Front"=>"Front",
            "BackUpper"=>"BackUpper",
            "Inner"=>"Inner",
            "Tongue"=>"Tongue",
            "Body"=>"Body",
            "Lace"=>"Lace",
            "Brand"=>"Brand"
          ],
          'product7'=>array(
            "Toe"=>"Toe",
            "Back"=>"Back",
            "Front"=>"Front",
            "Upper"=>"Upper",
            "Inner"=>"Inner",
            "Tongue"=>"Tongue",
            "Body"=>"Body",
            "BackMidSole"=>"BackMidSole",
            "Sole"=>"Sole",
            "MidSole"=>"MidSole",
            "Pipping"=>"Pipping",
            "Eyelet"=>"Eyelet",
            "Lace"=>"Lace"
          ],
          'product8'=>[
            "Brand"=>"Brand",
            "Body"=>"Body",
            "BackLower"=>"BackLower",
            "MidSole"=>"MidSole",
            "BackUpper"=>"BackUpper",
            "Sole"=>"Sole"

            // "Brand"=>"Brand",
            // "Outer"=>"Outer",
            // "Lace"=>"Lace",
            // "Body"=>"Body",
            // "Eyelet"=>"Eyelet",
            // "Front"=>"Front",
            // "BackLower"=>"BackLower",
            // "MidSole"=>"MidSole",
            // "BackUpper"=>"BackUpper",
            // "Inner"=>"Inner",
            // "Tongue"=>"Tongue",
            // "Toe"=>"Toe",
            // "Sole"=>"Sole"
          ],
          'product9'=>[
              "Body"=>"Body",
              "Sole"=>"Sole",
              "MidSole"=>"MidSole",
              "Front"=>"Front",
              "Inner"=>"Inner",
              "Back"=>"Back",
              "Lace"=>"Lace",
              "Tongue"=>"Tongue",
              "Brand"=>"Brand",
              "BrandBorder"=>"BrandBorder"
          ]
        ];

          // echo serialize($arrayOptions['product6']); die;

          $enabledProduct = $product_id;

          $options = [];

          if($enabledProduct == '1'){ // provide here catalog product ID.

            foreach ($arrayOptions['product1'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '2'){ // provide here catalog product ID.

            foreach ($arrayOptions['product2'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '3'){ // provide here catalog product ID.

            foreach ($arrayOptions['product3'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '4'){ // provide here catalog product ID.

            foreach ($arrayOptions['product4'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '5'){ // provide here catalog product ID.

            foreach ($arrayOptions['product5'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '6'){ // provide here catalog product ID.

            foreach ($arrayOptions['product6'] as $key => $label) {
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '7'){ // provide here catalog product ID.

            foreach ($arrayOptions['product7'] as $key => $label){
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '8'){ // provide here catalog product ID.

            foreach ($arrayOptions['product8'] as $key => $label){
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          } else if($enabledProduct == '9'){ // provide here catalog product ID.

            foreach ($arrayOptions['product9'] as $key => $label){
                $options[] = [
                    'label' => $label,
                    'value' => $key,
                ];
            }
            return $options;
          }

      } else {
        return [
           ['value' => '', 'label' =>""]
        ];

      }




      // $coreSession = $objectManager->get('\Magento\Framework\Session\SessionManagerInterface');
      // $coreSession->start();
      // $getProductId = $coreSession->getProductId();

      // if(empty($product_id)){
      //   $getProductId = 0;
      // }
      // echo $getProductId; die;





      // $coreSession->start();
      // $coreSession->unsProductId();

      //   $arrayOptions = array(
      //     'product1'=>array(
      //      'Sole'=>'Sole',
      //      'MidSole'=>'MidSole',
      //      'Back'=>'Back',
      //      'UpperBack'=>'UpperBack',
      //      'Body'=>'Body',
      //      'Front'=>'Front',
      //      'Pipping'=>'Pipping',
      //      'Lace'=>'Lace',
      //      'Inner'=>'Inner',
      //      'TonguePipe'=>'TonguePipe',
      //      'Tongue'=>'Tongue',
      //      'Upper'=>'Upper'
      //   ),
      //     'product2'=>array(
      //      'Sole'=>'Sole',
      //      'MidSole'=>'MidSole',
      //      'Back'=>'Back',
      //      'Body'=>'Body',
      //      'UpperBack'=>'UpperBack',
      //      'Front'=>'Front',
      //      'Pipping'=>'Pipping',
      //      'Lace'=>'Lace',
      //      'Inner'=>'Inner',
      //      'TonguePipe'=>'TonguePipe',
      //      'Tongue'=>'Tongue',
      //      'Upper'=>'Upper',
      //      'BackLower'=>'BackLower',
      //      'BackUpper'=>'BackUpper',
      //      'BackStrip'=>'BackStrip',
      //      'Toe'=>'Toe',
      //      'Eyelet'=>'Eyelet',
      //
      //      'Inner'=>'Inner',
      //      'TongueUpper'=>'TongueUpper',
      //      'TongueInner'=>'TongueInner',
      //
      //      'BackMidSole'=>'BackMidSole'
      //   ),
      //   'empty'=>array(
      //    ''=>''
      // )
      // );







        /*
        $enabledProduct = $getProductId;

        $options = [];

        if($enabledProduct == '1'){ // provide here catalog product ID.

          foreach ($arrayOptions['product1'] as $key => $label) {
              $options[] = [
                  'label' => $label,
                  'value' => $key,
              ];
          }

          // $coreSession->start();
          // $coreSession->unsProductId();

          return $options;

        }
        else if($enabledProduct == '2'){ // provide here catalog product ID.

          foreach ($arrayOptions['product2'] as $key => $label) {
              $options[] = [
                  'label' => $label,
                  'value' => $key,
              ];
          }

          // $coreSession->start();
          // $coreSession->unsProductId();

          return $options;

        }
        else if($enabledProduct == '4'){ // provide here catalog product ID.

          foreach ($arrayOptions['p_test'] as $key => $label) {
              $options[] = [
                  'label' => $label,
                  'value' => $key,
              ];
          }

          // $coreSession->start();
          // $coreSession->unsProductId();

          return $options;

        }
        else if($enabledProduct == '5'){ // provide here catalog product ID.

          foreach ($arrayOptions['p_five'] as $key => $label) {
              $options[] = [
                  'label' => $label,
                  'value' => $key,
              ];
          }

          // $coreSession->start();
          // $coreSession->unsProductId();

          return $options;

        }
        else{
          $coreSession->start();
          $coreSession->unsProductId();
          return [
              ['value' => '0', 'label' => __('Please select product')]
          ];

        }

        */

        // return [
        //    ['value' => '', 'label' =>""]
        // ];

        // return [
        //   ['value' => 'Sole', 'label' => __('Sole')],
        //   ['value' => 'MidSole', 'label' => __('MidSole')],
        //   ['value' => 'Back', 'label' => __('Back')],
        //   ['value' => 'UpperBack', 'label' => __('UpperBack')],
        //   ['value' => 'Body', 'label' => __('Body')],
        //   ['value' => 'Front', 'label' => __('Front')],
        //   ['value' => 'Pipping', 'label' => __('Pipping')],
        //   ['value' => 'Lace', 'label' => __('Lace')],
        //   ['value' => 'Inner', 'label' => __('Inner')],
        //   ['value' => 'TonguePipe', 'label' => __('TonguePipe')],
        //   ['value' => 'Tongue', 'label' => __('Tongue')],
        //   ['value' => 'Upper', 'label' => __('Upper')],
        //   ['value' => 'BackLower', 'label' => __('BackLower')],
        //   ['value' => 'BackUpper', 'label' => __('BackUpper')],
        //   ['value' => 'BackStrip', 'label' => __('BackStrip')],
        //   ['value' => 'Toe', 'label' => __('Toe')],
        //   ['value' => 'Eyelet', 'label' => __('Eyelet')]
        // ];
    }
}
