function rebootServer(idc,seq){
    $.ajax({
        type:'POST',
        url:'./?mod=server&item='+idc+'&action=reboot',
        data: $('#serverReboot'+seq).serialize(),
        success:function(data){
            alert (data) ;
            window.location.reload();
        },
        error:function(){
            alert ('System Error!') ;
        }
    }) ;
}

$("#rebootConfirm1").confirm({
        title:"确定重启？",
        text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
        confirm: function(button){
            rebootServer('<?php echo $_GET['item'] ;?>','1') ;
        },
        confirmButton: "是的，我确定",
        cancelButton: "不了"
});
$("#rebootConfirm2").confirm({
    title:"确定重启？",
    text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
    confirm: function(button){
        rebootServer('<?php echo $_GET['item'] ;?>','2') ;
    },
    confirmButton: "是的，我确定",
    cancelButton: "不了"
});
$("#rebootConfirm3").confirm({
    title:"确定重启？",
    text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
    confirm: function(button){
        rebootServer('<?php echo $_GET['item'] ;?>','3') ;
    },
    confirmButton: "是的，我确定",
    cancelButton: "不了"
});
$("#rebootConfirm4").confirm({
    title:"确定重启？",
    text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
    confirm: function(button){
        rebootServer('<?php echo $_GET['item'] ;?>','4') ;
    },
    confirmButton: "是的，我确定",
    cancelButton: "不了"
});
$("#rebootConfirm5").confirm({
    title:"确定重启？",
    text:"强制重启服务器可能会损坏系统文件，请谨慎操作！",
    confirm: function(button){
        rebootServer('<?php echo $_GET['item'] ;?>','5') ;
    },
    confirmButton: "是的，我确定",
    cancelButton: "不了"
});