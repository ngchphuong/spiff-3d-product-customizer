<?php
namespace Spiff\Personalize\Helper;

use Magento\Framework\Registry;
use Magento\Framework\App\Helper\AbstractHelper;
class ProductHelper extends AbstractHelper
{
    private $registry;
    public function __construct(
        Registry $registry,
    ) {
        $this->registry = $registry;
    }
  public function getProductCollection(){
     return $this->registry->registry('spiff_product');
  }
}
