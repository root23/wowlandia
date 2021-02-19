<?php

namespace App\Orchid\Layouts;

use App\Models\Review;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ReviewListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reviews';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', 'Автор')
                ->render(function (Review $review) {
                    return Link::make($review->title)
                        ->route('platform.review.edit', $review);
                }),

            TD::make('rating', 'Оценка'),

            TD::make('created_at', 'Добавлен'),
            TD::make('updated_at', 'Последнее изменение'),
        ];
    }
}
