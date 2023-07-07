# iO Magento 2 Core

This module is used as a core module for iO Magento 2 modules.

## Admin configuration tab
It adds the `Admin > Stores > Configuration > iO` tab in the admin panel.

## Current product/category services
It also contains `CurrentProduct` and `CurrentCategory` services, which can be used instead of the deprecated
`Magento\Framework\Registry` for retrieving and setting the current product or category.
When the registry is removed from Magento the services will be updated and a simple module upgrade will fix the
existing usages.
