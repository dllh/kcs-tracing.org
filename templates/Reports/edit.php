<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 * @var string[]|\Cake\Collection\CollectionInterface $schools
 * @var string[]|\Cake\Collection\CollectionInterface $environments
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $report->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reports form content">
            <?= $this->Form->create($report) ?>
            <fieldset>
                <legend><?= __('Edit Report') ?></legend>
                <?php
                    echo $this->Form->control('school_id', ['options' => $schools]);
                    echo $this->Form->control('environment_id', ['options' => $environments]);
                    echo $this->Form->control('positive_test_date');
                    echo $this->Form->control('guid');
                    echo $this->Form->control('zipcode');
                    echo $this->Form->control('optional_email');
                    echo $this->Form->control('optional_phone');
                    echo $this->Form->control('ip_address');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
