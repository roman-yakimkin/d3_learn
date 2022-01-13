<?php

namespace Drupal\d3;

/**
 * Another example of decorated service.
 */
class ExampleServiceFourth extends ExampleServiceSecond {

  /**
   * Get decorated int and string values.
   *
   * @return string
   *   The interval values as a string.
   */
  public function getValues() {
    return '(fourth)--' . parent::getValues() . '--(fourth)';
  }

}
