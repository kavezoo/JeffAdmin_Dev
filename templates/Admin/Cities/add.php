<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cities form content">
            <?= $this->Form->create($city) ?>
            <fieldset>
                <legend><?= __('Add City') ?></legend>
                <?php
                    echo $this->Form->control('shortname');
                    echo $this->Form->control('name');
                    echo $this->Form->control('zip');
                    echo $this->Form->control('lat');
                    echo $this->Form->control('lng');
                    echo $this->Form->control('club_count');
                    echo $this->Form->control('user_count');
                    echo $this->Form->control('visible');
                    echo $this->Form->control('pos');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
