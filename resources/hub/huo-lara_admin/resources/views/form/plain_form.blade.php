<div class=" ">

    <!-- /.box-header -->
    <!-- form start -->
{{--    {!! $form->open(['class' => "form-horizontal"]) !!}--}}

    <div class="box-body">

        @if(!$tabObj->isEmpty())
            @include('admin::form.tab', compact('tabObj'))
        @else
            <div class="fields-group">

                @if($form->hasRows())
                    @foreach($form->getRows() as $row)
                        {!! $row->render() !!}
                    @endforeach
                @else
                    @foreach($layout->columns() as $column)
                        <div class="col-md-{{ $column->width() }}">
                            @foreach($column->fields() as $field)
                                {!! $field->render() !!}
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        @endif

    </div>
    <!-- /.box-body -->



    @foreach($form->getHiddenFields() as $field)
        {!! $field->render() !!}
    @endforeach

<!-- /.box-footer -->
{{--    {!! $form->close() !!}--}}
</div>

