<?php

namespace Drupal\d3\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for songwriters.
 *
 * @MigrateSource(
 *   id = "d3_songwriter",
 * )
 */
class Songwriter extends SqlBase {

  /**
   * {@inheritDoc}
   */
  public function query() {
    return $this
      ->select('d3_migrate_songwriters', 'sw')
      ->fields('sw', [
        'sw_name',
      ]);
  }

  /**
   * {@inheritDoc}
   */
  public function fields() {
    return [
      'sw_name' => $this->t('Songwriter name'),
    ];
  }

  /**
   * {@inheritDoc}
   */
  public function getIds() {
    return [
      'sw_name' => [
        'type' => 'varchar',
        'alias' => 'sw',
      ],
    ];
  }

}
