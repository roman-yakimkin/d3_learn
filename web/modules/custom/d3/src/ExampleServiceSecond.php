<?php

namespace Drupal\d3;

/**
 * An example of advanced service.
 */
class ExampleServiceSecond {

  /**
   * A simple integer value.
   *
   * @var int
   */
  protected $intValue;

  /**
   * A simple string value.
   *
   * @var string
   */
  protected $stringValue;

  /**
   * Constructor of the object.
   *
   * @param int $int_value
   *   Integer internal value.
   * @param string $string_value
   *   String internal value.
   */
  public function __construct(int $int_value, string $string_value) {
    $this->intValue = $int_value;
    $this->stringValue = $string_value;
  }

  /**
   * Update int and string values.
   */
  public function updateValues() {
    $this->stringValue = strtoupper($this->stringValue);
    $this->intValue = $this->intValue * $this->intValue;
  }

  /**
   * Get int and string values.
   *
   * @return string
   *   The interval values as a string.
   */
  public function getValues() {
    return "Int value is: {$this->intValue}, String value is: {$this->stringValue}";
  }

}
