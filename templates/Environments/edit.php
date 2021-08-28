<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Environment $environment
 * @var string[]|\Cake\Collection\CollectionInterface $schools
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $environment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $environment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Environments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="environments form content">
            <?= $this->Form->create($environment) ?>
            <fieldset>
                <legend><?= __('Edit Environment') ?></legend>
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
