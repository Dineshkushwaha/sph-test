<?php

namespace Drupal\jugaad_patches_product\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Class QrCodeGenerator.
 */
class QrCodeGenerator {

  /**
   * Returns QR code image data.
   *
   * @return QR code image data
   */
  public function getQrCode(string $data) {

    $result = Builder::create()
      ->writer(new PngWriter())
      ->writerOptions([])
      ->data($data)
      ->encoding(new Encoding('UTF-8'))
      ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
      ->size(300)
      ->margin(10)
      ->build();

    return $result->getDataUri();

  }
}
