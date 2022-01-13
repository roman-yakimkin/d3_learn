<?php

namespace Drupal\d3;

/**
 * A simple example service.
 */
class ExampleServiceFirst {

  /**
   * An array of private messages.
   *
   * @var array
   */
  private $messages;

  /**
   * The constructor of the object.
   */
  public function __construct() {
    $this->messages = [
      'First message',
      'Second message',
      'Third message',
      'Fourth message',
      'Fifth message',
      'Sixth message',
    ];
  }

  /**
   * Return a random message.
   *
   * @return mixed|string
   *   The random message.
   */
  public function getRandomMessage() {
    $index = rand(0, count($this->messages) - 1);
    return $this->messages[$index];
  }

}
