<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Relation;

class ProductVariantEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Варианты продуктов';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Редактирование';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param ProductVariant $product
     * @return array
     */
    public function query(ProductVariant $product): array
    {
        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = 'Редактирование варианта';
        }

        return [
            'product' => $product,
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
            Button::make('Сохранить')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('product.title')
                    ->title('Title')
                    ->placeholder('Введите название')
                    ->required()
                    ->help('Название товара'),

                Cropper::make('product.cover_image')
                    ->title('Изображение')
                    ->targetRelativeUrl()
                    ->width(750)
                    ->height(250),

                Relation::make('product.product_id')
                    ->title('Товар')
                    ->required()
                    ->fromModel(Product::class, 'title'),

                Group::make([
                    Input::make('product.price')
                        ->title('Стоимость')
                        ->type('number')
                        ->required()
                        ->placeholder('Введите стоимость без скидки')
                        ->help('Полная стоимость'),

                    Input::make('product.sale_price')
                        ->title('Стоимость со скидкой')
                        ->type('number')
                        ->placeholder('Введите стоимость со скидкой')
                        ->help('Стоимость со скидкой'),
                ]),

                Group::make([
                    Select::make('product.color')
                        ->title('Цвет')
                        ->help('Цвет товара')
                        ->options([
                            'black' => 'Черный',
                            'white' => 'Белый',
                        ])
                        ->empty('not_defined'),

                    Select::make('product.size')
                        ->title('Размер')
                        ->help('Размер товара')
                        ->options([
                            's' => 'S',
                            'm' => 'M',
                            'l' => 'L',
                            'xl' => 'XL',
                            'xxl' => 'XXL',
                            '3xl' => '3XL',
                        ])
                        ->empty('not_defined'),

                    Select::make('product.type')
                        ->title('Тип')
                        ->help('Тип товара')
                        ->options([
                            'hoodie' => 'Худи',
                            't-shirt' => 'Футболка',
                        ])
                        ->empty('not_defined'),
                ]),
            ])
        ];
    }

    /**
     * @param ProductVariant $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(ProductVariant $product, Request $request): \Illuminate\Http\RedirectResponse
    {
        $product->fill($request->get('product'))->save();
        Alert::info('Новый товар создан.');

        return redirect()->route('platform.product-variants.list');
    }

    /**
     * @param ProductVariant $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(ProductVariant $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        Alert::info('Товар был успешно удален.');

        return redirect()->route('platform.product-variants.list');
    }
}
