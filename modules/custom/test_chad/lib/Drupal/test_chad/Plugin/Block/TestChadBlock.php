<?php


namespace Drupal\test_chad\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;


/**
 * @Block(
 *   id = "test_chad_block",
 *   admin_label = @Translation("Test Chad block"),
 *   category = @Translation("Custom Blocks")
 * )
 */
class TestChadBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return TRUE;
  }


  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'hello world'
    );
  }
}