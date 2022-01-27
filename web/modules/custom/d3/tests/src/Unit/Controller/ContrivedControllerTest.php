<?php

namespace Drupal\Tests\d3\Unit\Controller;

use Drupal\d3\Controller\ContrivedController;
use Drupal\Tests\UnitTestCase;

/**
 * @group d3
 */
class ContrivedControllerTest extends UnitTestCase {

  /**
   * Data provider for testAdd()
   */
  public function provideTestAdd() {
    return [
      [4, 2, 2],
      [5, 3, 2],
    ];
  }

  /**
   * Test add.
   *
   * @dataProvider provideTestAdd
   */
  public function testAdd($expected, $first, $second) {
    $controller = $this->getMockBuilder(ContrivedController::class)
      ->disableOriginalConstructor()
      ->getMock();
    $ref_add = new \ReflectionMethod($controller, 'add');
    $ref_add->setAccessible(TRUE);
    $this->assertEquals($expected, $ref_add->invokeArgs($controller, [$first, $second]));
  }

  /**
   * Data provider for testHandCount()
   */
  public function provideTestHandCount() {
    return [
      ['It is possible to count it using one hand.', 0, 0],
      ['It is possible to count it using one hand.', 1, 0],
      ['It is possible to count it using one hand.', 0, 1],
      ['I need two hands to count these.', 5, 5],
      ['I need two hands to count these.', 2, 4],
      ['That\'s just too many numbers to count.', 5, 6],
      ['That\'s just too many numbers to count.', 6, 5],
    ];
  }

  /**
   * Test hand count.
   *
   * @dataProvider provideTestHandCount
   */
  public function testHandCount($expected, $first, $second) {
    $mock_translation = $this->getStringTranslationStub();
    $controller = new ContrivedController($mock_translation);
    $ref_hand_count = new \ReflectionMethod($controller, 'handCount');
    $ref_hand_count->setAccessible(TRUE);
    $message = $ref_hand_count->invokeArgs($controller, [$first, $second]);
    $this->assertEquals($expected, (string) $message);
  }

}
