<?php
/**
 * Lista — megjelenítési kapcsolók ($show, plugin config + helyi felülírás)
 * rowCheckbox, rowId, visible, pos, created, modified, counts,
 * viewButton, editButton, deleteButton, rowDblClick
 *
 * rowDblClick: 'edit' | 'view' | 'none' (más / üres local = globális; egyéb = none)
 *
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 * @var string|null $lastRecordId  utoljára view/edit/add rekord id
 * @var int|null $lastRecordPage
 */

use Cake\Core\Configure;
use Cake\Utility\Inflector;

$show = Configure::read('JeffAdmin');
$showLocal = [];

$showLocal['index'] = [
//    'rowCheckbox'     => false,
//    'rowId'           => false,
//    'visible'         => false,
//    'pos'             => false,
    'created'           => false,
//    'modified'        => false,
//    'counts'          => false,
//    'viewButton'      => false,
//    'editButton'      => false,
//    'deleteButton'    => false,
//    'rowDblClick'     => 'view',   // 'edit' | 'view' | 'none'
];

$show = array_merge($show['index'] ?? [], $showLocal['index']);

$rowDblClick = $show['rowDblClick'] ?? 'edit';
if (!in_array($rowDblClick, ['edit', 'view'], true)) {
    $rowDblClick = 'none';
}

$listPage = max(1, (int)$this->request->getQuery('page', 1));


$countColumns = [];
if (!empty($show['counts'])) {
    foreach ($customers as $customer) {
        foreach (array_keys($customer->toArray()) as $field) {
            if (str_ends_with($field, '_count')) {
                $countColumns[$field] = Inflector::humanize(substr($field, 0, -6)) . ' count';
            }
        }
        break;
    }
}

$tableAttrs = '';
if (!empty($show['rowCheckbox'])) {
    $tableAttrs .= ' data-table-select';
}
if ($rowDblClick !== 'none') {
    $tableAttrs .= ' data-row-dblclick="' . h($rowDblClick) . '"';
}
?>
              <div class="row row-tight" style="margin-top: 16px;">
                <div class="col-md-12">
                  <div class="card shadow" aria-labelledby="customers-title">
                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                      <div>
                        <strong id="customers-title"><?= __('Customers') ?></strong>
                        <small class="d-block"><?= __('All customers') ?></small>
                      </div>
                      <div class="table-data__tool-right">
                        <?= $this->Html->link(
                            $this->Icon->outline('plus') . ' ' . __('Add new customer'),
                            ['action' => 'add'],
                            ['class' => 'btn btn-success', 'escape' => false]
                        ) ?>
                      </div>
                    </div>

                    <div class="card-body p-0 pt-2">
                      <div class="table-responsive text-nowrap">
                        <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0"<?= $tableAttrs ?>>
                          <thead>
                            <tr>
<?php if (!empty($show['rowCheckbox'])) : ?>
                              <th class="select-col">
                                <label class="au-checkbox">
                                  <input type="checkbox" data-select-all aria-label="<?= h(__('Select all')) ?>">
                                  <span class="au-checkmark"></span>
                                </label>
                              </th>
<?php endif; ?>
<?php if (!empty($show['rowId'])) : ?>
                              <th class="integer id-col"><?= $this->Paginator->sort('id') ?></th>
<?php endif; ?>
                              <th class="string"><?= $this->Paginator->sort('city_id', __('City')) ?></th>
                              <th class="string"><?= $this->Paginator->sort('name') ?></th>
                              <th class="string"><?= $this->Paginator->sort('address') ?></th>
                              <th class="string"><?= $this->Paginator->sort('phone') ?></th>
<?php if (!empty($show['counts'])) : ?>
<?php     foreach ($countColumns as $countKey => $countLabel) : ?>
                              <th class="count"><?= $this->Paginator->sort($countKey, $countLabel) ?></th>
<?php     endforeach; ?>
<?php endif; ?>
<?php if (!empty($show['visible'])) : ?>
                              <th class="boolean"><?= $this->Paginator->sort('visible') ?></th>
<?php endif; ?>
<?php if (!empty($show['pos'])) : ?>
                              <th class="integer pos"><?= $this->Paginator->sort('pos') ?></th>
<?php endif; ?>
<?php if (!empty($show['created']) || !empty($show['modified'])) : ?>
                              <th class="datetime-meta">
<?php     if (!empty($show['created'])) : ?>
                                <?= $this->Paginator->sort('created') ?>
<?php     endif; ?>
<?php     if (!empty($show['created']) && !empty($show['modified'])) : ?>
                                <br>
