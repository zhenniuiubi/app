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