<?php

namespace Drupal\new_test\Controller;


use Symfony\Component\HttpFoundation\Response;

class newTestController {

  public function talk() {
    return new Response('hello');
  }

}