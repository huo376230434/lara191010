;$(function () {


    /**
     *请求服务器系统报错的统一封装
     * @param e
     */
    function requestError(e) {
        if(e.status=='419')
        {
            swal("您有段时间没操作了，请手动刷新页面再重新操作！", '', 'error');
        }else{
            swal("系统出错", '', 'error');
        }
    }


    /**
     * 传入表单form 的jquery 对象，取得表单的所有参数的标准键值对格式
     * @param form_obj
     * @param extra_params
     * @returns
     */
    function getAllFormParams(form_obj,extra_params) {
        var dest_obj ={
            _token:LA.token
        };
        var form_data = form_obj.serializeArray();
        if (window.dw_debug) {
            console.log('getAllFormParams 表单原生参数');
            console.log(form_data);
        }

        $.each(form_data, function() {
            // 要先判断这个name 是不是以[]结尾，以[]结尾则说明是数组，不是则覆盖
            var is_arr = false;
            var name = this.name;
            if (_.endsWith(this.name, '[]')) {
                is_arr = true;
                name = name.slice(0,-2)
            }
            if(dest_obj[name] === undefined ){
                //这个name 首次加入数组
                if (is_arr) {
                    dest_obj[name] = [this.value];
                }else{
                    dest_obj[name] = this.value;
                }
            }else{
                //此name已经有值，
                if( is_arr){
                    //数组则进数组
                    dest_obj[name].push(this.value);
                }else{
                    // 不是数组则覆盖
                    dest_obj[name] = this.value;
                }
            }
        });

        if (extra_params) {
            dest_obj = _.assign(dest_obj,extra_params)
        }
        if (window.dw_debug) {
            console.log('getAllFormParams 返回的对象');
            console.log(dest_obj);
        }

        return dest_obj;
    }

    /**
     * 常规的checkboxgroup 全选的初始化
     * @param toggle
     * @param checkbox_selector
     */
    function checkboxCommonToggle(toggle,checkbox_selector) {
        toggle.iCheck({checkboxClass:'icheckbox_minimal-blue'});

        toggle.on('ifChanged',function (e) {
            var event_name = e.target.checked ? "check":"uncheck";

            if (window.dw_debug) {
                console.log(checkbox_selector + '选择器触发了' + event_name + "事件");
            }

            if (e.target.checked) {
                $( checkbox_selector).each(function (index, value) {
                    $(value).iCheck('check');
                    var $tr = $(value).closest('tr');
                    //让整行都加上选中属性
                    $tr.addClass('checked')

                })
            }else{
                $(checkbox_selector).each(function (index, value) {
                    $(value).iCheck('uncheck');
                    var $tr = $(value).closest('tr');
                    //让整行都取消选中属性
                    $tr.removeClass('checked')
                })
            }

        });
    }




    /**
     * 此处为了解决浏览器鼠标滚动时验证提示框不消失的问题
     */
    document.body.onmousewheel = function() {
        var obj =  $('*:focus').context.activeElement;
        $(obj).blur()
    };
    /**
     * 此处为火狐浏览器的专有事件，解决上述验证提示框不消失的问题
     */
    document.addEventListener('DOMMouseScroll',function(){
        // alert(3)
        var obj =  $('*:focus').context.activeElement;
        $(obj).blur()
    },false);




    $(function () {
        /**
         * 这个是给所有的table 加上事件，点击后选中全行，但是对于有些操作类的按钮可以用.table_no_auto_check 类包裹，阻止此事件
         * @param e
         */
        var fun =function (e) {
            $this = $(e.target);
            var $td;
            var $tr = $this.closest('tr');
            if ( $this[0].tagName == "TD") {
                $td = $this;
            }else{
                $td = $this.closest('td');
            }
            if (!$td.length) {
                console.log($td);
                //如果没有td ,则直接返回
                return ;
            }


            var checkbox = $tr.find('.icheckbox_minimal-blue');
            if (checkbox.length) {

                if ( !shoudIgnore($this,$td)) {
                    if (checkbox.hasClass('checked')) {
                        checkbox.iCheck('uncheck');
                        $tr.removeClass('checked')
                    }else{
                        checkbox.iCheck('check');
                        $tr.addClass('checked')
                    }
                }
            }

            function shoudIgnore($context, $td) {
                if (window.dw_debug) {
                    console.log($context[0].tagName == 'A');
                    console.log($td);
                }
                //说明 有checkbox,再判断有没有这个 table_to_auto_check 这个类,没有的话才选中
                // 如果父元素有 a标签， 或者本身就是a 则也不选中
                //如果没有td,则也不选中
                return  $td.find('.table_no_auto_check').length || $td.find('a').length || $context[0].tagName == 'A'
            }
        };
        $('body').undelegate('table tr','click',fun).delegate('table tr','click',fun)
    })





})
