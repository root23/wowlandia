<?php

namespace App\Orchid\Layouts;

use App\Models\ProductVariant;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\TD;

class ProductVariantListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'product_variants';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', 'Название')
                ->render(function (ProductVariant $product) {
                    return Link::make($product->title)
                        ->route('platform.product-variant.edit', $product);
                }),

            TD::make('created_at', 'Создан'),
            TD::make('updated_at', 'Последнее изменение'),
        ];
    }
}
