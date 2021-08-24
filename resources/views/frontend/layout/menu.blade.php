<div class="grid__column-2">
    <nav class="category">
        <h3 class="category__title"><i class="fas fa-list-ul category__title-icon"></i> Danh mục</h3>
        <ul class="category-list">
            @foreach($category as $key => $ctg)
                <li class="category-item">
                    <a href="{{url('/home/category/'.$ctg->category_id)}}" class="category-item__link">{{ $ctg->category_name }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>