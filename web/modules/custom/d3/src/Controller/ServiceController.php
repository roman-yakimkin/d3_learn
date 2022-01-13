<?php

namespace Drupal\d3\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * A controller to manage services.
 */
class ServiceController extends ControllerBase {

  /**
   * An instance of ExampleServiceFirst service.
   *
   * @var \Drupal\d3\ExampleServiceFirst
   */
  protected $serviceFirst;

  /**
   * An instance of ExampleServiceSecond service.
   *
   * @var \Drupal\d3\ExampleServiceSecond
   */
  protected $serviceSecond;

  /**
   * An instance of ExampleServiceThird service.
   *
   * @var \Drupal\d3\ExampleServiceThird
   */
  protected $serviceThird;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->serviceFirst = $container->get('example_service_first');
    $instance->serviceSecond = $container->get('example_service_second');
    $instance->serviceThird = $container->get('example_service_third');
    return $instance;
  }

  /**
   * Get random message from the ExampleServiceFirst controller.
   *
   * @return array
   *   The render array with a random message.
   */
  public function getMessageFromServiceFirst() {
    return [
      '#markup' => $this->serviceFirst->getRandomMessage(),
    ];
  }

  /**
   * Get values from the ServiceSecond service.
   *
   * @return array
   *   The render array with values.
   */
  public function getMessageFromServiceSecond() {
    return [
      '#markup' => $this->serviceSecond->getValues(),
    ];
  }

  /**
   * Get values from the ServiceSecond service.
   *
   * @return array
   *   The render array with values.
   */
  public function getMessageFromServiceThird() {
    return [
      '#markup' => $this->serviceThird->getValues(),
    ];
  }

}
