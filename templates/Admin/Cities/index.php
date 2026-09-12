<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\City> $cities
 *
 * Lista — megjelenítési kapcsolók
 * $showRowCheckbox: true = kijelölő oszlop (első cella)
 * $showRowId: true = ID oszlop; false = rejtve (data-id a soron marad)
 * $showVisible: true = Látható (szem) oszlop
 * $showCreated: true = Létrehozva külön oszlop
 * $showModified: true = Módosítva külön oszlop
 * $showCreatedModified: true = Létrehozva + Módosítva egy oszlopban (két sor)
 * $showCounts: true = gyerekrekord-szám oszlopok (*_count mezők, a Látható előtt)
 * $countLabels: opcionális feliratok a *_count mezőkhöz (kulcs = mezőnév)
 */
$showRowCheckbox = true;
$showRowId = true;
$showVisible = true;
$showCreated = false;
$showModified = false;
$showCreatedModified = true;
$showCounts = true;

$countLabels = [
    'club_count' => 'Klubok',
    'user_count' => 'Felhasználók',
];

$countColumns = [];
if ($showCounts) {
    $countColumns = $countLabels;
}

$colCount = 5; // név, shortname, zip, pos, művelet
$colCount += $showRowCheckbox ? 1 : 0;
$colCount += $showRowId ? 1 : 0;
$colCount += count($countColumns);
$colCount += $showVisible ? 1 : 0;
$colCount += $showCreated ? 1 : 0;
$colCount += $showModified ? 1 : 0;
$colCount += $showCreatedModified ? 1 : 0;

$formatDateTime = static function ($value): string {
    if ($value instanceof \Cake\I18n\DateTime) {
        return $value->i18nFormat('yyyy.MM.dd. HH:mm');
    }

    return $value ? (string)$value : '';
};

echo $this->element('JeffAdmin.pagination_templates');
?>
						  <?= $this->Flash->render() ?>
						  <div class="row row-tight" style="margin-top: 16px;">
                            <div class="col-md-12">
                                <div class="card shadow" aria-labelledby="cities-title">
                                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <strong id="cities-title"><?= __('Városok') ?></strong>
                                            <small class="d-block"><?= __('A cities tábla rekordjai.') ?></small>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <?= $this->Html->link(
                                                '<i class="fa-solid fa-plus" aria-hidden="true"></i> ' . __('Új város'),
                                                ['action' => 'add'],
                                                ['class' => 'btn btn-success', 'escape' => false]
                                            ) ?>
                                        </div>
                                    </div>

                                    <div class="card-body p-0 pt-2">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0"<?= $showRowCheckbox ? ' data-table-select' : '' ?>>
                                            <thead>
                                                <tr>
<?php if ($showRowCheckbox) : ?>
                                                    <th class="select-col"><label class="au-checkbox"><input type="checkbox" data-select-all aria-label="<?= __('Összes kijelölése') ?>"><span class="au-checkmark"></span></label></th>
<?php endif; ?>
<?php if ($showRowId) : ?>
                                                    <th class="integer id-col"><?= $this->Paginator->sort('id', 'ID') ?></th>
<?php endif; ?>
                                                    <th class="string"><?= $this->Paginator->sort('name', __('Név')) ?></th>
                                                    <th class="string"><?= $this->Paginator->sort('shortname', __('Rövid név')) ?></th>
                                                    <th class="string"><?= $this->Paginator->sort('zip', __('Irányítószám')) ?></th>
                                                    <th class="integer"><?= $this->Paginator->sort('pos', __('Sorrend')) ?></th>
<?php foreach ($countColumns as $countKey => $countLabel) : ?>
                                                    <th class="count"><?= $this->Paginator->sort($countKey, $countLabel) ?></th>
<?php endforeach; ?>
<?php if ($showVisible) : ?>
                                                    <th class="boolean"><?= $this->Paginator->sort('visible', __('Látható')) ?></th>
<?php endif; ?>
<?php if ($showCreated) : ?>
                                                    <th class="datetime"><?= $this->Paginator->sort('created', __('Létrehozva')) ?></th>
<?php endif; ?>
<?php if ($showModified) : ?>
                                                    <th class="datetime"><?= $this->Paginator->sort('modified', __('Módosítva')) ?></th>
<?php endif; ?>
<?php if ($showCreatedModified) : ?>
                                                    <th class="datetime-meta"><?= $this->Paginator->sort('created', __('Létrehozva')) ?><br><?= $this->Paginator->sort('modified', __('Módosítva')) ?></th>
