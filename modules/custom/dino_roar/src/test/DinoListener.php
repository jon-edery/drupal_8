<?php

namespace Drupal\dino_roar\test;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DinoListener implements EventSubscriberInterface {

  private $channelFactoryInterface;

  public function __construct(LoggerChannelFactoryInterface $channelFactoryInterface) {

  $this->channelFactoryInterface = $channelFactoryInterface;
  }



  public function onKernalReest(GetResponseEvent $event ) {

    $request = $event->getRequest();
    $should_roar = $request->query->get('roar');

    if ($should_roar) {
      $this->channelFactoryInterface->get('default')->debug('test requested roar');
    }



  }
  /**
   * Returns an array of event names this subscriber wants to listen to.
   *
   * The array keys are event names and the value can be:
   *
   *  * The method name to call (priority defaults to 0)
   *  * An array composed of the method name to call and the priority
   *  * An array of arrays composed of the method names to call and respective
   *    priorities, or 0 if unset
   *
   * For instance:
   *
   *  * array('eventName' => 'methodName')
   *  * array('eventName' => array('methodName', $priority))
   *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
   *
   * @return array The event names to listen to
   */
  public static function getSubscribedEvents()
  {
    return [
       KernelEvents::REQUEST =>'onKernalReest',
    ];
  }
}