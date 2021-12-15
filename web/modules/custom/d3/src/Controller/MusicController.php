<?php

namespace Drupal\d3\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for watch music info migrated from CSV.
 */
class MusicController extends ControllerBase {

  /**
   * Show list of songs.
   *
   * @return array
   *   The rendered array with songs.
   */
  public function getAllSongs() {
    return [
      '#markup' => $this->t('All songs'),
    ];
  }

  /**
   * Show list of albums with songs.
   *
   * @return array
   *   The rendered array with albums.
   */
  public function getAllAlbums() {
    return [
      '#markup' => $this->t('All albums'),
    ];
  }

  /**
   * Detail information about one album.
   *
   * @param int $id
   *   The identifier of the album.
   *
   * @return array
   *   The rendered array with information about the album.
   */
  public function getAlbumById(int $id) {
    return [
      '#markup' => $this->t('Album by @id', ['@id' => $id]),
    ];
  }

}
