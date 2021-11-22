<?php

namespace Drupal\d3;

/**
 * The interface for quadratic equation result.
 */
interface QuadraticEquationResultInterface {

  /**
   * Equation has infinity roots.
   *
   * @return \Drupal\d3\QuadraticEquationResultInterface
   *   The instance of the class.
   */
  public function infinityRoots(): QuadraticEquationResultInterface;

  /**
   * Equation has real roots.
   *
   * @param array $roots
   *   Array of real roots.
   *
   * @return \Drupal\d3\QuadraticEquationResultInterface
   *   The instance of the class.
   */
  public function realRoots(array $roots): QuadraticEquationResultInterface;

  /**
   * Equation has no real roots.
   *
   * @return \Drupal\d3\QuadraticEquationResultInterface
   *   The instance of the class.
   */
  public function noRoots(): QuadraticEquationResultInterface;

  /**
   * Roots of equation or the infinity constant.
   *
   * @return array
   *   Array of roots or the infinity constant.
   */
  public function getRoots();

}