<?php     endif; ?>
<?php     if (!empty($show['modified'])) : ?>
                                <?= $this->Paginator->sort('modified') ?>
<?php     endif; ?>
                              </th>
<?php endif; ?>
<?php if (!empty($show['viewButton']) || !empty($show['editButton']) || !empty($show['deleteButton'])) : ?>
                              <th class="action"><?= __('Actions') ?></th>
<?php endif; ?>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
<?php foreach ($customers as $customer) :
    $dblClickUrl = $rowDblClick === 'none'
        ? null
        : $this->Url->build([
            'action' => $rowDblClick,
            $customer->id,
            '?' => ['listPage' => $listPage],
        ]);
    $rowClass = (isset($lastRecordId) && (string)$lastRecordId === (string)$customer->id)
        ? ' is-last-touched'
        : '';
    $rowAttrs = ' data-id="' . h((string)$customer->id) . '"'
        . ' id="row-' . h((string)$customer->id) . '"';
    if ($dblClickUrl) {
        $rowAttrs .= ' data-dblclick-url="' . h($dblClickUrl) . '"';
    }
    if ($rowClass !== '') {
        $rowAttrs .= ' class="' . trim($rowClass) . '"';
    }
?>
                            <tr<?= $rowAttrs ?>>
<?php if (!empty($show['rowCheckbox'])) : ?>
                              <td class="select-col">
                                <label class="au-checkbox">
                                  <input type="checkbox" data-select-row value="<?= h((string)$customer->id) ?>" aria-label="<?= h(__('Select row')) ?>">
                                  <span class="au-checkmark"></span>
                                </label>
                              </td>
<?php endif; ?>
<?php if (!empty($show['rowId'])) : ?>
                              <td class="integer id-col"><?= h((string)$customer->id) ?></td>
<?php endif; ?>
                              <td class="string">
                                <?= $customer->hasValue('city')
                                    ? $this->Html->link(
                                        $customer->city->name,
                                        ['controller' => 'Cities', 'action' => 'view', $customer->city->id],
                                        ['class' => 'text-decoration-none text-dark fw-bold record-link']
                                    )
                                    : '' ?>
                              </td>
                              <td class="string"><?= h($customer->name) ?></td>
                              <td class="string"><?= h($customer->address) ?></td>
                              <td class="string"><?= h($customer->phone) ?></td>
<?php if (!empty($show['counts'])) : ?>
<?php     foreach ($countColumns as $countKey => $countLabel) :
        $countVal = $customer->get($countKey) ?? 0;
        $countIsZero = ((float)$countVal) == 0.0;
?>
                              <td class="count<?= $countIsZero ? ' count--zero' : '' ?>"><?= h((string)$countVal) ?></td>
<?php     endforeach; ?>
<?php endif; ?>
<?php if (!empty($show['visible'])) : ?>
                              <td class="boolean visible"><?= $this->Icon->visible($customer->visible) ?></td>
<?php endif; ?>
<?php if (!empty($show['pos'])) : ?>
                              <td class="integer pos"><?= $customer->pos === null ? '' : h((string)$customer->pos) ?></td>
<?php endif; ?>
<?php if (!empty($show['created']) || !empty($show['modified'])) : ?>
                              <td class="datetime created-modified">
<?php     if (!empty($show['created'])) : ?>
                                <span class="created"><?= h($customer->created) ?></span>
<?php     endif; ?>
<?php     if (!empty($show['created']) && !empty($show['modified'])) : ?>
                                <br>
<?php     endif; ?>
<?php     if (!empty($show['modified'])) : ?>
                                <span class="modified"><?= h($customer->modified) ?></span>
<?php     endif; ?>
                              </td>
<?php endif; ?>
<?php if (!empty($show['viewButton']) || !empty($show['editButton']) || !empty($show['deleteButton'])) : ?>
                              <td class="action">
                                <div class="table-data-feature">
<?php     if (!empty($show['viewButton'])) : ?>
                                  <?= $this->Action->view($customer->id) ?>
<?php     endif; ?>
<?php     if (!empty($show['editButton'])) : ?>
                                  <?= $this->Action->edit($customer->id) ?>
<?php     endif; ?>
<?php     if (!empty($show['deleteButton'])) : ?>
                                  <?= $this->Action->delete($customer->id) ?>
<?php     endif; ?>
                                </div>
                              </td>
<?php endif; ?>
                            </tr>
<?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="card-footer border-top d-flex align-items-center justify-content-between">
                      <?= $this->element('JeffAdmin.pagination') ?>
                    </div>
                  </div>
                </div>
              </div>
