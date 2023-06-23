<?php

namespace App\Http\Controllers;

use App\Models\Bouquet;
use App\Models\Color;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    private static $current_sort_method;
    private static function get_filters() {
        $category_items = ['Моно букети', 'Мікс букети', 'Весільні букети'];
        $type_items = Type::select('type')->get()->map(function ($type) {return $type->type;})->toArray();
        $price_items = ['До 1000 грн', '1000-2000 грн', '2000-5000 грн', 'Від 5000'];
        $material_items = ['Плівка', 'Папір', 'Сітка'];
        $size_items = ['Малий', 'Середній', 'Великий'];
        $color_items = Color::select('color')->get()->map(function ($type) {return $type->color;})->toArray();

        return [
            ['name' => 'category', 'label' => 'Категорії', 'items' => $category_items],
            ['name' => 'type', 'label' => 'Тип квітів', 'items' => $type_items],
            ['name' => 'price', 'label' => 'Ціна', 'items' => $price_items],
            ['name' => 'material', 'label' => 'Матеріал', 'items' => $material_items],
            ['name' => 'size', 'label' => 'Розмір', 'items' => $size_items],
            ['name' => 'color', 'label' => 'Колір', 'items' => $color_items],
        ];
    }

    private function get_sorting_parameters() {
        return [
            'Від дешевих до дорогих' => [['column' => 'price', 'direction' => 'ASC']],
            'Від дорогих до дешевих' => [['column' => 'price', 'direction' => 'DESC']],
            'Новинки' => [['column' => 'updated_at', 'direction' => 'DESC']],
            'За релевантністю' => [['column' => 'best_offer', 'direction' => 'DESC'], ['column' => 'updated_at', 'direction' => 'DESC']]
        ];
    }

    private static function get_prices() {
        return ['До 1000 грн' => [0, 1000], '1000-2000 грн' => [1000, 2000], '2000-5000 грн' => [2000, 5000], 'Від 5000' => [5000, 50000]];
    }

    public function show() {
        $filters = self::get_filters();
        $main_label = "Всі букети";
        $group = [];

        if (isset(request()->toArray()['sort_method'])) {
            self::$current_sort_method = request()->toArray()['sort_method'];
        }

        if (!isset(request()->toArray()['filter'])){
            $bouquets = $this->get_bouquets_without_filters();
            $current_filter = [];
        }
        else {
            $query = request()->toArray()['filter'];
            if (isset($query['category']) or isset($query['material']) or isset($query['size'])) {
                $bouquets = $this->get_bouquets_with_defined_filters($query);
                if (isset($query['category'])) {
                    $main_label = $query['category'];
                    $group = ['category' => $main_label];
                }
            }

            elseif (isset($query['type']) or isset($query['color'])) {
                $bouquets = $this->get_bouquets_with_undefined_filters($query);
                if (isset($query['type'])) {
                    $main_label = $query['type'];
                    $group = ['type' => $main_label];
                }
            }

            elseif (isset($query['price'])) {
                $bouquets = $this->get_bouquets_with_price_filter($query);
            }

            foreach ($filters as $number => $filter) {
                foreach ($filter['items'] as $item_number => $value)
                    if ($value == array_values($query)[0]) {
                        $current_filter = [$filter['name'] => $filters[$number]['items'][$item_number]];
                        $filters[$number]['items'][$item_number] = [$filters[$number]['items'][$item_number], 'underline'];
                    }
            }
        }
//        if (count($bouquets) <= 6) {
//            $set_more_button = false;
//        } else {
//            $set_more_button = true;
//        }
//        $bouquets = $bouquets->take(6);
        session()->put('filter', $group);
        $sorting_keys = array_keys($this->get_sorting_parameters());
        $current_sort_method = self::$current_sort_method;
        return view('catalog', compact('bouquets', 'filters', 'main_label', 'sorting_keys', 'current_sort_method', 'current_filter'));
    }

    private function get_bouquets_without_filters() {
        $bouquet_builder = Bouquet::query();
        return $this->sort_bouquets($bouquet_builder);
    }

    private function get_bouquets_with_defined_filters($query) {
        $bouquet_builder = Bouquet::query()
            ->where(array_key_first($query), strval(array_values($query)[0]));
        return $this->sort_bouquets($bouquet_builder);
    }

    private function get_bouquets_with_undefined_filters($query) {
        $model_array = ['type' => Type::class, 'color' => Color::class];
        $filter = $model_array[array_key_first($query)]
            ::where(array_key_first($query), array_values($query)[0])
            ->get();
        $bouquet_builder = $filter[0]->bouquets->toQuery();
        return $this->sort_bouquets($bouquet_builder);
    }

    private function get_bouquets_with_price_filter($query) {
        $interval = self::get_prices()[$query['price']];
        $bouquet_builder = Bouquet::query()
            ->whereBetween('price', $interval);
        return $this->sort_bouquets($bouquet_builder);
    }

    private function sort_bouquets($bouquet_builder) {
        if (self::$current_sort_method === null) {
            self::$current_sort_method = 'За релевантністю';
        }
        $sorting_parameters = $this->get_sorting_parameters()[self::$current_sort_method];
        $collection = $bouquet_builder->get();
        foreach ($sorting_parameters as $item) {
            if ($item['direction'] == 'ASC'){
                $collection = $collection->sortBy([
                    fn (Bouquet $a, Bouquet $b) => $a->price <=> $b->price,
                ]);
            } else {
                $collection = $collection->sortBy([
                    fn (Bouquet $a, Bouquet $b) => $b->price <=> $a->price,
                ]);
            }
        }
        return $collection;
    }
}
