<?php

namespace Spiff\Personalize\Setup;

use Magento\Framework\Setup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class UpgradeData implements Setup\UpgradeDataInterface 
{
    /**
     * Eav setup factory
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */

    public function upgrade(
        Setup\ModuleDataSetupInterface $setup,
        Setup\ModuleContextInterface $moduleContext
    ) {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'use_spiff_price',
            [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Use Spiff Price',
                'input' => 'boolean',
                'source' =>  \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'frontend' => '',
                'backend' => '',
                'required' => false,
                'sort_order' => 70,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'visible' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true
            ]
        );
        $setup->endSetup();
    }
}