<!-- Button trigger modal -->
<a class="action-custom" data-modal-name="test_modal" >
    Launch demo modal
</a>

<script>
    $('.action-custom').on('click',function () {
        $('#myModal').modal('show');
    })
</script>



@component('admine::base.bt3modals.bt3modal',['modal_name' => "sdf"])


    @slot('body')
      艺术硕士
    @endslot

    @slot('footer')
        <button type="submit" id="sdf-submit" class="btn btn-primary submit">保存</button>
        <button   data-dismiss="modal" aria-label="Close" class="btn btn-default pull-left">取消</button>
    @endslot


@endcomponent

