<?php

namespace Drupal\productswithqr\Service;

use chillerlan\QRCode\QRCode;

/**
 * Provides a 'QR Code' for requested link or string.
 */
class QrCodeGenerater {

  /**
   * Qr generater function user chillerplan library.
   *
   * @param string $url
   *   URL to conver into qr code.
   */
  public function qrGeneraterChillerlan(string $url) {
    $qrcode = (new QRCode)->render($url);
    return $qrcode;
  }

}
