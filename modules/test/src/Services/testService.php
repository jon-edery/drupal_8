<?php

namespace Drupal\test\Services;


class testService{
  public function getTest($num) {
    return 'Z'.str_repeat('0' ,$num);
  }

} 