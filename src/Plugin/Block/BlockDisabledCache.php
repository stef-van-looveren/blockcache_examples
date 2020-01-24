<?php

namespace Drupal\blockcache_examples\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block
 *
 * @Block(
 *   id = "block_disabled_cache",
 *   admin_label = @Translation("Disabled block caching example"),
 * )
 */
class BlockDisabledCache extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {

    /**
     * For time-sensitive caching, i.e. time dependencies
     */

    $random_number = rand(1,5000);

    // Example 1: never cache
    $explanation = '<p>This number will always change and hence is never cached:</p>';

    $output = '<span class="badge">'.$random_number.'</span>';

    return array(
      '#markup' => $explanation.' '.$output,
    );
  }

  // Example 1: never cache this block
  public function getCacheMaxAge() {
    return 0;
    // 60 means 60 seconds
    // PERMANENT means only cleared through cache tags
    // See https://www.drupal.org/docs/8/api/cache-api/cache-max-age
  }

}

