                                                                                                            <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */

use Cake\Core\Configure;

$show = Configure::read('JeffAdmin');
$showLocal = [];

$showLocal['view'] = [
//    'editButton'      => false,
//    'cancelButton'    => false,
//    'relatedTables'   => false,
//    'posStep'         => 5,   // pos spinner lépés (alap: 10)
];

$show = array_merge($show['view'] ?? [], $showLocal['view']);
$relatedShow = array_merge(Configure::read('JeffAdmin.index') ?? [], []);
$containerLess = ['inputContainer' => '{{content}}'];
?>
              <div class="row row-tight" style="margin-top: 16px;">
                <div class="col-12 col-xxl-11">
                  <?= $this->Form->create($city, [
                      'class' => 'form-horizontal',
                      'id' => 'city-view-form',
                      'onsubmit' => 'return false;',
                  ]) ?>
                  <div class="card shadow" aria-labelledby="city-form-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="city-form-title"><?= __('View City') ?></strong>
                        <small class="d-block"><?= h($city->name) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-basic-btn" data-bs-toggle="tab" href="#tab-basic" role="tab" aria-controls="tab-basic" aria-current="page" aria-selected="true"><?= __('Basic data') ?></a>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                          <a class="nav-link" id="tab-settings-btn" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false"><?= __('Settings') ?></a>
                        </li>
                      </ul>

                      <?= $this->Action->close($city->id) ?>
                    </div>

                    <div class="card-body form-card-body">
                      <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-btn" tabindex="0">
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('shortname', __('Shortname') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('shortname', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('name', __('Name') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('name', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('zip', __('Zip') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('zip', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('lat', __('Lat') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('lat', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('lng', __('Lng') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('lng', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="tab-settings-btn" tabindex="0">
                          <section class="form-section">
                            <h5 class="form-section__title"><?= __('Record settings') ?></h5>
                            <div class="row mb-3 align-items-center">
                              <div class="col-12 col-md-2 text-start text-md-end">
                                <?= $this->Form->label('visible', __('Visible') . ':', ['class' => 'form-control-label fw-bold mb-0']) ?>
                              </div>
                              <div class="col-12 col-md-9 d-flex align-items-center flex-wrap pt-1">
                                <div class="form-check form-check-inline mb-0">
                                  <?= $this->Form->checkbox('visible', ['class' => 'form-check-input', 'id' => 'visible', 'disabled' => true]) ?>
                                  <?= $this->Form->label('visible', __('Visible'), ['class' => 'form-check-label']) ?>
                                </div>
                              </div>
                            </div>
                            <?php
                            $posStep = max(1, (int)($show['posStep'] ?? 10));
                            ?>
                            <div class="row mb-3">
                              <div class="col-12 col-md-2 text-start text-md-end">
                                <?= $this->Form->label('pos', __('Pos') . ':', ['class' => 'form-control-label fw-bold']) ?>
                              </div>
                              <div class="col-12 col-md-9">
                                <?= $this->Form->control('pos', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'data-number-spinner' => true, 'data-integer' => '1', 'inputmode' => 'numeric', 'min' => '0', 'step' => (string)$posStep, 'autocomplete' => 'off', 'placeholder' => '0', 'disabled' => true, 'templates' => $containerLess]) ?>
                              </div>
                            </div>
                          </section>
                        </div>

                      </div>
                    </div>

                    <div class="card-footer border-top">
                      <div class="offset-md-2">
<?php if (!empty($show['editButton'])) : ?>
                        <?= $this->Action->editButton($city->id) ?>
<?php endif; ?>
<?php if (!empty($show['cancelButton'])) : ?>
                        <?= $this->Action->cancelButton($city->id) ?>
<?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>

<?php if (!empty($show['relatedTables'])) : ?>
                  <div class="card shadow related-card" style="margin-top: 16px;" aria-labelledby="city-related-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="city-related-title"><?= __('Related records') ?></strong>
                        <small class="d-block"><?= h($city->name) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="relatedTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="related-tab-customers-btn" data-bs-toggle="tab" href="#related-tab-customers" role="tab" aria-controls="related-tab-customers" aria-current="page" aria-selected="true"><?= __('Customers') ?></a>
                        </li>
                      </ul>
                    </div>

                    <div class="card-body p-0">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="related-tab-customers" role="tabpanel" aria-labelledby="related-tab-customers-btn" tabindex="0">
                          <div class="table-responsive text-nowrap">
                            <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0">
                              <thead>
                                <tr>
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <th class="integer id-col"><?= __('Id') ?></th>
<?php endif; ?>
                                  <th class="string"><?= __('Name') ?></th>
                                  <th class="string"><?= __('Address') ?></th>
                                  <th class="string"><?= __('Phone') ?></th>
<?php if (!empty($relatedShow['visible'])) : ?>
                                  <th class="boolean"><?= __('Visible') ?></th>
<?php endif; ?>
<?php if (!empty($relatedShow['pos'])) : ?>
                                  <th class="integer pos"><?= __('Pos') ?></th>
<?php endif; ?>
                                  <th class="string"><?= __('Order Count') ?></th>
<?php if (!empty($relatedShow['created']) || !empty($relatedShow['modified'])) : ?>
                                  <th class="datetime-meta">
<?php     if (!empty($relatedShow['created'])) : ?>
                                    <?= __('Created') ?>
<?php     endif; ?>
<?php     if (!empty($relatedShow['created']) && !empty($relatedShow['modified'])) : ?>
                                    <br>
<?php     endif; ?>
<?php     if (!empty($relatedShow['modified'])) : ?>
                                    <?= __('Modified') ?>
<?php     endif; ?>
                                  </th>
<?php endif; ?>
<?php if (!empty($relatedShow['viewButton']) || !empty($relatedShow['editButton']) || !empty($relatedShow['deleteButton'])) : ?>
                                  <th class="action"><?= __('Actions') ?></th>
<?php endif; ?>
                                </tr>
                              </thead>
                              <tbody class="table-group-divider">
<?php foreach ($city->customers as $customer) : ?>
                                <tr data-id="<?= h((string)$customer->id) ?>">
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <td class="integer id-col"><?= h((string)$customer->id) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($customer->name) ?></td>
                                  <td class="string"><?= h($customer->address) ?></td>
                                  <td class="string"><?= h($customer->phone) ?></td>
<?php if (!empty($relatedShow['visible'])) : ?>
                                  <td class="boolean visible"><?= $this->Icon->boolean($customer->visible) ?></td>
<?php endif; ?>
<?php if (!empty($relatedShow['pos'])) : ?>
                                  <td class="integer pos"><?= $customer->pos === null ? '' : h((string)$customer->pos) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($customer->order_count) ?></td>
<?php if (!empty($relatedShow['created']) || !empty($relatedShow['modified'])) : ?>
                                  <td class="datetime created-modified">
<?php     if (!empty($relatedShow['created'])) : ?>
                                    <span class="created"><?= h($customer->created) ?></span>
<?php     endif; ?>
<?php     if (!empty($relatedShow['created']) && !empty($relatedShow['modified'])) : ?>
                                    <br>
<?php     endif; ?>
<?php     if (!empty($relatedShow['modified'])) : ?>
                                    <span class="modified"><?= h($customer->modified) ?></span>
<?php     endif; ?>
                                  </td>
<?php endif; ?>
<?php if (!empty($relatedShow['viewButton']) || !empty($relatedShow['editButton']) || !empty($relatedShow['deleteButton'])) : ?>
                                  <td class="action">
                                    <div class="table-data-feature">
<?php         if (!empty($relatedShow['viewButton'])) : ?>
                                      <?= $this->Action->view($customer->id, ['controller' => 'Customers']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['editButton'])) : ?>
                                      <?= $this->Action->edit($customer->id, ['controller' => 'Customers']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['deleteButton'])) : ?>
                                      <?= $this->Action->delete($customer->id, ['controller' => 'Customers']) ?>
<?php         endif; ?>
                                    </div>
                                  </td>
<?php endif; ?>
                                </tr>
<?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
<?php endif; ?>
                </div>
              </div>
