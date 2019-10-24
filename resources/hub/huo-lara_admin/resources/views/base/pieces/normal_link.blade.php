

    <a href="{{$url ?? 'javascript:void(0);'}}"
       class="{{$is_btn ? "btn btn-sm btn-" : 'text-'}}{{$color_type}} {{$addon_class ?? ''}}  {{$pull_right ? "pull-right" : ""}}"  {{$blank ? "target=_blank" : ''}}
        style=" {{($margin_x || $margin_y) ? "margin:  $margin_y $margin_x;": '' }}  "
       title="{{$title}}"
       data-url="{{$url}}">
        {!! $title !!}
    </a>






