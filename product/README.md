#Install:
> Install in like any other module [link](https://www.drupal.org/docs/8/extending-drupal-8/installing-drupal-8-modules).

#CONFIGURATION:
> Add merge-plugin to root file composer.json
>
> "require": {
"wikimedia/composer-merge-plugin": "^2.0"
}
>
> "merge-plugin": {
"include": [
>
> 'modules/custom/*/composer.json'
>
> ],
"recurse": true
}
>
> run "composer update"


> Got to */product/list* to add new product.

>The Infomation of dev site
>
>https://dev-sph-test.pantheonsite.io/
>
> user/pass: jugaad / geaB8v8nkBv8YPy
>
>https://dev-sph-test.pantheonsite.io/product/list
>
>Pull Request: https://github.com/Dineshkushwaha/sph-test/pull/2
>
