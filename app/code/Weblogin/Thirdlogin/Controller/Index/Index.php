<?php
namespace Weblogin\Thirdlogin\Controller\Index;

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
class Index extends \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        Context $context
    ) {
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    /**
     * Default customer account page
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $email = isset($post['email'])  ? $post['email'] : '';
        $password = isset($post['password'])  ? $post['password'] : '';
        $redirectTo = isset($post['redirect'])  ? $post['redirect'] : 1;
        $redirectToUrl = '';

        switch ($redirectTo) {
            case 1:
                $redirectToUrl = $this->_url->getUrl('customer/account');
                break;
            case 2:
                $redirectToUrl = $this->_url->getUrl('checkout');
                break;
            case 0:
                return $this->resultFactory
                        ->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT)
                        ->setUrl($this->_url->getUrl('customer/account/login'));
                break;
        }

        //用户登录逻辑
        if (!empty($email) && !empty($password)) {
            
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		    $session = $objectManager->get(\Magento\Customer\Model\Session::class);
		    $customerAccountManagement = $objectManager->get(\Magento\Customer\Model\AccountManagement::class);
		    $cookieManager = $objectManager->get(\Magento\Framework\Stdlib\Cookie\PhpCookieManager::class);
            $cookieMetadataFactory = $objectManager->get(\Magento\Framework\Stdlib\Cookie\CookieMetadataFactory::class);
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            
            try {
				//login
				$customer = $customerAccountManagement->authenticate($email, $password);
                $customer = $this->getUserFromWxOpenid($wx_openid);


				$session->setCustomerDataAsLoggedIn($customer);

                if ($cookieManager->getCookie('mage-cache-sessid')) {
                    $metadata = $cookieMetadataFactory->createCookieMetadata();
                    $metadata->setPath('/');
                    $cookieManager->deleteCookie('mage-cache-sessid', $metadata);
                }

                //用户登成功以后跳转到中间页
                $middlePage = 'loginpage/login/index/url/'.base64_encode($redirectToUrl);
                return $redirect->setUrl($this->_url->getUrl($middlePage));

            } catch (\Exception $e) {
                //redirect to login
                return $redirect->setUrl($this->_url->getUrl('customer/account/login'));
            } finally {
                $session->setUsername($email);
            }
        } else {
            exit('param error.');
		}

    }

    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }
 
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }

}