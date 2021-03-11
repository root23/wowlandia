<?php

namespace App\Orchid\Screens;

use App\Models\ProductType;
use App\Orchid\Layouts\ProductTypesListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ProductTypeListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Тэги';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Все тэги';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'productTypes' => ProductType::paginate()
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
                ->route('platform.product-type.edit')
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
            ProductTypesListLayout::class,
        ];
    }
}
