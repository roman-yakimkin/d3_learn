<?php

namespace Drupal\d3;

/**
 * The result of the quadratic equation.
 */
class QuadraticEquationResult implements QuadraticEquationResultInterface {

  /**
   * Indicator if infinity of roots.
   *
   * @var bool
   */
  protected $isInfinityRoots = FALSE;

  /**
   * Array of real roots.
   *
   * @var array
   */
  protected $roots = [];

  /**
   * Equation has infinity roots.
   *
   * @return \Drupal\d3\QuadraticEquationResultInterface
   *   The instance of the class.
   */
  public function infinityRoots(): QuadraticEquationResultInterface {
    $this->isInfinityRoots = TRUE;
    $this->roots = [];
    return $this;
  }

  /**
   * Equation has real roots.
   *
   * @param array $roots
   *   Array of real roots.
   *
   * @return static
   *   The instance of the class.
   */
  public function realRoots(array $roots): QuadraticEquationResultInterface {
    $this->isInfinityRoots = FALSE;
    $this->roots = $roots;
    return $this;
  }

  /**
   * Equation has no real roots.
   *
   * @return static
   *   The instance of the class.
   */
  public function noRoots(): QuadraticEquationResultInterface {
    $this->isInfinityRoots = FALSE;
    $this->roots = [];
    return $this;
  }

  /**
   * Roots of equation or the infinity constant.
   *
   * @return array
   *   Array of roots or the infinity constant.
   */
  public function getRoots() {
    return $this->isInfinityRoots ? INF : $this->roots;
  }

}
