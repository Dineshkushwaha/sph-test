Install the module named test_module and run composer command below for Endroid QR code on root composer.json file.

composer require endroid/qr-code

Alternative option for composer installation

I created composer.json within test_module folder which has endroid/qr-code added as module dependancy and need to update root composer.json file with below details

- Add path for custom module in repositories where url path will be root path of the site.

"repositories": [
        {
            "type": "composer",
            "url": "https://packages.drupal.org/8"
        },
        {
            "type": "path",
            "url": "web/modules/custom/test_module"
        }
    ],

- Update the require array with org/<modulename>

"require": {
        "composer/installers": "^1.9",
        "drupal/core-composer-scaffold": "^9.3",
        "drupal/core-project-message": "^9.3",
        "drupal/core-recommended": "^9.3",
        "drupal/test_module": "1"
    },



visit http://{siteurl}/products-list

this will show list of products.

Click on product title or read more - that will redirect to product details page where there is option to scan QR code.

I tried multiple hostings to upload the code but its not free.

Pantheon has free trial but its for drupal 9 and above. So if you want I can make changes to drupal 8 code to make it compatible to Drupal 9 and upload it to Pantheon.

Thanks