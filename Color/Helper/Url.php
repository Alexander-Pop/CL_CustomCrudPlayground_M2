<?php

namespace Codelegacy\Color\Helper;

use Magento\Framework\UrlInterface;

class Url extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getMediaPath() {
        return $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]);
    }

}
