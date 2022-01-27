<?php

namespace Drupal\d3\Plugin\rest\resource;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * An example of REST-resource for calculation distance between two points.
 *
 * @RestResource(
 *   id = "points_distance_rest_resource",
 *   label = @Translation("Points distance REST"),
 *   uri_paths = {
 *    "canonical" = "api/v1/qe-rest/points-distance"
 *   }
 * )
 */
class PointsDistanceResource extends ResourceBase {

  /**
   * HTTP request object.
   *
   * @var \Symfony\Component\HttpFoundation\Request
   */
  protected $request;

  /**
   * {@inheritDoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->request = $container->get('request_stack')->getCurrentRequest();
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

    $x1 = $query->has('x1') ? $query->get('x1') : 0;
    $y1 = $query->has('y1') ? $query->get('y1') : 0;
    $x2 = $query->has('x2') ? $query->get('x2') : 0;
    $y2 = $query->has('y2') ? $query->get('y2') : 0;

    $width = $x2 - $x1;
    $height = $y2 - $y1;
    $response = [];
    $response['distance'] = sqrt($width * $width + $height * $height);

    return (new ResourceResponse($response, 200))
      ->addCacheableDependency($cache);
  }

}
