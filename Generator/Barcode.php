<?php
namespace maschit\BarcodeBundle\Generator;

include 'Image/Barcode2.php';

class Barcode 
{    
  /**
   * Image type
   */
  const IMAGE_PNG = 'png';
  const IMAGE_GIF = 'gif';
  const IMAGE_JPEG = 'jpg';

  /**
   * Barcode type
   */
  const BARCODE_CODE39    = 'code39';
  const BARCODE_INT25     = 'int25';
  const BARCODE_EAN13     = 'ean13';
  const BARCODE_UPCA      = 'upca';
  const BARCODE_CODE128   = 'code128';
  const BARCODE_EAN8      = 'ean8';
  const BARCODE_POSTNET   = 'postnet';

  public function writeImage($content, $filename, $code=Barcode::BARCODE_CODE128, $imagetype='detect')
  {
    if($imagetype === 'detect') {
      $ext = substr($filename, strrpos($filename, '.'));
      switch($ext) {
        case '.jpg':
          $imagetype = self::IMAGE_JPEG;
          break;
        case '.gif':
          $imagetype = self::IMAGE_GIF;
          break;
        default:
          $imagetype = self::IMAGE_PNG;
      } 
    }
    $img = \Image_Barcode2::draw($content, $code, $imagetype, false, 100);
    
    switch($imagetype) {
      case self::IMAGE_JPEG:
        imagejpeg($img, $filename);
        break;
      case self::IMAGE_PNG:
        imagepng($img, $filename);
        break;
      case self::IMAGE_GIF:
        imagegif($img, $filename);
        break;
    }
  }
}