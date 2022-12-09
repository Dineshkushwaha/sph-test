<?php

namespace Drupal\product_hooks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'QR' block.
 *
 * @Block(
 *  id = "qr_block",
 *  admin_label = "QR"
 * )
 */
class QrBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  
  public function build() {

    $tools = \Drupal::service('product_hooks.product_hooks_tools');
    $node = \Drupal::routeMatch()->getParameter('node');

    $build = [];

    if($node != null && $node->get('field_product_app_purchase_link') != null){
      $qr = $tools->generateQR($node->get('field_product_app_purchase_link')->getString());

      $build = [
        '#theme' => 'qr_block',
        'data' => [
          'qr' => $qr->getDataUri(),
        ]
      ];
    }
    
    return $build;
  }
  
  /**
  * @return int
  */
  public function getCacheMaxAge() {
    return 0;
  }
}
