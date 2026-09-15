<?php
/**
 * Customer űrlap mezők — JeffAdmin horizontális layout.
 *
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 * @var \Cake\Collection\CollectionInterface|string[] $cities
 * @var bool $disabled View módban true: mezők disabled-ek, a kinézet ugyanaz.
 */

$disabled = !empty($disabled);
$containerLess = ['inputContainer' => '{{content}}'];
$lock = function (array $options) use ($disabled): array {
    if ($disabled) {
        $options['disabled'] = true;
    }

    return $options;
};
?>
                        <div class="tab-pane fade show active" id="tab-basic" role="tabpanel" aria-labelledby="tab-basic-btn" tabindex="0">
                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('city_id', __('City') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <div class="select-with-action">
                                <?= $this->Form->control('city_id', $lock(['label' => false, 'options' => $cities, 'empty' => __('Please select'), 'class' => 'form-select', 'data-tom-select' => true, 'templates' => $containerLess])) ?>
                                <button type="button" class="btn btn-outline-secondary select-with-action__btn"<?= $disabled ? ' disabled' : '' ?> aria-label="<?= h(__('More options')) ?>" data-bs-toggle="tooltip" data-bs-title="<?= h(__('More options')) ?>">
                                  <?= $this->Icon->outline('dots') ?>
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('name', __('Name') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('name', $lock(['label' => false, 'class' => 'form-control', 'autofocus' => !$disabled, 'templates' => $containerLess])) ?>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('address', __('Address') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('address', $lock(['label' => false, 'class' => 'form-control', 'templates' => $containerLess])) ?>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-md-2 text-start text-md-end">
                              <?= $this->Form->label('phone', __('Phone') . ':', ['class' => 'form-control-label fw-bold']) ?>
                            </div>
                            <div class="col-12 col-md-9">
                              <?= $this->Form->control('phone', $lock(['label' => false, 'class' => 'form-control', 'templates' => $containerLess])) ?>
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
                                  <?= $this->Form->checkbox('visible', $lock(['class' => 'form-check-input', 'id' => 'visible'])) ?>
                                  <?= $this->Form->label('visible', __('Visible'), ['class' => 'form-check-label']) ?>
                                </div>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-12 col-md-2 text-start text-md-end">
                                <?= $this->Form->label('pos', __('Pos') . ':', ['class' => 'form-control-label fw-bold']) ?>
                              </div>
                              <div class="col-12 col-md-9">
                                <?= $this->Form->control('pos', $lock(['label' => false, 'type' => 'text', 'class' => 'form-control', 'data-number-spinner' => true, 'data-integer' => '1', 'inputmode' => 'numeric', 'min' => '0', 'step' => '10', 'autocomplete' => 'off', 'placeholder' => '0', 'templates' => $containerLess])) ?>
                              </div>
                            </div>
                          </section>
                        </div>
