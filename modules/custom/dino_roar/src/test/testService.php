<?php

namespace Drupal\dino_roar\test;


use Drupal\Core\KeyValueStore\KeyValueFactory;


class testService {

  /**
   * @var \Drupal\Core\KeyValueStore\KeyValueFactoryInterface
   */
  private $keyValueFactory;
  private $useCache;

  public function __construct(KeyValueFactory $keyValueFactory, $useCache) {
    $this->keyValueFactory = $keyValueFactory;
    $this->useCache = $useCache;
  }

  public function get_roar($length) {

    $key = 'roar_store_' . $length;
    $store = $this->keyValueFactory->get('dino');

    if ($this->useCache && $store->has($key)) {
      return $store->get($key);
    }
    sleep(2);
    $roar = 'R' . str_repeat('O', $length) . 'AR';

    if($this->useCache) {
      $store->set($key, $roar);
    }

    return $roar;
  }
}