## FasaPay E-Payent Gateway
---
FasaPay e-Payment module untuk MAGENTO version 2.X.X
### PROSES INSTALASI
---
[![button](/doc/demostore.png)](https://magstore.fasapay.id/)

1. Download module FasaPay ePayment
2. Copy file kedalam folder Peojek_Magento_anda/app/code/
3. Selanjutnya aktifkan module

> **Comand Line**
>> Buka terminal
<br /> Masuk kedalam folder projek magento anda
<br /> <pre>
        bin/magento module:enable --clear-static-content FasaPaymentSci_Fasapay
    </pre>

> **Manual**
>> Edit file app/etc/config.php
<br /> Pada file ini setiap module memiliki value 1 dan 0 
    <br />- 1 artinya module enable
    <br />- 0 artinya module disable
<br /> Edit value module FasaPaymentSci_Fasapay menjadi 1
>> <pre> 
        array 
        .......
            'FasaPaymentSci_Fasapay' => 1,
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
    </pre>

### SETTING ADMIN AREA
---
1. Pengaturan pembayaran 
```
   STORES -> Configuration -> Sales -> PaymentMethod -> Other Payment Method -> Fasapay
```
<kbd> <img src="/doc/Screenshot.png" width="700px"/></kbd><br />
**Masukan Data Store Account FasaPay**<br />
Untuk mendapatkan data store account silahkan anda masuk member area FasaPay kemudian pilih menu store.
```
    Stores -> Configuration -> Sales -> Payment Method -> Other Payment Method ->  Fasapay
```
Isi field dibawah : <br />
  + Fasapay Mode
  + Fasapay Id
  + Store Name
  + Scurity Key

### CHECKOUT AREA
---
Contoh halaman checkout dengan opsi pembayaran faspaay e-payment gateway<br />
<kbd> <img src="/doc/payment.jpg" width="700px"/></kbd><br />
