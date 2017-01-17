$(function(){
    $(".code").change(function(){
        var code = $("#code1").val() + $("#code2").val() + $("#code3").val();
        if(code.length == 24){
            var ret;
            R3 = document.getElementById("ROCKEY3");
            R3.VendorID = "BC5782B5"; //Find之前需要设置客户ID
            ret = R3.R3_Find();
            if( ret == 0 ){
                R3.index = 1;
                R3.R3_Open();
                R3.InLen = 24;           //读出数据的长度
                R3.Offset = 0;           //偏移地址
                ret = R3.R3_Read();              //读出数据
                if ( ret == 0){
                    var buff = R3.Buffer;
                    if(code == buff){
                        $("#codeshow").html("验证成功");
                        $(".submitbox").append('<input type="hidden" name="midog" value="ok" />');
                    }else{
                        $("#codeshow").html("验证失败");
                    }
                }else{
                    $("#codeshow").html("密锁不匹配");
                }
            }else{
                $("#codeshow").html("插入正确的加密锁");
            }
        }
    });
});