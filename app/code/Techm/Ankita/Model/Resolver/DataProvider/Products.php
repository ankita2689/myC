<?php
namespace Techm\Ankita\Model\Resolver\DataProvider;

class Products extends \Magento\Framework\View\Element\Template
{

    protected $_productRepository;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        array $data = []
        )
    {
        $this->_productRepository = $productRepository;
        parent::__construct($context, $data);
    }
	
	/**
     * @params string $sku
     * this function return all the product attribute prod_type by product sku
     **/
	 public function getAttributesBySku($sku){
        $_product = $this->_productRepository->get($sku);
        $attributes = $_product->getAttributes();// All Product Attributes
 
        $attributes_data = [];
        $x=0;
        foreach ($attributes as $attribute) {
            if($attribute->getIsUserDefined()){ // Removed the system product attribute by checking the current attribute is user created
                $attributeLabel = $attribute->getFrontend()->getLabel();
                $attributeValue = $attribute->getFrontend()->getValue($_product);
 
                if($attribute->getAttributeCode()=="prod_type"){
                    $attributeLabelAndValue = $attributeLabel." - ".$attributeValue;
                    $attributes_data[$x]['atr_data'] = $attributeLabelAndValue;
                }
            }
            $x++;
        }
        return $attributes_data;
    }
}

