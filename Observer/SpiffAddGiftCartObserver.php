<?php
namespace Spiff\Personalize\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
// use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Cart;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
class SpiffAddGiftCartObserver implements ObserverInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    private $registry;
    private $CollectionFactory;
    /**
     * @var Cart
     */
    private $cart;

    /**
     * BeforeAddToCartObserver constructor.
     * @param ProductRepository $productRepository
     * @param Cart $cart
     */
    public function __construct(
        // ProductRepositoryInterface $productRepository,
        CollectionFactory $CollectionFactory,
        Cart $cart,
        Registry $registry,
   
    ) {
        $this->CollectionFactory = $CollectionFactory;
        $this->cart = $cart;
        $this->registry = $registry;
      
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $product = $observer->getEvent()->getProduct();
        $RedirectProduct = $product->getRedirectProduct();
        $collection =$this->CollectionFactory->create()
        ->addAttributeToSelect('*')
        ->load();
        try { 
            foreach ($collection as $product){
               if($product->getSku() == $RedirectProduct){
                    $this->registry->register('spiff_product', $product); // get Product save in Registry
                    break;
                }
           }  
           
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
             
	   } catch (\Exception $e) {
        
	}
    }
  }
