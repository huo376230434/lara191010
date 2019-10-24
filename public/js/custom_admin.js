(function () {
    $filter_timer = null
    //事件代理，解决按浏览器的后退键后折叠按钮不生效的结果
    $("#pjax-container").delegate(".filter-trigger","click",function(e){

        if ($filter_timer) {
            clearTimeout($filter_timer);
        }
        $filter_timer =  setTimeout(function () {
            $("#filter-box").toggleClass("hide")

        },10);
        console.log(234)
        e.stopPropagation()
    });



})()
