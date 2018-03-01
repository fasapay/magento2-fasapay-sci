<?php
namespace FasaPaymentSci\Fasapay\Block;

class fasapay extends \Magento\Framework\View\Element\Template
{
	protected $_catalogSession;
    protected $_customerSession;
    protected $_checkoutSession;
    protected $_scopeConfig;
		
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,   
		\Magento\Framework\Encryption\EncryptorInterface $encryptor,
		\Magento\Sales\Model\Order $salesOrderFactory,
        \Magento\Catalog\Model\Session $catalogSession,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Checkout\Model\Session $checkoutSession,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {        
        $this->_scopeConfig = $scopeConfig;
		$this->_encryptor = $encryptor;
        $this->_catalogSession = $catalogSession;
        $this->_salesFactory = $salesOrderFactory;
        $this->_checkoutSession = $checkoutSession;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }
	public function getStoreUrl($fromStore = true)
    {
        return $this->_storeManager->getStore()->getCurrentUrl($fromStore);
    }
	public function getPages(){
		if (filter_input(INPUT_GET, 'pages') == 'success'){
			$pages = 'success';
			return $pages;
		}
		else if (filter_input(INPUT_GET, 'pages') == 'fail'){
			$pages = 'fail';
			return $pages;
		}
		else if (filter_input(INPUT_GET, 'pages') == 'status'){
			$pages = 'status';
			return $pages;
		}
	
	}
	public function getValidation(){
	$fasaConfig = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
	$num = filter_input(INPUT_POST, 'order_id');
	$orderId = (int)$num;
   	$order   = $this->_salesFactory->load($orderId);
	$merchantStoreName = $this->_encryptor->decrypt($this->_scopeConfig->getValue("payment/fasapaymethod/store_name", $fasaConfig));
    $merchantSecurityWord = $this->_encryptor->decrypt($this->_scopeConfig->getValue("payment/fasapaymethod/scurity_key", $fasaConfig));
    $msg = '';
    $msg .= filter_input(INPUT_POST, 'fp_amnt') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_batchnumber') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_currency') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_fee_amnt') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_fee_mode') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_merchant_ref') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_paidby') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_paidto') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_sec_field') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_store') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_timestamp') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_total') . '|';
    $msg .= filter_input(INPUT_POST, 'fp_unix_time') . '|';
    $msg .= filter_input(INPUT_POST, 'order_id') . '|';
		
    $fp_hmac_temp = hash_hmac('sha256', $msg, $merchantSecurityWord);
    $fp_hmac = $fp_hmac_temp .''. $msg;
	$orderTotal = (int)$order['subtotal'];
	$orderTotalPost = (int)filter_input(INPUT_POST, 'fp_amnt');
		if (strtoupper(filter_input(INPUT_POST, 'fp_hmac')) == strtoupper($fp_hmac) &&
			$orderTotalPost == $orderTotal &&
			strtoupper(filter_input(INPUT_POST, 'fp_currency')) == strtoupper($order['store_currency_code'])
		   ) {
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$order = $objectManager->create('\Magento\Sales\Model\Order')->load($orderId); 
			$order->setState("processing")->setStatus("processing");
			$order->save();        	
    	} else {
        	return $validate = false;
    	}
	}
}