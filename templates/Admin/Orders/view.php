                                                                                        <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 * @var \Cake\Collection\CollectionInterface|string[] $customers
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
                  <?= $this->Form->create($order, [
                      'class' => 'form-horizontal',
                      'id' => 'order-view-form',
                      'onsubmit' => 'return false;',
                  ]) ?>
                  <div class="card shadow" aria-labelledby="order-form-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="order-form-title"><?= __('View Order') ?></strong>
                        <small class="d-block"><?= h($order->id) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="formTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-basic-btn" data-bs-toggle="tab" href="#tab-basic" role="tab" aria-controls="tab-basic" aria-current="page" aria-selected="true"><?= __('Basic data') ?></a>
                        </li>
                        <li class="nav-item ms-auto" role="presentation">
                          <a class="nav-link" id="tab-settings-btn" data-bs-toggle="tab" href="#tab-settings" role="tab" aria-controls="tab-settings" aria-selected="false"><?= __('Settings') ?></a>
                        </li>
                      </ul>

                      <?= $this->Action->close($order->id) ?>
                    </div>

                    <div class="card-body form-card-body">
                      <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-btn" tabindex="0">
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('customer_id', __('Customer Id') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <div class="select-with-action">
                                <?= $this->Form->control('customer_id', ['label' => false, 'options' => $customers, 'class' => 'form-select', 'data-tom-select' => true, 'disabled' => true, 'templates' => $containerLess]) ?>
                                <button type="button" class="btn btn-outline-secondary select-with-action__btn" disabled aria-label="<?= h(__('More options')) ?>" data-bs-toggle="tooltip" data-bs-title="<?= h(__('More options')) ?>">
                                  <?= $this->Icon->outline('dots') ?>
                                </button>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('datetime', __('Datetime') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('datetime', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('date', __('Date') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('date', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('time', __('Time') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('time', ['label' => false, 'class' => 'form-control', 'disabled' => true, 'templates' => $containerLess]) ?>
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
                        <?= $this->Action->editButton($order->id) ?>
<?php endif; ?>
<?php if (!empty($show['cancelButton'])) : ?>
                        <?= $this->Action->cancelButton($order->id) ?>
<?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>

<?php if (!empty($show['relatedTables'])) : ?>
                  <div class="card shadow related-card" style="margin-top: 16px;" aria-labelledby="order-related-title">
                    <div class="card-header form-card-header">
                      <div class="form-card-header__title">
                        <strong id="order-related-title"><?= __('Related records') ?></strong>
                        <small class="d-block"><?= h($order->id) ?></small>
                      </div>

                      <ul class="nav nav-tabs card-header-tabs form-card-header__tabs" id="relatedTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="related-tab-items-btn" data-bs-toggle="tab" href="#related-tab-items" role="tab" aria-controls="related-tab-items" aria-current="page" aria-selected="true"><?= __('Items') ?></a>
                        </li>
                      </ul>
                    </div>

                    <div class="card-body p-0">
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="related-tab-items" role="tabpanel" aria-labelledby="related-tab-items-btn" tabindex="0">
                          <div class="table-responsive text-nowrap">
                            <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0">
                              <thead>
                                <tr>
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <th class="integer id-col"><?= __('Id') ?></th>
<?php endif; ?>
                                  <th class="string"><?= __('Name') ?></th>
                                  <th class="string"><?= __('Unit') ?></th>
                                  <th class="string"><?= __('Price') ?></th>
                                  <th class="string"><?= __('Vat') ?></th>
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
<?php foreach ($order->items as $item) : ?>
                                <tr data-id="<?= h((string)$item->id) ?>">
<?php if (!empty($relatedShow['rowId'])) : ?>
                                  <td class="integer id-col"><?= h((string)$item->id) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($item->name) ?></td>
                                  <td class="string"><?= h($item->unit) ?></td>
                                  <td class="string"><?= h($item->price) ?></td>
                                  <td class="string"><?= h($item->vat) ?></td>
<?php if (!empty($relatedShow['visible'])) : ?>
                                  <td class="boolean visible"><?= $this->Icon->boolean($item->visible) ?></td>
<?php endif; ?>
<?php if (!empty($relatedShow['pos'])) : ?>
                                  <td class="integer pos"><?= $item->pos === null ? '' : h((string)$item->pos) ?></td>
<?php endif; ?>
                                  <td class="string"><?= h($item->order_count) ?></td>
<?php if (!empty($relatedShow['created']) || !empty($relatedShow['modified'])) : ?>
                                  <td class="datetime created-modified">
<?php     if (!empty($relatedShow['created'])) : ?>
                                    <span class="created"><?= h($item->created) ?></span>
<?php     endif; ?>
<?php     if (!empty($relatedShow['created']) && !empty($relatedShow['modified'])) : ?>
                                    <br>
<?php     endif; ?>
<?php     if (!empty($relatedShow['modified'])) : ?>
                                    <span class="modified"><?= h($item->modified) ?></span>
<?php     endif; ?>
                                  </td>
<?php endif; ?>
<?php if (!empty($relatedShow['viewButton']) || !empty($relatedShow['editButton']) || !empty($relatedShow['deleteButton'])) : ?>
                                  <td class="action">
                                    <div class="table-data-feature">
<?php         if (!empty($relatedShow['viewButton'])) : ?>
                                      <?= $this->Action->view($item->id, ['controller' => 'Items']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['editButton'])) : ?>
                                      <?= $this->Action->edit($item->id, ['controller' => 'Items']) ?>
<?php         endif; ?>
<?php         if (!empty($relatedShow['deleteButton'])) : ?>
                                      <?= $this->Action->delete($item->id, ['controller' => 'Items']) ?>
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
