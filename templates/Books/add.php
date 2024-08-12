<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var \Cake\Collection\CollectionInterface|string[] $authors
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Book') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('published_year');
                    echo $this->Form->control('genre');
                    echo $this->Form->control('author_id', ['options' => $authors, 'empty' => true]);
                    echo $this->Form->control('cover_image', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
