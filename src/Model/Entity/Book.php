<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $title
 * @property int|null $published_year
 * @property string|null $genre
 * @property string|resource|null $cover_image
 * @property int|null $author_id
 *
 * @property \App\Model\Entity\Author $author
 */
class Book extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'title' => true,
        'published_year' => true,
        'genre' => true,
        'cover_image' => true,
        'author_id' => true,
        'author' => true,
    ];
}
