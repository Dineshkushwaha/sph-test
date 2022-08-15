<?php

namespace Drupal\jugaad_patches_product\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'QR Code' block.
 *
 * @Block(
 *   id = "qrcodeblock",
 *   admin_label = @Translation("QR Code block")
 * )
 */
class QrCodeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
   
    $buildbuild = [];
    // Get the current node
    $node = \Drupal::routeMatch()->getParameter('node');

    // Check if node is valid & belongs to custom content type : Jugaad Patches Store - Product
    if ($node instanceof \Drupal\node\NodeInterface) {

      // Generate the QR Code using Qr Code Generator service with App Purchase Link data
      $qr_code_path = \Drupal::service('jugaad_patches_product.qr_code_generator')->getQrCode($node->field_app_purchase_link->uri);

      $build = [
        '#theme' => 'qr_code_block',
        '#qr_code_path' => $qr_code_path,
      ];
      return $build;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
      return 0;
  }
}
