
<!--自动生成时间  2019-10-25 17:23-->

@component('admine::base.bt3modals.bt3modal',array_merge(get_defined_vars(),[
'id' => $modal_tag,
'modal_lg' => false
]))
    @slot('body')
        <div class="modal_form">

            {{$modal_tag}}
            <div id="{{$modal_tag}}-wrap" class="m-2">

            </div>

            {{--<textarea required class="form-control" name="content" id="" cols="30" rows="5"></textarea>--}}

        </div>
    @endslot

@endcomponent

