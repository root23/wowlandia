<?php

namespace App\Orchid\Screens;

use App\Models\Review;
use App\Orchid\Layouts\ReviewListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ReviewListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Отзывы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Все отзывы';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'reviews' => Review::paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Добавить')
                ->icon('pencil')
                ->route('platform.review.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            ReviewListLayout::class
        ];
    }
}
