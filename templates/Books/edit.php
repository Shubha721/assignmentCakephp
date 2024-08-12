<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var string[]|\Cake\Collection\CollectionInterface $authors
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $book->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Book') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('published_year');
                    echo $this->Form->control('genre');
                    echo $this->Form->control('author_id', ['options' => $authors, 'empty' => true]);
                   // echo $this->Form->control('cover_image', ['type' => 'file', 'alt' => 'Current Cover Image', $book->cover_image]);
                    echo $this->Form->image('cover_image', ['type' => 'file',  $book->cover_image, 'alt' => 'Current Cover Image', 'style' => 'max-width: 200px;']);

                //    echo $this->Form->control('cover_image', [
                //     'type' => 'file', 
                //     'label' => 'Cover Image (optional)',
                //     'required' => false
                //    ]);

                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
