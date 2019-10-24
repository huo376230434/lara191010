


{{--与DoWithConfirm共用一个trigger--}}




@component("admine::base.pieces.do_with_confirm",array_merge(get_defined_vars(),[

]))
    @slot("data_extra")
        {{$data_extra ?? null}}
        @endslot

@endcomponent
