<?php

/**
 * @file
 * Contains \Drupal\transcode_profile\TranscodeProfileInterface.
 */

namespace Drupal\transcode_profile;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Transcode profile entities.
 */
interface TranscodeProfileInterface extends ConfigEntityInterface {
  // Add get/set methods for your configuration properties here.
  public function getCodec();
}
