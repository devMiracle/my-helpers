<?php

namespace chuks\php\helpers;
/**
 * Description of SiteURL
 *
 * @author pixie3
 */
class URL {

  private static $baseUrl;
  private static $urlPath = array();

  static function base_url($urlArrayKey) {
    $baseUrl = self::getBaseUrl();
    $urlArray = self::getUrlPath();
    $mainBaseUrl = "";
    if (array_key_exists($urlArrayKey, $urlArray)) {
      $mainBaseUrl = $baseUrl . $urlArray[$urlArrayKey];
    } else {
      $mainBaseUrl = $urlArrayKey . " Is Not A Valid URL VALUE. Please check your array key";
    }
    return $mainBaseUrl;
  }

  static function addUrlPath($urlArray = array()) {
    foreach ($urlArray as $key => $value) {
      self::$urlPath[$key] = $value;
    }
  }
  
  static function redirect($url){
    return header("location: ".$url);
  }

  static function getUrlPath() {
    return self::$urlPath;
  }

  static function setUrlPath($urlPath) {
    self::$urlPath = $urlPath;
  }

  static function getBaseUrl() {
    return self::$baseUrl;
  }

  static function setBaseUrl($baseUrl) {
    self::$baseUrl = $baseUrl;
  }


}
