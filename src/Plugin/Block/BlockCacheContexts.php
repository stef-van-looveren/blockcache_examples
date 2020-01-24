<?php

namespace Drupal\blockcache_examples\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a Block
 *
 * @Block(
 *   id = "block_cache_contexts",
 *   admin_label = @Translation("Block caching with cache contexts"),
 * )
 */
class BlockCacheContexts extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {

  /**
   * For variations, i.e. dependencies on the request context
   * If you'd like to make this work for anonymous users, disable
   * Internal page cache: https://www.drupal.org/docs/8/api/cache-api/cache-contexts#internal
   */
    $random_number = rand(1,5000);
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    $name = $user->get('name')->getString();

    // Example 1: show the same block everywhere per user
    $explanation = '<p>This shows the user name and the same number accross all pages:</p>';

      // Example 2: show different number per user per page
//    $explanation = '<p>This shows the user name, but different number accross all pages:</p>';

    $random_number = '<span class="badge">'.$random_number.'</span>';
    $output = $name . ' ' . $random_number;

    return array(
      '#markup' => $explanation.' '.$output,
    );
  }

  /**
   * Example 1: per user: show username (but do not change)
   */
  public function getCacheContexts() {
    return ['user'];
  }

//  /**
//   * Example 2: per user: show username (but change number per url)
//   */
//  public function getCacheContexts() {
//    return ['user','url.path'];
//  }

  // https://www.drupal.org/docs/8/api/cache-api/cache-contexts#internal


}

