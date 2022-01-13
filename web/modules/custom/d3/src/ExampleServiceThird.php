<?php

namespace Drupal\d3;

/**
 * An example of decorated service.
 */
class ExampleServiceThird extends ExampleServiceSecond {

  /**
   * Get decorated int and string values.
   *
   * @return string
   *   The interval values as a string.
   */
  public function getValues() {
    return '<<<---' . parent::getValues() . '--->>>';
  }

}
