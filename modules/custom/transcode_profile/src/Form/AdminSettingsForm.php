<?php

/**
 * @file
 * Contains \Drupal\transcode_profile\Form\AdminSettingsForm.
 */

namespace Drupal\transcode_profile\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityManager;

/**
 * Class AdminSettingsForm.
 *
 * @package Drupal\transcode_profile\Form
 */
class AdminSettingsForm extends ConfigFormBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var Drupal\Core\Entity\EntityManager
   */
  protected $entity_manager;

  public function __construct(ConfigFactoryInterface $config_factory, EntityManager $entity_manager) {
    parent::__construct($config_factory);
    $this->entity_manager = $entity_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'transcode_profile.adminsettings'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'admin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('transcode_profile.adminsettings');
    $transcode_profiles = $this->entity_manager->getStorage('transcode_profile')->loadMultiple();
    $dropdown_array = [];
    foreach ($transcode_profiles as $profile) {
      $key = $profile->id();
      $value = $profile->label();
      $dropdown_array[$key] = $value;
    }
    $form['profile_name'] = array(
      '#type' => 'select',
      '#title' => $this->t('Profile name'),
      '#description' => $this->t('Video transcode profile name'),
      '#default_value' => $config->get('profile_id'),
      '#options' => $dropdown_array
    );
    $form['enable_transcoding'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable transcoding'),
      '#description' => $this->t('Enables video transcoding'),
      '#default_value' => $config->get('enable_transcoding'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('transcode_profile.adminsettings')
      ->set('profile_id', $form_state->getValue('profile_name'))
      ->set('enable_transcoding', $form_state->getValue('enable_transcoding'))
      ->save();
  }

}
