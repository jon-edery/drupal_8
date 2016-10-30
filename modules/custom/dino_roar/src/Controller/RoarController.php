<?php

namespace Drupal\dino_roar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Drupal\dino_roar\test\testService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

Class RoarController extends ControllerBase {

  private $roarGenerator;

  private $loggerFactory;


  public function  __construct(testService $roarGenerator, LoggerChannelFactoryInterface $loggerFactory ) {

    $this->roarGenerator = $roarGenerator;
    $this->loggerFactory = $loggerFactory;
  }

  public function roar($count) {

    $roar = $this->roarGenerator->get_roar($count);

    //Using the service logger factory to log the response from the roarGenerator service.
    $this->loggerFactory->get('default')->debug($roar);

    return [
      '#title' => $roar ];
  }

  public static function create(ContainerInterface $container) {

    $roarGenerator = $container->get('dinor_roar_service_generator');
    $loggerFactory = $container->get('logger.factory');

    return new static($roarGenerator, $loggerFactory);
  }

}