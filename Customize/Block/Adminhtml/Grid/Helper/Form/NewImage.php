<?php


namespace Codelegacy\Customize\Block\Adminhtml\Grid\Helper\Form;

use Magento\Framework\Data\Form\Element\Fieldset;

/**
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class NewImage extends \Magento\Backend\Block\Widget\Form\Generic {

    // protected $_template = 'Codelegacy_Customize::upload/image.phtml';
    /**
     * Anchor is product video
     */
    const PATH_ANCHOR_PRODUCT_VIDEO = 'catalog_product_video-link';

    /**
     * @var \Magento\ProductVideo\Helper\Media
     */
    protected $mediaHelper;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var string
     */
    protected $videoSelector = '#media_gallery_content';

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\ProductVideo\Helper\Media $mediaHelper
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\ProductVideo\Helper\Media $mediaHelper, \Magento\Framework\Json\EncoderInterface $jsonEncoder, array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
        $this->mediaHelper = $mediaHelper;
        $this->urlBuilder = $context->getUrlBuilder();
        $this->jsonEncoder = $jsonEncoder;
        $this->setUseContainer(true);
    }

    /**
     * Form preparation
     *
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm() {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create([
            'data' => [
                'id' => 'new_video_form',
                'class' => 'admin__scope-old',
                'enctype' => 'multipart/form-data',
            ]
        ]);

        $form->setUseContainer($this->getUseContainer());
        $form->addField('new_video_messages', 'note', []);
        $fieldset = $form->addFieldset('new_video_form_fieldset', []);
        $fieldset->addField(
                '', 'hidden', [
            'name' => 'form_key',
            'value' => $this->getFormKey(),
                ]
        );
        $fieldset->addField(
                'item_id', 'hidden', []
        );
        $fieldset->addField(
                'file_name', 'hidden', []
        );

        $fieldset->addField(
                'new_video_screenshot', 'file', [
            'label' => __('Preview Image'),
            'title' => __('Preview Image'),
            'name' => 'image',
            'data-form-part' => 'product_form'
                ]
        );

        $this->setForm($form);
    }

    /**
     * Get html id
     *
     * @return mixed
     */
    public function getHtmlId() {
        if (null === $this->getData('id')) {
            $this->setData('id', $this->mathRandom->getUniqueHash('id_'));
        }
        return $this->getData('id');
    }

    /**
     * Get widget options
     *
     * @return string
     */
    public function getWidgetOptions() {
        return $this->jsonEncoder->encode(
                        [
                            'saveVideoUrl' => $this->getUrl('catalog/product_gallery/upload'),
                            'saveRemoteVideoUrl' => $this->getUrl('product_video/product_gallery/retrieveImage'),
                            'htmlId' => $this->getHtmlId(),
                            'youTubeApiKey' => $this->mediaHelper->getYouTubeApiKey(),
                            'videoSelector' => $this->videoSelector
                        ]
        );
    }

    /**
     * Retrieve currently viewed product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    protected function getProduct() {
        if (!$this->hasData('product')) {
            $this->setData('product', $this->_coreRegistry->registry('product'));
        }
        return $this->getData('product');
    }

    /**
     * Add media role attributes to fieldset
     *
     * @param Fieldset $fieldset
     * @return $this
     */
    protected function addMediaRoleAttributes(Fieldset $fieldset) {
        $fieldset->addField('role-label', 'note', ['text' => __('Role')]);
        $mediaRoles = $this->getProduct()->getMediaAttributes();
        ksort($mediaRoles);
        foreach ($mediaRoles as $mediaRole) {
            $fieldset->addField(
                    'video_' . $mediaRole->getAttributeCode(), 'checkbox', [
                'class' => 'video_image_role',
                'label' => __($mediaRole->getFrontendLabel()),
                'title' => __($mediaRole->getFrontendLabel()),
                'data-role' => 'role-type-selector',
                'value' => $mediaRole->getAttributeCode(),
                    ]
            );
        }
        return $this;
    }

    /**
     * Get note for video url
     *
     * @return \Magento\Framework\Phrase
     */
    protected function getNoteVideoUrl() {
        $result = __('YouTube and Vimeo supported.');
        if ($this->mediaHelper->getYouTubeApiKey() === null) {
            $result = __(
                    'Vimeo supported.<br />'
                    . 'To add YouTube video, please <a href="%1">enter YouTube API Key</a> first.', $this->getConfigApiKeyUrl()
            );
        }
        return $result;
    }

    /**
     * Get url for config params
     *
     * @return string
     */
    protected function getConfigApiKeyUrl() {
        return $this->urlBuilder->getUrl(
                        'adminhtml/system_config/edit', [
                    'section' => 'catalog',
                    '_fragment' => self::PATH_ANCHOR_PRODUCT_VIDEO
                        ]
        );
    }

}
