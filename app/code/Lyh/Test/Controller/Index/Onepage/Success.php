<?php
namespace Lyh\Test\Controller\Index\Onepage;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

//继承系统原来的控制器
class Success extends \Magento\Checkout\Controller\Onepage\Success implements HttpGetActionInterface
{  
	public function execute(){
		exit("Onepage/Success控制器重写成功，文件路径:".__FILE__);
	}
}