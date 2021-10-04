<?php

namespace Drupal\batch_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements a Batch example Form.
 */
class BatchExampleForm extends FormBase
{
    /**
     * {@inheritdoc}.
     */
    public function getFormId()
    {
        return 'batchexampleform';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['emailids'] = [
            '#type' => 'textarea',
            '#title' => 'Email Ids',
            '#size' => 1000,
            '#description' => $this->t('Enter the line separated email ids'),
            '#required' => true,
        ];

        $form['submit_button'] = [
            '#type' => 'submit',
            '#value' => $this->t('Start Batch'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $emailids = $form_state->getValue('emailids');
        $emails = [];
        $emails = explode("\n", $emailids);

        $batch = [
            'title' => $this->t('Verifying Emails...'),
            'operations' => [],
            'init_message' => $this->t('Commencing'),
            'progress_message' => $this->t('Processed @current out of @total.'),
            'error_message' => $this->t('An error occurred during processing'),
            'finished' => '\Drupal\batch_example\DeleteNode::ExampleFinishedCallback',
        ];
        foreach ($emails as $key => $value) {
            $email = trim($value);
            $batch['operations'][] = ['\Drupal\batch_example\EmailCheck::checkEmailExample', [$email]];
        }

        batch_set($batch);
    }
}
