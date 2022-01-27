<?php

namespace Drupal\d3\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * An example of controller for creating tests.
 */
class ContrivedController extends ControllerBase {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->stringTranslation = $container->get('string_translation');
    return $instance;
  }

  /**
   * Construct a new controller.
   */
  public function __construct(TranslationInterface $translation) {
    $this->setStringTranslation($translation);
  }

  /**
   * A controller method which displays a sum in terms of hands.
   */
  public function displayAddedNumbers($first, $second) {
    return [
      '#markup' => '<p>' . $this->handCount($first, $second) . '</p>',
    ];
  }

  /**
   * Generate a message based on how many hands are needed to count the sum.
   */
  protected function handCount($first, $second) {
    $sum = abs($this->add((int) $first, (int) $second));
    if ($sum <= 5) {
      $message = $this->t('It is possible to count it using one hand.');
    }
    elseif ($sum <= 10) {
      $message = $this->t('I need two hands to count these.');
    }
    else {
      $message = $this->t("That's just too many numbers to count.");
    }

    return $message;
  }

  /**
   * Add two numbers.
   */
  private function add($first, $second) {
    return $first + $second;
  }

}
