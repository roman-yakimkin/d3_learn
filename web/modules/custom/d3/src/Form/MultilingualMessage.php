<?php

namespace Drupal\d3\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * A class for saving multilingual messages.
 */
class MultilingualMessage extends ConfigFormBase {

  /**
   * The name of the config object.
   *
   * @var string
   */
  protected $configName = 'd3.multilingual_message';

  /**
   * {@inheritDoc}
   */
  protected function getEditableConfigNames() {
    return ['d3.multilingual_message'];
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'd3_multilingual_message_settings';
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Send a mailing of not?'),
      '#default_value' => $this->config($this->configName)->get('type'),
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('E-mail address'),
      '#default_value' => $this->config($this->configName)->get('email'),
    ];

    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#default_value' => $this->config($this->configName)->get('subject'),
    ];

    $form['frequency'] = [
      '#type' => 'select',
      '#title' => $this->t('Frequency of mails'),
      '#default_value' => $this->config($this->configName)->get('frequency'),
      '#options' => $this->getFrequencyOptions(),
    ];

    $form['mailings'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Mailing lists'),
      '#default_value' => $this->config($this->configName)->get('mailings'),
      '#options' => $this->getMailings(),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Gets the frequency list for form options.
   *
   * @return array
   *   An associative array with frequencies.
   */
  protected function getFrequencyOptions() {
    return [
      'day' => $this->t('Once a day'),
      'week' => $this->t('Once a week'),
      'two_weeks' => $this->t('Once a two weeks'),
      'month' => $this->t('Once a month'),
    ];
  }

  /**
   * Gets the mailings list for form options.
   *
   * @return array
   *   An associative array with mailings.
   */
  protected function getMailings() {
    return [
      'mail_general' => $this->t('The mail mailing'),
      'mail_advanced' => $this->t('The advanced mailing'),
      'mail_1' => $this->t('First mailing'),
      'mail_2' => $this->t('Second mailing'),
      'mail_3' => $this->t('Third mailing'),
      'mail_4' => $this->t('Fourth mailing'),
      'mail_5' => $this->t('Fifth mailing'),
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config($this->configName)
      ->set('type', $form_state->getValue('type'))
      ->set('email', $form_state->getValue('email'))
      ->set('subject', $form_state->getValue('subject'))
      ->set('frequency', $form_state->getValue('frequency'))
      ->set('mailings', $form_state->getValue('mailings'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
