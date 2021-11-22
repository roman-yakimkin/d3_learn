<?php

namespace Drupal\d3\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Quadratic equation test form.
 */
class QuadraticEquationForm extends FormBase {

  /**
   * The instance of the quadratic equation service.
   *
   * @var \Drupal\d3\QuadraticEquation
   */
  protected $qa;

  /**
   * The create method.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The container of services.
   *
   * @return \Drupal\d3\Form\QuadraticEquationForm
   *   The instance of the form.
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->qa = $container->get('quadratic_equation');
    return $instance;
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'quadratic_equation_test_form';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['a'] = [
      '#type' => 'textfield',
      '#title' => $this->t('A'),
      '#default_value' => '0',
      '#element_validate' => [
        [$this, 'validateElement'],
      ],
    ];

    $form['b'] = [
      '#type' => 'textfield',
      '#title' => $this->t('B'),
      '#default_value' => '0',
      '#element_validate' => [
        [$this, 'validateElement'],
      ],
    ];

    $form['c'] = [
      '#type' => 'textfield',
      '#title' => $this->t('C'),
      '#default_value' => '0',
      '#element_validate' => [
        [$this, 'validateElement'],
      ],
    ];

    $form['calc'] = [
      '#type' => 'submit',
      '#value' => $this->t('Calculate'),
    ];

    return $form;
  }

  /**
   * Validate an element if it is a numeric.
   *
   * @param array $element
   *   The structure of element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The instance of form state object.
   */
  public function validateElement(array $element, FormStateInterface $form_state) {
    if (!is_numeric($element['#value'])) {
      $form_state->setError($element, $this->t('Element :element must be numeric', [':element' => $element['#title']]));
    }
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $a = $form_state->getValue('a');
    $b = $form_state->getValue('b');
    $c = $form_state->getValue('c');
    $roots = $this->qa->calculate($a, $b, $c)->getRoots();
    if ($roots == INF) {
      $this->messenger()->addMessage($this->t('This equation has infinite roots'));
      return;
    };
    if ($roots == []) {
      $this->messenger()->addMessage($this->t('This equation has no real roots'));
      return;
    }
    $this->messenger()->addMessage($this->t('This equation has root(s): :roots', [':roots' => implode(',', $roots)]));
  }

}
