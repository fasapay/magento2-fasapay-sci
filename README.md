## FasaPay SCI Module for Magento 2
---
FasaPay e-Payment module untuk MAGENTO version 2.X.X

### Features
---

### Installation
---
**Manual Download**
1. Download FasaPay SCI Module for Magento 2
2. Copy file to folder magento_project/app/code/

**Composer**
```bash
composer require fasapay/magento2-fasapay-sci
```

**Module Activation**
  **Command Line**
    * Open Terminal
    * Navigate to magento project module
    
```bash
bin/magento module.enable --clear-static-content FasaPay_PaymentSci       
```

 **Manual**
  * Edit file app/etc/config.php
  * In this file every module has value 1 and 0
    - 1 means module is enable
    - 0 means module is disable
  * Edit value module FasaPay_PaymentSci
  
  ```php
    array
    .......
      'FasaPay_PaymentSci' => 1,
      'Magento_CheckoutAgreements' => 1,
      'Magento_Payment' => 1,
      'Magento_SampleData' => 1,
      'Magento_CmsUrlRewrite' => 1,
      'Magento_Config' => 1,
      'Magento_ConfigurableImportExport' => 1,
      'Magento_Downloadable' => 1,
      'Magento_Wishlist' => 1,
    .......
    ),
  ```


### Demo
---
[![button](/docs/demostore.png)](https://magstore.fasapay.id/)

You can find a demo environment [here](https://magstore.fasapay.id/). Please note that it may not be running the latest version of this module at all times.

### Setting Admin Area
---
1. Payment Setting

```
   STORES -> Configuration -> Sales -> Payment Method -> Other Payment Method -> FasaPay
```

![Screenshot of Admin Configuration](/docs/configuration.png)

**Enter your FasaPay Store Setting**
To get your Store Setting, Please Login to FasaPay Member Area, then navigate to


```
  FasaPay Member Area -> Merchant Tools -> Store -> Create Store
```

Please Fill the Required Field :
  + FasaPay Mode (website)
  + FasaPay Account (FP12345 or FI12345)
  + Store Name (The Store name)
  + Security Word

### Checkout Area
---
Example of Checkout Area with FasaPay Payment
![Checkout Page](/docs/payment.jpg)
