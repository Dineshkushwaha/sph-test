<?php

namespace Drupal\ws\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'QR code' block.
 *
 * @Block(
 *   id = "qr_code",
 *   admin_label = @Translation("QR code block")
 * )
 */
class QrBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof \Drupal\node\NodeInterface && $node->bundle() == 'product') {
      $qr_path = \Drupal::service('ws.qr_generator')->getQrData($node->field_app_purchase_link->uri);

      $build['qr_content'] = [
        '#theme' => 'ws_qr',
        '#qr_path' => $qr_path,
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
