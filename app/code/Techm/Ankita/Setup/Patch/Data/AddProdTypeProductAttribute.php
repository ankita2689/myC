<?php

namespace Techm\Ankita\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Techm\Ankita\Model\Product\Attribute\Source\ProdType;

class AddProdTypeProductAttribute implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
	
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
		LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
		$this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
		try {
			$this->moduleDataSetup->getConnection()->startSetup();
			/** @var EavSetup $eavSetup */
			$eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
			$eavSetup->addAttribute(
				Product::ENTITY,
				'prod_type',
				[
					'type' => 'int',
					'label' => 'Product Type',
					'input' => 'select',
					'source' => ProdType::class,
					'frontend' => '',
					'required' => false,
					'backend' => '',
					'sort_order' => '30',
					'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
					'default' => null,
					'visible' => true,
					'user_defined' => true,
					'searchable' => false,
					'filterable' => false,
					'comparable' => false,
					'visible_on_front' => true,
					'unique' => false,
					'apply_to' => '',
					'group' => 'General',
					'used_in_product_listing' => false,
					'is_used_in_grid' => true,
					'is_visible_in_grid' => false,
					'is_filterable_in_grid' => false,
					'option' => ''
				]
			);

			$this->moduleDataSetup->getConnection()->endSetup();
		} catch (LocalizedException $e) {
			$this->logger->critical($e->getMessage());
		}
    }
    
    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(Product::ENTITY, 'prod_type');
        $this->moduleDataSetup->getConnection()->endSetup();
    }
	
	/**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
        
        ];
    }

    
}

