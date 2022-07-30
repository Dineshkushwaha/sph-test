<?php

namespace Drupal\my_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Drupal\Core\Cache\Cache;  

/**
 * Provides a block with a QR code.
 *
 * @Block(
 *   id = "qr_code_placement_block",
 *   admin_label = @Translation("QR code placement block"),
 * )
 */
class QRCodePlacement extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    global $base_url;

    $node = \Drupal::routeMatch()->getParameter('node');
    $node_data = \Drupal\node\Entity\Node::load($node->id());
    $uri = $node_data->field_app_purchase_link->uri;
   
    $module_get_handler = \Drupal::service('module_handler');
    $module_get_path = $module_get_handler->getModule('my_module')->getPath();
    
    $writer = new PngWriter();

    // Create QR code
    $qrCode = QrCode::create($uri)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(300)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
    $logo = Logo::create($base_url.'/'.$module_get_path.'/assets/images/qrimage2.png')
        ->setResizeToWidth(50);

    // Create generic label
    $label = Label::create('To purchase this product on your app to avail exclusive app-only');

    $result = $writer->write($qrCode, $logo, $label);

    $dataUri = $result->getDataUri();
    
    return array(
        '#type' => 'inline_template',
        '#template' => '<img src="'.$dataUri.'" width="200" height="200" alt="cdcdc">',
      );
  }

  public function getCacheTags() {
  //With this when your node change your block will rebuild
    if ($node = \Drupal::routeMatch()->getParameter('node')) {
    //if there is node add its cachetag
      return Cache::mergeTags(parent::getCacheTags(), array('node:' . $node->id()));
    } else {
      //Return default tags instead.
      return parent::getCacheTags();
    }
  }

  public function getCacheContexts() {
    //if you depends on \Drupal::routeMatch()
    //you must set context of this block with 'route' context tag.
    //Every new route this block will rebuild
    return Cache::mergeContexts(parent::getCacheContexts(), array('route'));
  }


}
