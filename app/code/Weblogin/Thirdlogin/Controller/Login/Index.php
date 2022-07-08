<?php
namespace Weblogin\Thirdlogin\Controller\Login;

use \Magento\Customer\Controller\AbstractAccount;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Request\InvalidRequestException;
use \Magento\Framework\App\RequestInterface;
use \Magento\Framework\Phrase;
use \Magento\Framework\Controller\Result\Redirect;
use \Magento\Framework\App\CsrfAwareActionInterface;

/**
 * Edit registered card action
 */
class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        Context $context
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Default customer account page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }

}