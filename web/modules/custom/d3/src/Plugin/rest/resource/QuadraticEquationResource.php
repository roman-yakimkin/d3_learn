<?php

namespace Drupal\d3\Plugin\rest\resource;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\rest\ResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provide a REST resource for calculating the Quadratic equation.
 *
 * @RestResource(
 *   id = "quadratic_equation_rest_resource",
 *   label = @Translation("Quadratic equation REST"),
 *   authenticationTypes = {
 *     "cookie"
 *   },
 *   uri_paths = {
 *    "canonical" = "api/v1/qe-rest/calculate"
 *   }
 * )
 */
class QuadraticEquationResource extends ResourceBase {

  /**
   * HTTP request object.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * The service for calculating quadratic equations.
   *
   * @var \Drupal\d3\QuadraticEquation
   */
  protected $qe;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->request = $container->get('request_stack')->getCurrentRequest();
    $instance->qe = $container->get('quadratic_equation');
    return $instance;
  }

  /**
   * Test REST method for returning a simple string response.
   *
   * @return \Drupal\rest\ResourceResponse
   *   Rest response.
   */
  public function get() {
    $cache = CacheableMetadata::createFromRenderArray([
      '#cache' => [
        'max-age' => 0,
      ],
    ]);

    $query = $this->request->query;
    $a = $query->has('a') ? $query->get('a') : 0;
    $b = $query->has('b') ? $query->get('b') : 0;
    $c = $query->has('c') ? $query->get('c') : 0;

    $roots = $this->qe->calculate($a, $b, $c)->getRoots();
    $response = [];
    if ($roots === INF) {
      $response['status'] = 'INF';
    }
    elseif ($roots == []) {
      $response['status'] = 'NO';
    }
    else {
      $response['status'] = 'YES';
      $response['roots'] = $roots;
    }

    return (new ResourceResponse($response, 200))
      ->addCacheableDependency($cache);
  }

}
