
<script>

    ;(function(){

        var modal_prefix = '{{$modal_tag}}';

        // var modal_prefix = "dummy_modal_prefix";
        var form = $("#"+modal_prefix+"-form");

        window[modal_prefix] =  function (json_params) {
            var title = json_params.title;
            var url = json_params.url;
            var primary_key = json_params.primary_key;
            var beferShowHook = json_params.beferShowHook;
            var afterShowHook = json_params.afterShowHook;
            var beferSubmit = json_params.beferSubmit;
            var submitSucceed = json_params.submitSucceed;
            var successRefreshTime = json_params.successRefreshTime;
            var forceRefresh = json_params.forceRefresh;
            var submitParamsWrap = json_params.submitParamsWrap;
            form[0].reset()

            $("#"+modal_prefix+"-title").html(""+title+"</span>");
            form.attr("action",url);
            $("#"+modal_prefix+"-id").val(primary_key);
            beferShowHook && beferShowHook(primary_key,modal_prefix,$(this));//modal显示前勾子
            $("#"+modal_prefix+"-modal").modal("show",1000);
            afterShowHook && afterShowHook(primary_key,modal_prefix,$(this))

            form.unbind('submit').on('submit',function(e){
                var this_form = $(this)
                e.preventDefault()
                var post_data = {};

                post_data = getAllFormParams(form);

//解发modal_prefix 的befersumit 事件
                $(this).trigger(modal_prefix + "_before_sumit",post_data,modal_prefix,primary_key)
                if (beferSubmit) {
                    var res = beferSubmit(post_data,modal_prefix,primary_key)
                    if (res === 'quit') {
                        $("#"+modal_prefix+"-modal").modal("hide");
                        return false;
                    }
                    if (res === false) {
                        return false;
                    }
                }//表单提交前的勾子，用于参数的增减

                if (submitParamsWrap) {
                    post_data = submitParamsWrap(post_data)
                }
                this_form.find("[type=submit]").prop('disabled',true);
                $.ajax({
                    method: 'post',
                    url:url,
                    data: post_data,
                    success: function (data) {
                        if (typeof data === 'object') {
                            if (typeof data === 'object') {
                                if (data.status) {
                                    submitSucceed && submitSucceed(data);//表单提交成功的勾子，
                                    $("#"+modal_prefix+"-modal").modal("hide");
                                    toastr.success(data.message.title,"",{positionClass:'toast-top-right'})
                                    var delay_time = 100;
                                    if(successRefreshTime) {
                                        delay_time = successRefreshTime()
                                    }
                                    if (delay_time >= 100) {
                                        setTimeout(function () {
                                            // console.log(typeof(forceRefresh));
                                            if( forceRefresh) {
                                                location.reload()
                                            }else{
                                                $.pjax.reload('#pjax-container');
                                            }
                                        },delay_time);
                                    }
                                } else {
                                    this_form.find("[type=submit]").prop('disabled',false)
                                    toastr.error('',data.message.title,{positionClass:'toast-top-center'})
                                }
                            }
                        }else{
                            this_form.find("[type=submit]").prop('disabled',false)

                            toastr.error('失败',"",{positionClass:'toast-top-center'})

                        }


                    },
                    error: function(e){
                        this_form.find("[type=submit]").prop('disabled',false)

                        console.log(e.status)
                        if(e.status=='419')
                        {
                            swal("您有段时间没操作了，请手动刷新页面再重新操作！", '', 'error');
                        }else{
                            toastr.error('失败',"",{positionClass:'toast-top-center'})
                        }

                    }
                });
            });
        }


        $('body').undelegate('.{{$uuid_class}}','click').delegate('.{{$uuid_class}}','click',function() {

            //hook_function
            json_obj = {};

            json_obj.title = $(this).data("title");
            json_obj.url = $(this).data("url");
            json_obj.primary_key = $(this).data("primary_key");
console.log(json_obj);
            window[modal_prefix](json_obj)
        });

    })();



</script>
