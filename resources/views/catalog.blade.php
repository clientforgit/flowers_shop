@extends('layout')

@section('content')
    <div class="layout padding-container">
        <h2>{{$main_label}}</h2>
        @if($main_label !== 'Всі букети')
            <div class="catalog-path">
                <p class="path" onclick="redirect('/')">Домашня сторінка</p>
                <p class="path">&nbsp;/&nbsp;</p>
                <p class="path" onclick="redirect('/catalog')">Каталог</p>
                <p class="path">&nbsp;/&nbsp;</p>
                <p class="path" onclick="redirect('#')">{{$main_label}}</p>
            </div>
        @endif
        <div class="catalog">
            <div class="filter">
                <h3 class="title">Фільтр</h3>
                <hr class="thin">
                @foreach($filters as $filter)
                    <div class="item" onclick="opensection('{{$filter['name']}}', {{count($filter['items'])}})">
                        <h3>{{$filter['label']}}</h3>
                        <img src="images/plus.svg" alt="Add" id="category_img">
                    </div>
                    <div id="{{$filter['name']}}" class="details">
                        @foreach($filter['items'] as $item)
                            @if(gettype($item) !== 'array')
                                <p onclick="redirect('{{"/catalog?".http_build_query(['filter' => [$filter['name'] => $item], 'sort_method' => $current_sort_method])}}')">{{$item}}</p>
                            @else
                                <p onclick="redirect('{{"/catalog?".http_build_query(['filter' => [$filter['name'] => $item[0]], 'sort_method' => $current_sort_method])}}')" id="selected_filter">{{$item[0]}}</p>
                            @endif
                        @endforeach
                    </div>
                    <hr class="thin">
                @endforeach
            </div>
            <div class="products-container">
                <div class="sort-container">
                    <h3 class="sort" onclick="showHiddenSort({{count($sorting_keys)}})">Сортувати по&nbsp;&nbsp;<img src="images/arrow_down.svg" alt="Arrow down" id="sort_arrow"></h3>
                </div>
                <div class="hidden-sort layout" id="hidden_sort">
                    <div class="sort-options">
                        @foreach($sorting_keys as $name)
                            @if($name !== $current_sort_method)
                                <p onclick="redirect('{{"/catalog?".http_build_query(['filter' => $current_filter, 'sort_method' => $name])}}')">{{$name}}</p>
                            @else
                                <p id="current_method" onclick="redirect('{{"/catalog?".http_build_query(['filter' => $current_filter, 'sort_method' => $name])}}')">{{$name}}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="products">
                    @if (empty($bouquets->toArray()))
                        <h2>За вашим запитом нічого не знайдено</h2>
                        <h3 onclick="redirect('/catalog')">Скинути фільтри</h3>
                    @else
                        <div class="products-grid">
                                @foreach($bouquets as $bouquet)
                                <div class="catalog-item" onclick="redirect('/product_card/{{$bouquet->id}}')">
                                    <img src="images/{{$bouquet->img_name}}">
                                    <p>Букет "{{$bouquet->name}}"</p>
                                    <p class="price">Ціна: {{$bouquet->price}} грн</p>
                                </div>
                                @endforeach
                        </div>
                    @endif
{{--                    @if($set_more_button)--}}
{{--                        <button class="more">Більше</button>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
@endsection
