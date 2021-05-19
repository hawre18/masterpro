@foreach($categories as $submenu)
    <li><a href="{{route('category.index',['id'=>$submenu])}}" class="gray-color">{{ $submenu->name }}</a></li>
        @if(count($submenu->childrenRecursive)>0)
            <ul class="item-ul">
                    <li>@include('frontend.partials.menu',['categories'=>$submenu->childrenRecursive, 'level'=>$level+1])</li>
                </ul>
        @endif
    </li>
@endforeach
