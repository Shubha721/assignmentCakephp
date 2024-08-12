<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Book'), ['action' => 'edit', $book->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Book'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books view content">
            <h3><?= h($book->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($book->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Cover image') ?></th>
                    <td><?php if (!empty($book->cover_image)): ?>
                    <?php
                    $imageUrl = $this->Url->build('/img/' . $book->cover_image, ['fullBase' => true]);
                    // debug($imageUrl);
                    ?>
                    <?= $this->Html->image($imageUrl, ['alt' => h($book->title), 'class' => 'img-thumbnail', 'width' => '150', 'height' => '180']); ?>
                    <?php else: ?>
                        <?= __('No cover image available') ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Genre') ?></th>
                    <td><?= h($book->genre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Author')?></th>
                    <td><?= h($book->author->author_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published Year') ?></th>
                    <td><?= $book->published_year === null ? '' : $this->Number->format($book->published_year) ?></td>
                </tr>
                
            </table>
        </div>
    </div>
</div>
