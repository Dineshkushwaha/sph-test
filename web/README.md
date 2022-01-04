The installation is straight forward. Please clone this repo and run the below commands.

1. composer install
2. drush site:install

These 2 steps are enough to install the site. Once it is installed please enable the custom module 'jugaad_product' which does the job!

I setup a demo in the following domain,
https://codetest.praveenpb.com/
username: admin
password: Password@123

I want to bring your attention for few points:
- We can create a custom profile and run '$ drush site:install custom_profile' which helps to enable our custom module automatically.
- I enabled the product QR block only for bartiq theme so created the config file /optional/block.block.productqrblock.yml. If we need to enable it for the active theme or the new theme which installs(we may use hook hook_themes_installed for that) then we can set this custom block programatically to the region of the theme.
