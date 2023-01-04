<?php

namespace Drupal\drupal_products\Plugin\Block;


use Drupal\Core\Block\BlockBase;


/**
* Provides a block with a simple text.
*
* @Block(
*   id = "qr_drupal_block",
*   admin_label = @Translation("QR drupal block"),
*   category = "custom"
* )
*/
class QrDrupalBlock extends BlockBase {

 /**
  * {@inheritdoc}
  */
 public function build() {
    $url = '';
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface) {
      if($node->hasField('field_app_purchase_link') && !$node->get('field_app_purchase_link')->isEmpty()){
        $url = $node->get('field_app_purchase_link')->getValue()[0]['uri'];
      }
     
    }
    $contents['url'] = $url;
    return [
      '#markup' => 'QR',
      '#theme' => 'qr_code_block',
      '#contents' => $contents,
      '#attached' => [
        'library' => [
          'drupal_products/product_qr',
        ],
      ],
    ];
  }

}