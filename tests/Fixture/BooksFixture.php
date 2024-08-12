<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BooksFixture
 */
class BooksFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'published_year' => 1,
                'genre' => 'Lorem ipsum dolor sit amet',
                'cover_image' => 'Lorem ipsum dolor sit amet',
                'author_id' => 1,
            ],
        ];
        parent::init();
    }
}
