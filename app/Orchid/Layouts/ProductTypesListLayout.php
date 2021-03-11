<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;
use App\Models\ProductType;

class ProductTypesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'productTypes';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'id'),

            TD::make('title', 'Имя')
                ->render(function (ProductType $productType) {
                    return Link::make('Перейти')
                        ->route('platform.product-type.edit', $productType);
                }),

            TD::make('created_at', 'Создан'),
            TD::make('updated_at', 'Обновлен'),
        ];
    }
}
