<?php
/**
 * Ügyfél felvétele — JeffAdmin form layout + $show kapcsolók.
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 * @var \Cake\Collection\CollectionInterface|string[] $cities
 */

use Cake\Core\Configure;

$show = Configure::read('JeffAdmin');
$showLocal = [];

$showLocal['add'] = [
//    'saveButton'   => false,
//    'cancelButton' => false,
];

$show = array_merge($show['add'] ?? [], $showLocal['add']);
?>
              <div class="row row-tight" style="margin-top: 16px;">
                <div class="col-12 col-xxl-11">
                  <?= $this->Form->create($customer, [
                      'class' => 'form-horizontal',
                  ]) ?>
                  <div class="card shadow" aria-labelledby="customer-form-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="customer-form-title"><?= __('Add Customer') ?></strong>
                        <small class="d-block"><?= __('New customer') ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-basic-btn" data-bs-toggle="tab" href="#tab-basic" role="tab" aria-controls="tab-basic" aria-current="page" aria-selected="true"><?= __('Basic data') ?></a>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                          <a class="nav-link" id="tab-settings-btn" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false"><?= __('Settings') ?></a>
                        </li>
                      </ul>

                      <?= $this->Action->close() ?>
                    </div>

                    <div class="card-body form-card-body">
                      <div class="tab-content">
                        <?= $this->element('Admin/customers_form_fields', compact('customer', 'cities')) ?>
                      </div>
                    </div>

                    <div class="card-footer border-top">
                      <div class="offset-md-2">
<?php if (!empty($show['saveButton'])) : ?>
                        <?= $this->Form->button(
                            $this->Icon->outline('device-floppy') . ' ' . __('Save'),
                            ['type' => 'submit', 'class' => 'btn btn-success', 'escapeTitle' => false]
                        ) ?>
<?php endif; ?>
<?php if (!empty($show['cancelButton'])) : ?>
                        <?= $this->Html->link(
                            $this->Icon->outline('x') . ' ' . __('Cancel'),
                            ['action' => 'index'],
                            ['class' => 'btn btn-secondary', 'escape' => false]
                        ) ?>
<?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>
                </div>
              </div>
