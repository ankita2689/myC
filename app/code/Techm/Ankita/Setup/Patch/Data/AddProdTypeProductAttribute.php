<?php
namespace Techm\Ankita\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Psr\Log\LoggerInterface;

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
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
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
				\Magento\Catalog\Model\Product::ENTITY,
				'prod_type',
				[
					'type' => 'int',
					'label' => 'product type',
					'input' => 'select',
					'source' => \Techm\Ankita\Model\Product\Attribute\Source\ProdType::class,
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
		} catch (\Exception $e) {
			$this->logger->critical($e);
		}
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'prod_type');

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    
}

