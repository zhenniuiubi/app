/**
 * 通用的 form表单提交数据方法
 */

function app_save(form) {
    var data = $(form).serialize();
    url = $(form).attr('url');

    $.post(url, data, function (result) {
        if (result.code == 0) {
            console.log(result);
            layer.msg(result.msg, { icon: 5, time: 2000 });
        } else if (result.code == 1) {
            layer.msg(result.msg, { icon: 1, time: 2000 }, function () {
                self.location = result.data.jump_url;
            });
        }
    }, 'json');
}

/**
 * 时间插件适配的一个方法
 */
function selecttime(flag) {
    if (flag == 1) {
        var endTime = $("#countTimeend").val();
        if (endTime != "") {
            WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm', maxDate: endTime })
        } else {
            WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm' })
        }
    } else {
        var startTime = $("#countTimestart").val();
        if (startTime != "") {
            WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm', minDate: startTime })
        } else {
            WdatePicker({ dateFmt: 'yyyy-MM-dd HH:mm' })
        }
    }
}

function app_del(obj,id) {
    layer.confirm('确认删除吗?', { icon: 3, title: '提示' }, function (index) {
        url = $(obj).attr("del_url");
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(data){
                if (data.code==1) {
                    layer.msg('已删除',{icon:1,time:1000},function(){
                        self.location = data.data.jump_url;
                    });
                }else if(data.code==0){
                    layer.msg(data.msg,{icon:1,time:2000});
                }
            },
            error: function(data){
                console.log(data);
            }
        });

        layer.close(index);
    });
}

function app_status(obj) {
    url = $(obj).attr("status_url");
    layer.confirm('确认修改吗?', { icon: 3, title: '提示' }, function (index) {
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(data){
                if (data.code==1) {
                    layer.msg('已修改',{icon:1},function(){
                        self.location = data.data.jump_url;
                    });
                }else if(data.code==0){
                    layer.msg(data.msg,{icon:1,time:500});
                }
            },
            error: function(data){
                console.log(data);
            }
        });

        layer.close(index);
    });
}