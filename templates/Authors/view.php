<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author $author
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Author'), ['action' => 'edit', $author->author_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Author'), ['action' => 'delete', $author->author_id], ['confirm' => __('Are you sure you want to delete # {0}?', $author->author_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Authors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Author'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="authors view content">
            <h3><?= h($author->author_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Author Id') ?></th>
                    <td><?= $this->Number->format($author->author_id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Author Name') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($author->author_name)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
