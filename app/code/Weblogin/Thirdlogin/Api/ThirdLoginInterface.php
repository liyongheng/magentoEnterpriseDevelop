<?php 
namespace Weblogin\Thirdlogin\Api;
 
interface ThirdLoginInterface {

	/**
	 * get customer info
	 * @param string $email
	 * @return string
	 */
	public function getCustomerInfo($email);
}