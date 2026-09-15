                                                                                        <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
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
                  <?= $this->Form->create($item, [
                      'class' => 'form-horizontal',
                      'id' => 'item-view-form',
                      'onsubmit' => 'return false;',
                  ]) ?>
                  <div class="card shadow" aria-labelledby="item-form-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="item-form-title"><?= __('View Item') ?></strong>
                        <small class="d-block"><?= h($item->name) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-basic-btn" data-bs-toggle="tab" href="#tab-basic" role="tab" aria-controls="tab-basic" aria-current="page" aria-selected="true"><?= __('Basic data') ?></a>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                          <a class="nav-link" id="tab-settings-btn" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false"><?= __('Settings') ?></a>
                        </li>
                      </ul>

                      <?= $this->Action->close($item->id) ?>
                    </div>

                    <div class="card-body form-card-body">
                      <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-btn" tabindex="0">
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
                              <?= $this->Form->label('unit', __('Unit') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('unit', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('price', __('Price') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('price', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('vat', __('Vat') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('vat', ['label' => false, 'type' => 'text', 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
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
                        <?= $this->Action->editButton($item->id) ?>
<?php endif; ?>
<?php if (!empty($show['cancelButton'])) : ?>
                        <?= $this->Action->cancelButton($item->id) ?>
<?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>

<?php if (!empty($show['relatedTables'])) : ?>
                  <div class="card shadow related-card" style="margin-top: 16px;" aria-labelledby="item-related-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="item-related-title"><?= __('Related records') ?></strong>
                        <small class="d-block"><?= h($item->name) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="relatedTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="related-tab-orders-btn" data-bs-toggle="tab" href="#related-tab-orders" role="tab" aria-controls="related-tab-orders" aria-current="page" aria-selected="true"><?= __('Orders') ?></a>
                        </li>
                      </ul>
                    </div>

                    <div class="card-body p-0">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="related-tab-orders" role="tabpanel" aria-labelledby="related-tab-orders-btn" tabindex="0">
                          <div class="table-responsive text-nowrap">
                            <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0">
                              <thead>
                                <tr>
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <th class="integer id-col"><?= __('Id') ?></th>
<?php endif; ?>
                                  <th class="string"><?= __('Customer Id') ?></th>
                                  <th class="string"><?= __('Datetime') ?></th>
                                  <th class="string"><?= __('Date') ?></th>
                                  <th class="string"><?= __('Time') ?></th>
<?php if (!empty($relatedShow['visible'])) : ?>
                                  <th class="boolean"><?= __('Visible') ?></th>
<?php endif; ?>
<?php if (!empty($relatedShow['pos'])) : ?>
                                  <th class="integer pos"><?= __('Pos') ?></th>
<?php endif; ?>
                                  <th class="string"><?= __('Item Count') ?></th>
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
<?php foreach ($item->orders as $order) : ?>
                                <tr data-id="<?= h((string)$order->id) ?>">
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <td class="integer id-col"><?= h((string)$order->id) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($order->customer_id) ?></td>
                                  <td class="string"><?= h($order->datetime) ?></td>
                                  <td class="string"><?= h($order->date) ?></td>
                                  <td class="string"><?= h($order->time) ?></td>
<?php if (!empty($relatedShow['visible'])) : ?>
                                  <td class="boolean visible"><?= $this->Icon->boolean($order->visible) ?></td>
<?php endif; ?>
<?php if (!empty($relatedShow['pos'])) : ?>
                                  <td class="integer pos"><?= $order->pos === null ? '' : h((string)$order->pos) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($order->item_count) ?></td>
<?php if (!empty($relatedShow['created']) || !empty($relatedShow['modified'])) : ?>
                                  <td class="datetime created-modified">
<?php     if (!empty($relatedShow['created'])) : ?>
                                    <span class="created"><?= h($order->created) ?></span>
<?php     endif; ?>
<?php     if (!empty($relatedShow['created']) && !empty($relatedShow['modified'])) : ?>
                                    <br>
<?php     endif; ?>
<?php     if (!empty($relatedShow['modified'])) : ?>
                                    <span class="modified"><?= h($order->modified) ?></span>
<?php     endif; ?>
                                  </td>
<?php endif; ?>
<?php if (!empty($relatedShow['viewButton']) || !empty($relatedShow['editButton']) || !empty($relatedShow['deleteButton'])) : ?>
                                  <td class="action">
                                    <div class="table-data-feature">
<?php         if (!empty($relatedShow['viewButton'])) : ?>
                                      <?= $this->Action->view($order->id, ['controller' => 'Orders']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['editButton'])) : ?>
                                      <?= $this->Action->edit($order->id, ['controller' => 'Orders']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['deleteButton'])) : ?>
                                      <?= $this->Action->delete($order->id, ['controller' => 'Orders']) ?>
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
