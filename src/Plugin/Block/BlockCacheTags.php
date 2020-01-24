<?php

namespace Drupal\blockcache_examples\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a Block
 *
 * @Block(
 *   id = "block_cache_tags",
 *   admin_label = @Translation("Block caching with cache tag example"),
 * )
 */
class BlockCacheTags extends BlockBase {
  /**
   * {@inheritdoc}
   */

  public function build() {

  /**
   * For dependencies on data managed by Drupal, like entities & configuration
   */
    $random_number = rand(1,5000);

    // Example 1: node id
    $explanation = '<p>This number does not change until node with certain id (1) is updated:</p>';

    // Example 2: any node
//    $explanation = '<p>This number does not change until any node is updated:</p>';

    // Example 3: Only when nodes of type 'page' are updated
//    $explanation = '<p>This number does not change until nodes of type page are updated:</p>';

    $output = '<span class="badge">'.$random_number.'</span>';

    return array(
      '#markup' => $explanation.' '.$output,
    );
  }

//  /**
//   * Example 1: Individual node
//   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), array('node:68'));
  }

//  /**
//   * Example 2: When any node is updated
//   */
//  public function getCacheTags() {
//    return Cache::mergeTags(parent::getCacheTags(), array('node_list'));
//  }

//  /**
//   * Example 3 (custom): Only when node(s) of type 'page' are updated. See .module file
//   */
//  public function getCacheTags() {
//    return Cache::mergeTags(parent::getCacheTags(), array('blockcache_examples_page_updates'));
//  }

}

