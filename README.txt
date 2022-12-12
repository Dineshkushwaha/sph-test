# How to use productswithqr module.

- Git clone module under "web/modules/custom"
refer command "git clone https://github.com/pankajraundal/productswithqr.git"
- Enable module using command
refer command "drush en productswithqr"

## Manual step to install modules dependency
    - Add below snippet under root composer.json refer https://sicse.dev/blog/use-composerjson-file-custom-module-install-dependent-vendor-packages

    {
        "type": "path",
        "url": "web/modules/custom/*"
    }
    - run composer require command to add module as dependency in composer.json
    - refer command "composer require drupal/productswithqr:@dev"
    - Clear cache, you should now good to go.

## What it does by its own
    - It will creat content type products
    - It will create custom block for qr code.
    - Qr code Custom block will get auto placed on each products detail page. 

## Demo site details
    - URL: https://dev-proqr.pantheonsite.io/
    - Creds: admin/admin

