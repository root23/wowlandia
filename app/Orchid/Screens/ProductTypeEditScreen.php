<?php

namespace App\Orchid\Screens;

use App\Models\ProductType;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Support\Facades\Layout;

class ProductTypeEditScreen extends Screen
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
    public $description = 'Редактирование тэгов';

    /**
     * If type exists
     *
     * @var bool
     */
    public $exists =  false;

    /**
     * Query data.
     *a
     * @param ProductType $productType
     * @return array
     */
    public function query(ProductType $productType): array
    {
        $this->exists = $productType->exists;

        if ($this->exists) {
            $this->name = 'Редактирование товара';
        }

        return [
            'productType' => $productType,
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
                Input::make('productType.title')
                    ->title('Название')
                    ->placeholder('Введите имя тэга')
                    ->help('Имя тэга'),
                CheckBox::make('productType.is_active')
                    ->value(1)
                    ->title('Отображать в меню')
                    ->placeholder('Отображать в меню')
                    ->help('Отображение в меню на сайте')
                    ->sendTrueOrFalse(),
            ]),
        ];
    }

    /**
     * @param ProductType $productType
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(ProductType $productType, Request $request) {
        $productType->fill($request->get('productType'))->save();

        Alert::info('Новый тэг добавлен.');

        return redirect()->route('platform.product-types.list');
    }

    /**
     * @param ProductType $productType
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(ProductType $productType) {
        $productType->delete();

        Alert::info('Тэг был успешно удален.');

        return redirect()->route('platform.product-types.list');
    }
}
