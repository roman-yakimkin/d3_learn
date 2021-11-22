<?php

namespace Drupal\d3;

/**
 * A service class to solve quadratic equations.
 */
class QuadraticEquation {

  /**
   * Result of the Quadratic equation.
   *
   * @var \Drupal\d3\QuadraticEquationResultInterface
   */
  protected $qeResult;

  /**
   * The class constructor.
   *
   * @param \Drupal\d3\QuadraticEquationResultInterface $qe_result
   *   The instance of Quadratic equation result class.
   */
  public function __construct(QuadraticEquationResultInterface $qe_result) {
    $this->qeResult = $qe_result;
  }

  /**
   * Solve the quadratic equation.
   *
   * @param float $a
   *   The "a" parameter.
   * @param float $b
   *   The "b" parameter.
   * @param float $c
   *   The "c" parameter.
   *
   * @return \Drupal\d3\QuadraticEquationResultInterface
   *   The result of the equation.
   */
  public function calculate(float $a, float $b, float $c) {
    if ($a == 0 && $b == 0) {
      return $this->qeResult->infinityRoots();
    }
    if ($a == 0) {
      return $this->qeResult->realRoots([
        -$c / $b,
      ]);
    }
    $d = $b * $b - 4 * $a * $c;
    if ($d < 0) {
      return $this->qeResult->noRoots();
    }
    if ($d == 0) {
      return $this->qeResult->realRoots([
        -$b / (2 * $a),
      ]);
    }
    return $this->qeResult->realRoots([
      (-$b + sqrt($d)) / (2 * $a),
      (-$b - sqrt($d)) / (2 * $a),
    ]);
  }

}
