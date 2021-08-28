<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Environment $environment
 * @var \Cake\Collection\CollectionInterface|string[] $schools
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Environments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="environments form content">
            <?= $this->Form->create($environment) ?>
            <fieldset>
                <legend><?= __('Add Environment') ?></legend>
                <?php
                    echo $this->Form->control('school_id');
                    echo $this->Form->control('room');
                    echo $this->Form->control('period');
                    echo $this->Form->control('schools._ids', ['options' => $schools]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
