<?php

namespace App\Orchid\Screens;

use App\Models\ProductVariant;
use App\Orchid\Layouts\ProductVariantListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductVariantListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Вариант товара';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Все варианты';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'product_variants' => ProductVariant::paginate()
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
                ->route('platform.product-variant.edit')
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
            ProductVariantListLayout::class
        ];
    }
}
