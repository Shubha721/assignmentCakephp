<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Book> $books
 */
?>


<div class="books index content">
    <?= $this->Html->link(__('New Book'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Books') ?></h3>
    
    <?= $this->Form->create(null, ['type' => 'get']) ?>
    <fieldset>
        <legend><?= __('Search') ?></legend>
        <?= $this->Form->control('title', ['label' => 'Title', 'value' => $searchTitle, 'class'=>'form-control',  'style' => 'width:250px']),
         $this->Form->control('author', ['label' => 'Author', 'value' => $searchAuthor, 'class'=>'form-control',  'style' => 'width:250px']) ?>
        <?= $this->Form->button(__('Search')) ?>
        <?= $this->Html->link(__('Clear'), ['action' => 'index'], ['class' => 'button']) ?>
    </fieldset>
    <?= $this->Form->end() ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('published_year') ?></th>
                    <th><?= $this->Paginator->sort('genre') ?></th>
                    <th><?= $this->Paginator->sort('author_name') ?></th>
                    <th><?= $this->Paginator->sort('cover_image') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= $this->Number->format($book->id) ?></td>
                    <td><?= h($book->title) ?></td>
                    <td><?= h($book->published_year ?: 'N/A') ?></td>
                    <td><?= h($book->genre) ?></td>
                    <td><?= h($book->author->author_name) ?></td>
                    
                    <td>
                        <?php if (!empty($book->cover_image)): ?>
                        <?php
                        $imageUrl = $this->Url->build('/img/' . $book->cover_image, ['fullBase' => true]);
                        // debug($imageUrl);
                        ?>
                        <?= $this->Html->image($imageUrl, ['alt' => h($book->title), 'class' => 'img-thumbnail', 'width' => '150', 'height' => '180']); ?>
                        <?php else: ?>
                            <?= __('No cover image available') ?>
                            <?php endif; ?>
                    </td>

                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $book->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $book->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $book->id], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>