<?php endif; ?>
                                                    <th class="action text-center pe-3" style="width: 1px;"><?= __('Művelet') ?></th>
                                                </tr>
                                            </thead>
											<tbody class="table-group-divider">
                                                <?php foreach ($cities as $city) :
                                                    $rid = (int)$city->id;
                                                    $name = h($city->name);
                                                    ?>
                                                <tr data-id="<?= $rid ?>" id="row-<?= $rid ?>">
<?php if ($showRowCheckbox) : ?>
                                                    <td class="select-col"><label class="au-checkbox"><input type="checkbox" data-select-row value="<?= $rid ?>" aria-label="<?= __('Sor kijelölése') ?>"><span class="au-checkmark"></span></label></td>
<?php endif; ?>
<?php if ($showRowId) : ?>
                                                    <td class="integer id-col"><?= $rid ?></td>
<?php endif; ?>
                                                    <td class="string"><?= $this->Html->link(
                                                        $name . ' ' . $this->Icon->outline('link-chain', 'record-link__icon'),
                                                        ['action' => 'view', $city->id],
                                                        [
                                                            'class' => 'text-decoration-none text-dark fw-bold record-link',
                                                            'escape' => false,
                                                            'data-bs-toggle' => 'tooltip',
                                                            'title' => __('{0} rekord megtekintése', $city->name),
                                                        ]
                                                    ) ?></td>
                                                    <td class="string"><?= h($city->shortname) ?></td>
                                                    <td class="string"><?= h($city->zip) ?></td>
                                                    <td class="integer"><?= h((string)$city->pos) ?></td>
<?php foreach ($countColumns as $countKey => $countLabel) :
                                                        $countVal = $city->get($countKey) ?? 0;
                                                        $countIsZero = ((float)$countVal) == 0.0;
                                                    ?>
                                                    <td class="count<?= $countIsZero ? ' count--zero' : '' ?>"><?= h((string)$countVal) ?></td>
<?php endforeach; ?>
<?php if ($showVisible) : ?>
                                                    <td class="boolean"><?php if ($city->visible) : ?><i class="fa-regular fa-eye boolean-icon boolean-icon--yes" title="<?= __('Látható') ?>" aria-label="<?= __('Látható') ?>"></i><?php else : ?><i class="fa-regular fa-eye-slash boolean-icon boolean-icon--no" title="<?= __('Nem látható') ?>" aria-label="<?= __('Nem látható') ?>"></i><?php endif; ?></td>
<?php endif; ?>
<?php if ($showCreated) : ?>
                                                    <td class="datetime"><?= h($formatDateTime($city->created)) ?></td>
<?php endif; ?>
<?php if ($showModified) : ?>
                                                    <td class="datetime"><?= h($formatDateTime($city->modified)) ?></td>
<?php endif; ?>
<?php if ($showCreatedModified) : ?>
                                                    <td class="datetime-meta"><?= h($formatDateTime($city->created)) ?><br><?= h($formatDateTime($city->modified)) ?></td>
<?php endif; ?>
                                                    <td class="action text-center pe-3">
                                                        <div class="table-data-feature">
                                                            <?= $this->Html->link(
                                                                '<i class="fa-regular fa-eye"></i>',
                                                                ['action' => 'view', $city->id],
                                                                ['class' => 'item', 'escape' => false, 'data-bs-toggle' => 'tooltip', 'title' => __('Megtekintés')]
                                                            ) ?>
                                                            <?= $this->Html->link(
                                                                '<i class="fa-regular fa-pen-to-square"></i>',
                                                                ['action' => 'edit', $city->id],
                                                                ['class' => 'item', 'escape' => false, 'data-bs-toggle' => 'tooltip', 'title' => __('Szerkesztés')]
                                                            ) ?>
                                                            <?= $this->Form->postLink(
                                                                '<i class="fa-regular fa-trash-can text-danger"></i>',
                                                                ['action' => 'delete', $city->id],
                                                                [
                                                                    'confirm' => __('Biztosan törlöd: {0}?', $city->name),
                                                                    'class' => 'item delete',
                                                                    'escape' => false,
                                                                    'data-bs-toggle' => 'tooltip',
                                                                    'title' => __('Törlés'),
                                                                ]
                                                            ) ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
<?php if (count($cities) === 0) : ?>
                                                <tr>
                                                    <td colspan="<?= $colCount ?>" class="text-center text-muted py-4"><?= __('Nincs megjeleníthető város.') ?></td>
                                                </tr>
<?php endif; ?>
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
