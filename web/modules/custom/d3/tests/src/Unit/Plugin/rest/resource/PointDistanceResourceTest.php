<?php

namespace Drupal\Tests\d3\Unit\Plugin\rest\resource;

use Drupal\Core\Http\RequestStack;
use Drupal\d3\Plugin\rest\resource\PointsDistanceResource;
use Drupal\Tests\UnitTestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test of the PointDistanceResource class.
 *
 * @group d3
 */
class PointDistanceResourceTest extends UnitTestCase {

  /**
   * Provide data for testGet().
   *
   * @return array
   *   Data for testing.
   */
  public function provideTestGet() {
    return [
      [5, 0, 0, 3, 4],
      [5, 2, 2, -1, -2],
    ];
  }

  /**
   * Test of the get method.
   *
   * @dataProvider provideTestGet
   */
  public function testGet($expected, $x1, $y1, $x2, $y2) {
    $query = $this->getMockBuilder(ParameterBag::class)
      ->disableOriginalConstructor()
      ->getMock();

    $query->expects($this->any())
      ->method('has')
      ->withAnyParameters()
      ->willReturn(TRUE);

    $query->expects($this->any())
      ->method('get')
      ->will($this->returnValueMap([
        ['x1', NULL, $x1],
        ['y1', NULL, $y1],
        ['x2', NULL, $x2],
        ['y2', NULL, $y2],
        ['_format', NULL, 'json'],
      ]));

    $request = $this->createMock(Request::class);
    $request->query = $query;

    $request_stack = $this->createMock(RequestStack::class);
    $request_stack->expects($this->any())
      ->method('getCurrentRequest')
      ->willReturn($request);

    $resource = $this->getMockBuilder(PointsDistanceResource::class)
      ->disableOriginalConstructor()
      ->getMock();

    $ref_request = new \ReflectionProperty($resource, 'request');
    $ref_request->setAccessible(TRUE);
    $ref_request->setValue($resource, $request);

    $ref_get = new \ReflectionMethod(PointsDistanceResource::class, 'get');
    $response = $ref_get->invoke($resource);

    $response_data = $response->getResponseData();
    $this->assertEqualsWithDelta((float) $expected, $response_data['distance'], 0.000001);
  }

}
