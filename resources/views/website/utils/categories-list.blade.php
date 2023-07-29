@php $categoriesList = getAllCategories(); @endphp

<div class="bookcategory__category-menu">
    <h1 class="bookcategory-title">
        Categories
    </h1>
    <ul class="category__menu">
       @foreach ($categoriesList as $category)
        <li>
            <a href="{{ route('website.home.category-detail-view', $category->slug) }}">
                <p>{{ $category->name }}</p>
                <span class="category__count">
                    ({{$category->books->count()}})
                </span>
            </a>
        </li>
       @endforeach
    </ul>
</div>
