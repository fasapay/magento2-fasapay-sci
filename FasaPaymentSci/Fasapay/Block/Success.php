<?php
namespace FasaPaymentSci\Fasapay\Block;
class Success  extends \Magento\Framework\View\Element\Template
{
    protected $_catalogSession;
    protected $_customerSession;
    protected $_checkoutSession;
        
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
	public function getChangeStatusPayment()
    {
		    $orderId = $this->_checkoutSession->getLastOrderId();
			$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
			$order = $objectManager->create('\Magento\Sales\Model\Order')->load($orderId); 
			$order->setState("pending")->setStatus("pending");
			$order->save();
    }
    public function getOrder()
	{
   		$orderId = $this->_checkoutSession->getLastOrderId();
   		$order   = $this->_salesFactory->load($orderId);
   		return $order->getData(); 
	}  
	public function getFasaMethod()
	{
   		$orderId = $this->_checkoutSession->getLastOrderId();
   		$order   = $this->_salesFactory->load($orderId);
   		return $order->getPayment()->getMethodInstance()->getCode();
	}
	public function getCheckoutSession() 
    {
        return $this->_checkoutSession;
    } 
	public function getPaymentMethodFasa(){
		return $this->_checkoutSession->getQuote()->getPayment()->getMethod();
	}
	
	public function getFasaId(){
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
		return $this->_encryptor->decrypt($this->_scopeConfig->getValue("payment/fasapaymethod/id_member", $storeScope));
	}
	public function getStoreName(){
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
		return $this->_encryptor->decrypt($this->_scopeConfig->getValue("payment/fasapaymethod/store_name", $storeScope));
	}
	public function getScurity(){
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
		return $this->_encryptor->decrypt($this->_scopeConfig->getValue("payment/fasapaymethod/scurity_key", $storeScope));
	}
	public function getMode(){		
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
		return $this->_scopeConfig->getValue("payment/fasapaymethod/fasa_mode", $storeScope);
	}
	
}