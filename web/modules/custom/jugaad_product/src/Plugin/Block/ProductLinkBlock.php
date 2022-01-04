<?php

namespace Drupal\jugaad_product\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Cache\CacheableMetadata;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Provides a 'Product QR Link' block for all the products.
 *
 * @Block(
 *  id = "jugaad_product_qr_link",
 *  admin_label = @Translation("Product QR Block"),
 * )
 */
class ProductLinkBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The access manager service.
   *
   * @var \\Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $routeMatch;

  /**
   * Size of the QR code.
   *
   * @const integer
   */
  protected const QR_SIZE = 200;

  /**
   * Margin of the QR code.
   *
   * @const integer
   */
  protected const QR_MARGIN = 10;

  /**
   * Class constructor.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    array $plugin_definition,
    CurrentRouteMatch $route_match
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition); 
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $cache = new CacheableMetadata();
    // Get the current node.
    $current_node = $this->routeMatch->getParameter('node');
    // Check if theere is a node.
    if ($current_node) {
      // Render the QR code for the product link.
      $build = [
        'label' => [
           '#plain_text' => $this->t("To purchase this product on our app to avail exclusive app only") 
        ],
        'qr_code' => [
          '#type' => 'inline_template',
          '#template' => "<img src='{{ data }}' />",
          '#context' => [
            'data' => $this->getQRCode($current_node->field_purchase_link->uri),
          ],
        ]
      ];
      // Add cacheable dependency to the current node,
      // it will invalidate the cache if the current node changes.
      $cache->addCacheableDependency($current_node);
      $cache->applyTo($build);
    }
    return $build;
  }

  /**
   * Generate QR code.
   * 
   * Return the generated image blob data.
   */
  private function getQRCode($url) {
    $writer = new PngWriter();
    // Create QR code
    $qrCode = QrCode::create($url)
      ->setEncoding(new Encoding('UTF-8'))
      ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
      ->setSize(static::QR_SIZE)
      ->setMargin(static::QR_MARGIN)
      ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
      ->setForegroundColor(new Color(0, 0, 0))
      ->setBackgroundColor(new Color(255, 255, 255));
    $result = $writer->write($qrCode, null, null);    
    return $result->getDataUri();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(parent::getCacheContexts(), ['route']);
  }

}
