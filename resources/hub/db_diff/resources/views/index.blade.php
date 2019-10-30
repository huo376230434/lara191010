<script>
@if($diff)
$(function () {
    var html = Diff2Html.getPrettyHtml(
        $('#diff').html(),
        @json($options)
    )
    $('#diff-html').html(html);
});
@endif
</script>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">填写连接配置</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
        <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-header with-border">
        <form method="post" action="{{ route('db-diff') }}" pjax-container>
        <div class="row" style="width: 900px;">

            <div class="col-md-6">
                <div class="form-horizontal">

                    <div class="form-group form-inline">
                        <label for="ori-host" class="col-md-2 control-label">服务器</label>
                        <div class=" col-md-10">
                            <input class="form-control" name="source[host]" id="ori-host" placeholder="Host" value="{{ request()->input('source.host', 'localhost') }}" required>
                            :
                            <input class="form-control" name="source[port]" placeholder="Port" value="{{ request()->input('source.port', 3306) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ori-database" class="col-md-2 control-label">数据库</label>
                        <div class="col-md-10">
                            <input class="form-control" style="width:315px;" name="source[database]" id="ori-database" placeholder="Database" value="{{ request()->input('source.database') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ori-username" class="col-md-2 control-label">用户名</label>
                        <div class="col-md-10">
                            <input class="form-control" style="width:315px;" name="source[username]" id="ori-username" placeholder="Username" value="{{ request()->input('source.username') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ori-password" class="col-md-2 control-label">密码</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" style="width:315px;" name="source[password]" id="ori-password" placeholder="Password" value="{{ request()->input('source.password') }}">
                        </div>
                    </div>
                    <input type="hidden" name="source[driver]" value="mysql">
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-horizontal">

                    <div class="form-group form-inline">
                        <label for="new-host" class="col-md-2 control-label">服务器</label>
                        <div class=" col-md-10">
                            <input class="form-control" name="target[host]" id="new-host" placeholder="Host" value="{{ request()->input('target.host') }}" required>
                            :
                            <input class="form-control" name="target[port]" placeholder="Port" value="{{ request()->input('target.port', 3306) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-database" class="col-md-2 control-label">数据库</label>
                        <div class="col-md-10">
                            <input class="form-control" style="width:315px;" name="target[database]" id="new-database" placeholder="Database" value="{{ request()->input('target.database') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-username" class="col-md-2 control-label">用户名</label>
                        <div class="col-md-10">
                            <input class="form-control" style="width:315px;" name="target[username]" id="new-username" placeholder="Username" value="{{ request()->input('target.username') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="col-md-2 control-label">密码</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" style="width:315px;" name="target[password]" id="new-password" placeholder="Password" value="{{ request()->input('target.password') }}">
                        </div>
                    </div>
                    <input type="hidden" name="target[driver]" value="mysql">
                </div>
            </div>

        </div>

        <div class="box-footer">
            <div class="row" style="margin-left: 65px;">
                <div class="btn-group pull-left">
                    <button class="btn btn-info submit btn-sm">
                        <i class="fa fa-search"></i>&nbsp;&nbsp;对比
                    </button>
                </div>
                <div class="btn-group pull-left " style="margin-left: 10px;">
                    <button type="reset" class="btn btn-default btn-sm">
                        <i class="fa fa-undo"></i>&nbsp;&nbsp;重置
                    </button>
                </div>
            </div>
        </div>

        {{ csrf_field() }}

        </form>

    </div>

    @if($error)
        <div class="box-body">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Exception</h4>
            {{ $error }}
        </div>
        </div>
    @endif

    @if($diff)
        <div class="box-body">
            <div id="diff-html"></div>
        </div>

        <template id="diff" class="hide">{!! $diff !!}}</template>
    @elseif(!is_null($diff))
        <div class="box-body">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> 比对结果</h4>
                数据库结构一致。
            </div>
        </div>
    @endif

    <!-- /.box-body -->
</div>

