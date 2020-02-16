<?php
namespace Codelegacy\Customize\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context
	) {
		return parent::__construct($context);
	}

	public function execute()
	{
		return "Welcome";
	}
}
