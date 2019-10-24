@extends("admine::base.layout.simple_layout")

@section('content')
    
@endsection
<style>


    @media print{

        /*隐藏不打印的元素*/
        .no-print{
            display:none!important;
        }
        .collapse:not(.show) {
            display: block!important;
        }
        /*其他打印样式*/
    }

</style>

<div class="text-primary mt-5 mb-2 text-center"><h1> 数据库字典文档 </h1> </div>
<div class="text-center mb-5"> 总共 <b>{{$table_count}}</b>  张表</div>

<div class="container">

    @foreach($tables_info  as $i => $table)
        <?php //dd($table);?>


            <h3   class="mt-3">     <button  class="btn btn-primary  no-print" data-toggle="collapse" data-target="#schema-{{$i}}"  style="cursor: pointer">  折叠  </button>
                 {{$i+1}}.  表名: {{$table->Name}} <span class="small text-success">{{$table->Comment}}</span></h3>

        <div class="collapse" id="schema-{{$i}}">
            <table class="table table-bordered table-hover table-striped shadow mb-5 ">
                <thead>
                <tr >
                    <th style="width:110px">字段</th>
                    <th>类型</th>
                    <th>为空</th>
                    <th>额外</th>
                    <th>默认</th>
                    <th>索引</th>
                    <th>排序规则</th>
                    <th >备注</th>
                </tr>

                </thead>
                <tbody>
                @foreach($table->fields as $field)
                    <tr>
                        <td>{{$field->Field}}</td>
                        <td>{{$field->Type}}</td>
                        <td>{{$field->Null}}</td>
                        <td>{{$field->Extra}}</td>
                        <td>{{$field->Default}}</td>
                        <td>{{$field->Key}}</td>
                        <td  >{{$field->Collation}}</td>
                        <td style="width:260px">{{$field->Comment}}</td>
                    </tr>

                @endforeach


                </tbody>
            </table>
        </div>



        @endforeach



</div>
