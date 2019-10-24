


<div
    {{--style="display: none"--}}
    class="modal  fade" id="{{$modal_tag}}-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
    <div class="modal-dialog {{isset($modal_lg) && $modal_lg ? "modal-lg" : ''}}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="{{$modal_tag}}-title"> {{$title ?? ''}}</h4>
            </div>
            <form id="{{$modal_tag}}-form" action="" method="post" >
                <div class="modal-body">

                    {{$body}}
                </div>
                <div class="modal-footer">

                    {{$footer ?? view('admine::base.bt3modals.bt3modal_footer',get_defined_vars())}}
                </div>
            </form>
        </div>
    </div>
</div>
