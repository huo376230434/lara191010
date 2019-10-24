

<a href="javascript:void(0);"
   class="{{$is_btn ? "btn btn-sm btn-" : 'text-'}}{{$color_type}} {{$uuid_class}}  {{$addon_class ?? ''}}  {{$pull_right ? "pull-right" : ""}}"  {{$blank ? "target=_blank" : ''}}
   title="{{$msg}}"
   data-title="{{$msg}}"
   data-msg="{{$msg}}"
   data-primary_key="{{$primary_key}}"

   {{$data_extra ?? ''}}
   data-url="{{$url}}">
    {!! $title !!}
</a>










