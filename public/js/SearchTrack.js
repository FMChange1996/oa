
    $(function () {
        $(".express-icon").click(function () {
            $(".express-companys").toggle(300);
            $("#searchSuccess").hide();
            $("#searchFail").hide();
        });
        $(".com-list .all-list li a,.com-list .common a").click(function () {
            //选择快递公司，如果有单号，则直接用此快递公司查询
            var _expName = $(this).text();
            if ($("#searchArea").val().trim().length > 0) {
                $(".express-icon>span").text($(this).text());
                $(".express-icon>span").attr("data-code", $(this).attr("data-code"));
                $(".express-companys").toggle(300);
                $.post("http://www.kdniao.com/handler/JSInvoke.ashx?action=SearchTrackByExpNo", { ExpNo: $("#searchArea").val().trim(), ExpCode: $(this).attr("data-code") }, function (data) {
                    if (data) {
                        $(".expressTitle").text(data.LogisticCode);
                        $(".expressTel").text("电话：" + data.OrderCode);
                        $(".expressWebSite").attr("href", data.Reason);

                        if (data.Traces && data.Traces.length > 0) {
                            var myHtml = "";
                            var lineSty = "";
                            for (var i = 0; i < data.Traces.length; i++) {
                                if (i == 0) {
                                    lineSty = "item-sub-head";
                                }
                                else if (i == (data.Traces.length - 1)) {
                                    lineSty = "item-sub-footer";
                                }
                                else {
                                    lineSty = "";
                                }
                                myHtml += "<li class=\"item\">" +
                                                "<span class=\"item-sub1\">" + data.Traces[i].AcceptTime + "</span>" +
                                                "<span class=\"item-sub2  " + lineSty + "\"></span>" +
                                                "<span class=\"item-sub3\">" + data.Traces[i].AcceptStation + "</span>" +
                                            "</li>";

                            }
                            $("#ultrack").empty();
                            $("#ultrack").append(myHtml);
                            $("#searchSuccess").show();
                            $(".express-companys").hide();
                        } else {//没有查询成功
                            $("#searchSuccess").hide();
                            $("#searchFail").show();
                            $(".express-companys").hide();
                        }
                    }
                }, "json");
            }
            else {
                $(".express-companys").toggle(300);
                $(".express-icon>span").text($(this).text());
                $(".express-icon>span").attr("data-code", $(this).attr("data-code"));
            }
        });
        //点击查询
        $("#beginsearch").click(function () {
            if ($("#searchArea").val().trim().length<=0) {
                return false;
            }
            searchOrder();
        });
        var timer;

        //单号识别
        $("#searchArea").on("keyup",function () {
            if (timer) {
                clearTimeout(timer);
            }
            if ($("#searchArea").val().trim().length<=0) {
                $("#inputTips").hide();
                $(".autoinsert").remove();
                return false;
            }
            var me = $(this);
            timer = setTimeout(function () {
                autoSelect(me.val());
            }, 700);
        });
        $("#searchArea").on("click", function (e) {
            e.stopPropagation();
            e.preventDefault();
            if ($(".autoinsert") && $(".autoinsert").length>0) {
                $("#inputTips").show();
            }
        });
        $("#inputTips").click(function () {
            e.stopPropagation();
            e.preventDefault();
        })
        $("#inputTips").on("click", ".autoinsert", {}, function (e) {
            e.stopPropagation();
            e.preventDefault();
            $(".express-icon>span").text($(this).find(".expItem").text());
            $(".express-icon>span").attr("data-code", $(this).find(".expItem").attr("data-code"));
            $(".autoinsert").remove();
            $("#inputTips").hide();
            searchOrder();
        });
        $("body,html").click(function () {
            $("#inputTips").hide();
        });

    });
function searchOrder()
{
    $.post("http://www.kdniao.com/handler/JSInvoke.ashx?action=SearchTrackByExpNo", { ExpNo: $("#searchArea").val().trim(), ExpCode: $("#autosy").attr("data-code") }, function (data) {
        if (data) {
            $(".expressTitle").text(data.LogisticCode);
            $(".expressTel").text("电话：" + data.OrderCode);
            $(".expressWebSite").attr("href", data.Reason);
            if (data.LogisticCode && data.LogisticCode.length > 0) {
                $(".express-icon>span").text(data.LogisticCode);
            }
            if (data.ShipperCode && data.ShipperCode.length > 0) {
                $(".express-icon>span").attr("data-code", data.ShipperCode);
            }
            if (data.Traces && data.Traces.length > 0) {
                var myHtml = "";
                var lineSty = "";
                for (var i = 0; i < data.Traces.length; i++) {
                    if (i == 0) {
                        lineSty = "item-sub-head";
                    }
                    else if (i == (data.Traces.length - 1)) {
                        lineSty = "item-sub-footer";
                    }
                    else {
                        lineSty = "";
                    }
                    myHtml += "<li class=\"item\">" +
                                    "<span class=\"item-sub1\">" + data.Traces[i].AcceptTime + "</span>" +
                                    "<span class=\"item-sub2  " + lineSty + "\"></span>" +
                                    "<span class=\"item-sub3\">" + data.Traces[i].AcceptStation + "</span>" +
                                "</li>";

                }
                $("#ultrack").empty();
                $("#ultrack").append(myHtml);
                $("#searchSuccess").show();
                $("#searchFail").hide();
                $(".express-companys").hide();
            } else {//没有查询成功
                $("#searchSuccess").hide();
                $("#searchFail").show();
                $(".express-companys").hide();
            }
        }
    }, "json");
}
function autoSelect(keyValue) {
    if (keyValue && keyValue.trim().length > 0) {
        //启动单号识别
        $.post("http://www.kdniao.com/handler/JSInvoke.ashx?action=SyExpNo", { ExpNo: keyValue }, function (data) {
            if (data && data.Shippers && data.Shippers.length>0) {
                var myHtml = "";
                for (var i = 0; i < data.Shippers.length; i++) {
                    myHtml += "<li class=\"selection selection0 autoinsert\"><span>" + keyValue + "</span><a class=\"expItem\" data-code='" + data.Shippers[i].ShipperCode + "'>" + data.Shippers[i].ShipperName + "</a></li>";
                }
                $(".autoinsert").remove();
                $(".otline").before(myHtml);
                $("#inputTips").show();
            }
            else {
                $(".autoinsert").remove();
                $("#inputTips").hide();
            }
        }, "json")
    }
    else {
        $("#inputTips").hide();
    }
}