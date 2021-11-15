<?php

namespace Drupal\d3\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Language\LanguageInterface;

/**
 * Controller routines for multilingual features.
 */
class MultilangController extends ControllerBase {

  /**
   * Get list of all the defined languages in the system.
   *
   * @return array
   *   The render array with languages.
   */
  public function getAllLanguages(): array {
    $languages = [];
    foreach ($this->languageManager()::getStandardLanguageList() as $item_id => $item) {
      $languages[] = [
        'id' => $item_id,
        'name' => $item[0] . ' ' . $item[1],
        'direction' => $item[2] ?? 'ltr',
      ];
    }
    return $this->makeLanguagesOutput($languages);
  }

  /**
   * Get list of all the active languages of the site.
   *
   * @return array
   *   The render array with languages.
   */
  public function getSiteLanguages(): array {
    $languages = [];
    foreach ($this->languageManager()->getLanguages() as $lang) {
      $languages[] = [
        'id' => $lang->getId(),
        'name' => $lang->getName(),
        'direction' => $lang->getDirection(),
      ];
    }
    return $this->makeLanguagesOutput($languages);
  }

  /**
   * Get plural number of Russian words.
   *
   * @return array
   *   The render array with words.
   */
  public function getPluralTest(): array {
    $header = [
      $this->t('Nails (tools)'),
      $this->t('Nails (body)'),
      $this->t('Nut bolts'),
    ];
    $rows = [];
    for ($i = 2; $i <= 99; $i++) {
      $rows[] = [
        $this->formatPlural($i, '1 nail', '@count nails', [], ['context' => 'tools']),
        $this->formatPlural($i, '1 nail', '@count nails', [], ['context' => 'human body']),
        $this->formatPlural($i, '1 nut bolt', '@count nut bolts'),
      ];
    }
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  /**
   * Make the output table for languages.
   *
   * @param array $languages
   *   The languages list.
   *
   * @return array
   *   The render array with languages.
   */
  protected function makeLanguagesOutput(array $languages): array {
    $header = [
      $this->t('ID'),
      $this->t('Name'),
      $this->t('Direction'),
    ];
    $rows = [];
    foreach ($languages as $language) {
      $rows[] = [
        $language['id'],
        $language['name'],
        $language['direction'],
      ];
    }
    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

}
