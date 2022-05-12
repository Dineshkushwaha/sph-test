<?php

namespace Drupal\ws;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/**
 * Class GenerateQR.
 */
class GenerateQR {

  /**
   * Returns calculated QR image data.
   *
   * @return QR image data
   */
  public function getQrData(string $qr_content) {

    $result = Builder::create()
      ->writer(new PngWriter())
      ->writerOptions([])
      ->data($qr_content)
      ->encoding(new Encoding('UTF-8'))
      ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
      ->size(300)
      ->margin(10)
      ->build();

    return $result->getDataUri();

  }
}
