


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>快递查询</title>
    <link href="{{url('css/out-common.css')}}" rel="stylesheet" />
    <link href="{{url('css/out-num.css')}}" rel="stylesheet" />
</head>
<body>
<!--搜索框 start-->
<div class="kdn-search clearfix">
    <div class="express-icon"><span  id="autosy" data-code="auto">智能识别</span><img class="icon-content" src="{{url('images/pull-down.png')}}" alt="快递公司logo" /> <div class="search-tip">切换快递公司</div></div>
    <input  class="search-input search-area" id="searchArea" maxlength="35" type="text" onkeyup="RemoveChinese(this)" placeholder="请输入快递单号,例如2165132113216">
    <input  class="search-input search-btn" style="float: right" type="button" value="" id="beginsearch">
</div>
<!--搜索框 end-->
<!--单号提示信息 start-->
<ul class="input-tips hide" id="inputTips" >
    <li class="tips_bottom otline">物流信息由 快递鸟 提供</li>
</ul>
<!--单号提示信息 end-->
<!--companys start-->
<div class="express-companys hide">
    <div class="com-list">
        <div id="suggestList" class="suggest hidden"></div>
        <ul class="common">
            <li ><span class="li-title" >常用</span><a data-code="auto">智能识别</a><a class="SF" data-code="auto">顺丰</a><a class="expItem" data-code="EMS">EMS</a><a class="expItem" data-code="YZPY">邮政包裹</a><a class="expItem" data-code="HTKY">百世汇通</a><a class="expItem" data-code="STO">申通</a><a class="expItem" data-code="ZTO">中通</a><a class="expItem" data-code="YTO">圆通</a><a class="expItem" data-code="GTO">国通</a><a class="expItem" data-code="YD">韵达</a><a class="expItem" data-code="HHTT">天天</a><a class="expItem" data-code="UC">优速</a><a class="expItem" data-code="FAST">快捷</a><a class="expItem" data-code="QFKD">全峰</a><a class="expItem" data-code="JD">京东</a><a class="expItem" data-code="ZJS">宅急送</a></li>
        </ul>
        <div class="search-bg"></div>

        <ul class="all-list l" style="width: 50%">

            <li class=" clearfix">
                <span class="li-title">?</span>

                <a class="expItem" data-code="CBO">钏博物流</a>

                <a class="expItem" data-code="GAI">迦递快递</a>

                <a class="expItem" data-code="XCWL">迅驰物流</a>

                <a class="expItem" data-code="XD">迅达国际</a>

                <a class="expItem" data-code="XSRD">鑫世锐达</a>

                <a class="expItem" data-code="YMSY">玥玛速运</a>

            <li class=" clearfix">
                <span class="li-title">A</span>

                <a class="expItem" data-code="AAE">AAE全球专递</a>

                <a class="expItem" data-code="ACS">ACS雅仕快递</a>

                <a class="expItem" data-code="ADD">澳多多</a>

                <a class="expItem" data-code="ADP">ADP Exp</a>

                <a class="expItem" data-code="AJ">安捷快递</a>

                <a class="expItem" data-code="ALKJWL">阿里跨境电商物</a>

                <a class="expItem" data-code="ANE">安能物流</a>

                <a class="expItem" data-code="ANGUILAYOU">安圭拉邮政</a>

                <a class="expItem" data-code="AOL">AOL</a>

                <a class="expItem" data-code="AOMENYZ">澳门邮政</a>

                <a class="expItem" data-code="APAC">APAC</a>

                <a class="expItem" data-code="ARAMEX">Aramex</a>

                <a class="expItem" data-code="AT">奥地利邮政</a>

                <a class="expItem" data-code="AUSTRALIA">Austral</a>

                <a class="expItem" data-code="AXD">安信达快递</a>

                <a class="expItem" data-code="AXWL">安讯物流</a>

                <a class="expItem" data-code="AYCA">澳邮专线</a>

                <a class="expItem" data-code="AYUS">安邮美国</a>

                <a class="expItem" data-code="GDEMS">广东邮政</a>

                <a class="expItem" data-code="GTKD">广通速递</a>

                <a class="expItem" data-code="IADLSQDYZ">安的列斯群岛邮</a>

                <a class="expItem" data-code="IADLYYZ">澳大利亚邮政</a>

                <a class="expItem" data-code="IAEBNYYZ">阿尔巴尼亚邮政</a>

                <a class="expItem" data-code="IAEJLYYZ">阿尔及利亚邮政</a>

                <a class="expItem" data-code="IAFHYZ">阿富汗邮政</a>

                <a class="expItem" data-code="IAGLYZ">安哥拉邮政</a>

                <a class="expItem" data-code="IAGTYZ">阿根廷邮政</a>

                <a class="expItem" data-code="IAJYZ">埃及邮政</a>

                <a class="expItem" data-code="IALBYZ">阿鲁巴邮政</a>

                <a class="expItem" data-code="IALQDYZ">奥兰群岛邮政</a>

                <a class="expItem" data-code="IALYYZ">阿联酋邮政</a>

                <a class="expItem" data-code="IAMYZ">阿曼邮政</a>

                <a class="expItem" data-code="IASBJYZ">阿塞拜疆邮政</a>

                <a class="expItem" data-code="IASEBYYZ">埃塞俄比亚邮政</a>

                <a class="expItem" data-code="IASNYYZ">爱沙尼亚邮政</a>

                <a class="expItem" data-code="IASSDYZ">阿森松岛邮政</a>

                <a class="expItem" data-code="IE">爱尔兰邮政</a>

                <a class="expItem" data-code="XYGJSD">ADLER雄鹰</a>

                <a class="expItem" data-code="ZY_AG">爱购转运</a>

                <a class="expItem" data-code="ZY_AOZ">爱欧洲</a>

                <a class="expItem" data-code="ZY_AUSE">澳世速递</a>

                <a class="expItem" data-code="ZY_AXO">AXO</a>

                <a class="expItem" data-code="ZY_AZY">澳转运</a>

            <li class=" clearfix">
                <span class="li-title">B</span>

                <a class="expItem" data-code="BALUNZHI">巴伦支快递</a>

                <a class="expItem" data-code="BCWELT">BCWELT</a>

                <a class="expItem" data-code="BDT">八达通</a>

                <a class="expItem" data-code="BEL">比利时邮政</a>

                <a class="expItem" data-code="BFAY">八方安运</a>

                <a class="expItem" data-code="BFDF">百福东方</a>

                <a class="expItem" data-code="BHGJ">贝海国际</a>

                <a class="expItem" data-code="BHT">BHT快递</a>

                <a class="expItem" data-code="BILUYOUZHE">秘鲁邮政</a>

                <a class="expItem" data-code="BJXKY">北极星快运</a>

                <a class="expItem" data-code="BKWL">宝凯物流</a>

                <a class="expItem" data-code="BLZ">巴伦支</a>

                <a class="expItem" data-code="BN">笨鸟国际</a>

                <a class="expItem" data-code="BQXHM">北青小红帽</a>

                <a class="expItem" data-code="BR">巴西邮政</a>

                <a class="expItem" data-code="BSWL">邦送物流</a>

                <a class="expItem" data-code="BTWL">百世物流</a>

                <a class="expItem" data-code="BUDANYOUZH">不丹邮政</a>

                <a class="expItem" data-code="HTKY">百世汇通</a>

                <a class="expItem" data-code="IBCWNYZ">博茨瓦纳邮政</a>

                <a class="expItem" data-code="IBDLGYZ">波多黎各邮政</a>

                <a class="expItem" data-code="IBDYZ">冰岛邮政</a>

                <a class="expItem" data-code="IBELSYZ">白俄罗斯邮政</a>

                <a class="expItem" data-code="IBHYZ">波黑邮政</a>

                <a class="expItem" data-code="IBJLYYZ">保加利亚邮政</a>

                <a class="expItem" data-code="IBJSTYZ">巴基斯坦邮政</a>

                <a class="expItem" data-code="IBLSD">便利速递</a>

                <a class="expItem" data-code="IBLYZ">巴林邮政</a>

                <a class="expItem" data-code="IBMDYZ">百慕达邮政</a>

                <a class="expItem" data-code="IBOLYZ">波兰邮政</a>

                <a class="expItem" data-code="IBTD">宝通达</a>

                <a class="expItem" data-code="IBYB">贝邮宝</a>

                <a class="expItem" data-code="ZY_BDA">八达网</a>

                <a class="expItem" data-code="ZY_BH">贝海速递</a>

                <a class="expItem" data-code="ZY_BL">百利快递</a>

                <a class="expItem" data-code="ZY_BM">斑马物流</a>

                <a class="expItem" data-code="ZY_BT">百通物流</a>

                <a class="expItem" data-code="ZY_BYECO">贝易购</a>

            <li class=" clearfix">
                <span class="li-title">C</span>

                <a class="expItem" data-code="CCES">CCES快递</a>

                <a class="expItem" data-code="CDSTKY">成都善途速运</a>

                <a class="expItem" data-code="CFWL">春风物流</a>

                <a class="expItem" data-code="CG">程光</a>

                <a class="expItem" data-code="CHTWL">诚通物流</a>

                <a class="expItem" data-code="CITY100">城市100</a>

                <a class="expItem" data-code="CJKD">城际快递</a>

                <a class="expItem" data-code="CKY">出口易</a>

                <a class="expItem" data-code="CNPEX">CNPEX中邮</a>

                <a class="expItem" data-code="COE">COE东方快递</a>

                <a class="expItem" data-code="CSCY">长沙创一</a>

                <a class="expItem" data-code="CXHY">传喜物流</a>

                <a class="expItem" data-code="SBWL">盛邦物流</a>

                <a class="expItem" data-code="SFWL">盛丰物流</a>

                <a class="expItem" data-code="SHWL">盛辉物流</a>

                <a class="expItem" data-code="ZY_CM">策马转运</a>

                <a class="expItem" data-code="ZY_CTM">赤兔马转运</a>

                <a class="expItem" data-code="ZY_CUL">CUL中美速递</a>

            <li class=" clearfix">
                <span class="li-title">D</span>

                <a class="expItem" data-code="D4PX">递四方速递</a>

                <a class="expItem" data-code="DBL">德邦</a>

                <a class="expItem" data-code="DBYWL">递必易国际物流</a>

                <a class="expItem" data-code="DCWL">德创物流</a>

                <a class="expItem" data-code="DDWL">大道物流</a>

                <a class="expItem" data-code="DEKUN">德坤速运</a>

                <a class="expItem" data-code="DGYKD">德国云快递</a>

                <a class="expItem" data-code="DHL">DHL</a>

                <a class="expItem" data-code="DHL_C">DHL(中国件</a>

                <a class="expItem" data-code="DHL_DE">DHL(德国件</a>

                <a class="expItem" data-code="DHL_EN">DHL</a>

                <a class="expItem" data-code="DHL_GLB">DHL全球</a>

                <a class="expItem" data-code="DHL_USA">DHL(美国)</a>

                <a class="expItem" data-code="DHLGM">DHL Glo</a>

                <a class="expItem" data-code="DHWL">东红物流</a>

                <a class="expItem" data-code="DJKJWL">东骏快捷物流</a>

                <a class="expItem" data-code="DK">丹麦邮政</a>

                <a class="expItem" data-code="DLG">到了港</a>

                <a class="expItem" data-code="DLGJ">到乐国际</a>

                <a class="expItem" data-code="DPD">DPD</a>

                <a class="expItem" data-code="DPEX">DPEX</a>

                <a class="expItem" data-code="DSWL">D速物流</a>

                <a class="expItem" data-code="DTKD">店通快递</a>

                <a class="expItem" data-code="DTWL">大田物流</a>

                <a class="expItem" data-code="DYWL">大洋物流快递</a>

                <a class="expItem" data-code="IDFWL">达方物流</a>

                <a class="expItem" data-code="IDGYZ">德国邮政</a>

                <a class="expItem" data-code="ZY_DGHT">德国海淘之家</a>

                <a class="expItem" data-code="ZY_DYW">德运网</a>

            <li class=" clearfix">
                <span class="li-title">E</span>

                <a class="expItem" data-code="EMS">EMS</a>

                <a class="expItem" data-code="EMSGJ">EMS国际</a>

                <a class="expItem" data-code="ESHIPPER">EShippe</a>

                <a class="expItem" data-code="IEGDEYZ">厄瓜多尔邮政</a>

                <a class="expItem" data-code="IELSYZ">俄罗斯邮政</a>

                <a class="expItem" data-code="IELTLYYZ">厄立特里亚邮政</a>

                <a class="expItem" data-code="IGJESD">俄速递</a>

                <a class="expItem" data-code="ZY_EFS">EFS POS</a>

                <a class="expItem" data-code="ZY_ETD">ETD</a>

            <li class=" clearfix">
                <span class="li-title">F</span>

                <a class="expItem" data-code="CRAZY">疯狂快递</a>

                <a class="expItem" data-code="FBKD">飞豹快递</a>

                <a class="expItem" data-code="FCWL">丰程物流</a>

                <a class="expItem" data-code="FEDEX">FedEx联邦</a>

                <a class="expItem" data-code="FHKD">飞狐快递</a>

                <a class="expItem" data-code="FKD">飞康达</a>

                <a class="expItem" data-code="FQ">FQ狂速</a>

                <a class="expItem" data-code="FTD">富腾达</a>

                <a class="expItem" data-code="FX">法翔</a>

                <a class="expItem" data-code="FYPS">飞远配送</a>

                <a class="expItem" data-code="FYSD">凡宇速递</a>

                <a class="expItem" data-code="IFEDEX">FedEx（国</a>

                <a class="expItem" data-code="IFTWL">飞特物流</a>

                <a class="expItem" data-code="PANEX">泛捷快递</a>

                <a class="expItem" data-code="ZY_FD">飞碟快递</a>

                <a class="expItem" data-code="ZY_FG">飞鸽快递</a>

                <a class="expItem" data-code="ZY_FLSD">风雷速递</a>

                <a class="expItem" data-code="ZY_FX">风行快递</a>

                <a class="expItem" data-code="ZY_FXSD">风行速递</a>

                <a class="expItem" data-code="ZY_FY">飞洋快递</a>

            <li class=" clearfix">
                <span class="li-title">G</span>

                <a class="expItem" data-code="GD">冠达</a>

                <a class="expItem" data-code="GDKD">冠达快递</a>

                <a class="expItem" data-code="GE2D">GE2D</a>

                <a class="expItem" data-code="GHX">挂号信</a>

                <a class="expItem" data-code="GJEYB">国际e邮宝</a>

                <a class="expItem" data-code="GJYZ">国际邮政包裹</a>

                <a class="expItem" data-code="GKSD">港快速递</a>

                <a class="expItem" data-code="GLS">GLS</a>

                <a class="expItem" data-code="GSD">共速达</a>

                <a class="expItem" data-code="GT">冠泰</a>

                <a class="expItem" data-code="GTO">国通快递</a>

                <a class="expItem" data-code="GTONG">广通</a>

                <a class="expItem" data-code="GTSD">高铁速递</a>

                <a class="expItem" data-code="IGDLPDEMS">瓜德罗普岛EM</a>

                <a class="expItem" data-code="IGDLPDYZ">瓜德罗普岛邮政</a>

                <a class="expItem" data-code="IGLBYYZ">哥伦比亚邮政</a>

                <a class="expItem" data-code="IGLLYZ">格陵兰邮政</a>

                <a class="expItem" data-code="IGSDLJYZ">哥斯达黎加邮政</a>

            <li class=" clearfix">
                <span class="li-title">H</span>

                <a class="expItem" data-code="HBJH">河北建华</a>

                <a class="expItem" data-code="HFHW">汇文</a>

                <a class="expItem" data-code="HGLL">黑狗冷链</a>

                <a class="expItem" data-code="HHKD">华航快递</a>

                <a class="expItem" data-code="HHWL">华翰物流</a>

                <a class="expItem" data-code="HLONGWL">辉隆物流</a>

                <a class="expItem" data-code="HLWL">恒路物流</a>

                <a class="expItem" data-code="HLYSD">好来运快递</a>

                <a class="expItem" data-code="HMJKD">黄马甲快递</a>

                <a class="expItem" data-code="HMSD">海盟速递</a>

                <a class="expItem" data-code="HOTSCM">鸿桥供应链</a>

                <a class="expItem" data-code="HPTEX">海派通物流公司</a>

                <a class="expItem" data-code="hq568">华强物流</a>

                <a class="expItem" data-code="HQKD">华企</a>

                <a class="expItem" data-code="HQKY">华企快运</a>

                <a class="expItem" data-code="HQSY">环球速运</a>

                <a class="expItem" data-code="HRWL">韩润物流</a>

                <a class="expItem" data-code="HSWL">昊盛物流</a>

                <a class="expItem" data-code="HTWL">户通物流</a>

                <a class="expItem" data-code="HXLWL">华夏龙物流</a>

                <a class="expItem" data-code="HXWL">豪翔</a>

                <a class="expItem" data-code="HYH">货运皇</a>

                <a class="expItem" data-code="IHGYZ">韩国邮政</a>

                <a class="expItem" data-code="IHLY">互联易</a>

                <a class="expItem" data-code="IHSKSTYZ">哈萨克斯坦邮政</a>

                <a class="expItem" data-code="IHSYZ">黑山邮政</a>

                <a class="expItem" data-code="NL">荷兰邮政</a>

                <a class="expItem" data-code="ZHQKD">汇强快递</a>

                <a class="expItem" data-code="ZY_HC">皓晨快递</a>

                <a class="expItem" data-code="ZY_HCYD">皓晨优递</a>

                <a class="expItem" data-code="ZY_HDB">海带宝</a>

                <a class="expItem" data-code="ZY_HFMZ">汇丰美中速递</a>

                <a class="expItem" data-code="ZY_HJSD">豪杰速递</a>

                <a class="expItem" data-code="ZY_HMKD">华美快递</a>

                <a class="expItem" data-code="ZY_HTCUN">海淘村</a>

                <a class="expItem" data-code="ZY_HTONG">华通快运</a>

                <a class="expItem" data-code="ZY_HXKD">海星桥快递</a>

                <a class="expItem" data-code="ZY_HXSY">华兴速运</a>

                <a class="expItem" data-code="ZY_HYSD">海悦速递</a>

            <li class=" clearfix">
                <span class="li-title">J</span>

                <a class="expItem" data-code="CA">加拿大邮政</a>

                <a class="expItem" data-code="IJBBWYZ">津巴布韦邮政</a>

                <a class="expItem" data-code="IJEJSSTYZ">吉尔吉斯斯坦邮</a>

                <a class="expItem" data-code="IJKYZ">捷克邮政</a>

                <a class="expItem" data-code="IJNYZ">加纳邮政</a>

                <a class="expItem" data-code="IJPZYZ">柬埔寨邮政</a>

                <a class="expItem" data-code="JAD">捷安达</a>

                <a class="expItem" data-code="JD">京东快递</a>

                <a class="expItem" data-code="JFGJ">今枫国际</a>

                <a class="expItem" data-code="JGSD">京广速递</a>

                <a class="expItem" data-code="JGWL">景光</a>

                <a class="expItem" data-code="JGZY">极光转运</a>

                <a class="expItem" data-code="JIUYE">九曳供应链</a>

                <a class="expItem" data-code="JJKY">佳吉快运</a>

                <a class="expItem" data-code="JLDT">嘉里大通</a>

                <a class="expItem" data-code="JTKD">捷特快递</a>

                <a class="expItem" data-code="JXD">急先达</a>

                <a class="expItem" data-code="JXYKD">吉祥邮转运</a>

                <a class="expItem" data-code="JYKD">晋越快递</a>

                <a class="expItem" data-code="JYM">加运美</a>

                <a class="expItem" data-code="JYSD">久易快递</a>

                <a class="expItem" data-code="JYWL">佳怡物流</a>

                <a class="expItem" data-code="ZY_JA">君安快递</a>

                <a class="expItem" data-code="ZY_JDKD">骏达快递</a>

                <a class="expItem" data-code="ZY_JDZY">骏达转运</a>

                <a class="expItem" data-code="ZY_JH">久禾快递</a>

                <a class="expItem" data-code="ZY_JHT">金海淘</a>

            <li class=" clearfix">
                <span class="li-title">K</span>

                <a class="expItem" data-code="FAST">快捷速递</a>

                <a class="expItem" data-code="IKNDYYZ">克罗地亚邮政</a>

                <a class="expItem" data-code="IKNYYZ">肯尼亚邮政</a>

                <a class="expItem" data-code="IKTDWEMS">科特迪瓦EMS</a>

                <a class="expItem" data-code="IKTDWYZ">科特迪瓦邮政</a>

                <a class="expItem" data-code="IKTEYZ">卡塔尔邮政</a>

                <a class="expItem" data-code="KLWL">康力物流</a>

                <a class="expItem" data-code="KSDWL">快速递物流</a>

                <a class="expItem" data-code="KTKD">快淘快递</a>

                <a class="expItem" data-code="KYDSD">快优达速递</a>

                <a class="expItem" data-code="KYSY">跨越速运</a>

                <a class="expItem" data-code="KYWL">跨越速递</a>

                <a class="expItem" data-code="QUICK">快客快递</a>

            <li class=" clearfix">
                <span class="li-title">L</span>

                <a class="expItem" data-code="CTG">联合运通</a>

                <a class="expItem" data-code="FEDEX_GJ">联邦国际</a>

                <a class="expItem" data-code="IBLNYZ">黎巴嫩邮政</a>

                <a class="expItem" data-code="ILBYYZ">利比亚邮政</a>

                <a class="expItem" data-code="ILKKD">林克快递</a>

                <a class="expItem" data-code="ILMNYYZ">罗马尼亚邮政</a>

                <a class="expItem" data-code="ILSBYZ">卢森堡邮政</a>

                <a class="expItem" data-code="ILTWYYZ">拉脱维亚邮政</a>

                <a class="expItem" data-code="ILTWYZ">立陶宛邮政</a>

                <a class="expItem" data-code="ILZDSDYZ">列支敦士登邮政</a>

                <a class="expItem" data-code="LB">龙邦快递</a>

                <a class="expItem" data-code="LBKD">联邦快递</a>

                <a class="expItem" data-code="LHKD">蓝弧快递</a>

                <a class="expItem" data-code="LHKDS">联合快递</a>

                <a class="expItem" data-code="LHT">联昊通速递</a>

                <a class="expItem" data-code="LJD">乐捷递</a>

                <a class="expItem" data-code="LJSKD">立即送</a>

                <a class="expItem" data-code="LYT">联运通</a>

                <a class="expItem" data-code="ZY_IHERB">Logisti</a>

                <a class="expItem" data-code="ZY_LBZY">联邦转运Fed</a>

                <a class="expItem" data-code="ZY_LPZ">领跑者快递</a>

                <a class="expItem" data-code="ZY_LX">龙象快递</a>

                <a class="expItem" data-code="ZY_LZWL">量子物流</a>

            <li class=" clearfix">
                <span class="li-title">M</span>

                <a class="expItem" data-code="IMEDFYZ">马尔代夫邮政</a>

                <a class="expItem" data-code="IMEDWYZ">摩尔多瓦邮政</a>

                <a class="expItem" data-code="IMETYZ">马耳他邮政</a>

                <a class="expItem" data-code="IMJLGEMS">孟加拉国EMS</a>

                <a class="expItem" data-code="IMLGYZ">摩洛哥邮政</a>

                <a class="expItem" data-code="IMLQSYZ">毛里求斯邮政</a>

                <a class="expItem" data-code="IMLXYEMS">马来西亚EMS</a>

                <a class="expItem" data-code="IMLXYYZ">马来西亚邮政</a>

                <a class="expItem" data-code="IMQDYZ">马其顿邮政</a>

                <a class="expItem" data-code="IMTNKEMS">马提尼克EMS</a>

                <a class="expItem" data-code="IMTNKYZ">马提尼克邮政</a>

                <a class="expItem" data-code="IMXGYZ">墨西哥邮政</a>

                <a class="expItem" data-code="MB">民邦速递</a>

                <a class="expItem" data-code="MDM">门对门</a>

                <a class="expItem" data-code="MHKD">民航快递</a>

                <a class="expItem" data-code="MK">美快</a>

                <a class="expItem" data-code="MLWL">明亮物流</a>

                <a class="expItem" data-code="MRDY">迈隆递运</a>

                <a class="expItem" data-code="MSKD">闽盛快递</a>

                <a class="expItem" data-code="WJWL">万家物流</a>

                <a class="expItem" data-code="WXWL">万象物流</a>

                <a class="expItem" data-code="ZY_BEE">蜜蜂速递</a>

                <a class="expItem" data-code="ZY_MBZY">明邦转运</a>

                <a class="expItem" data-code="ZY_MGZY">美国转运</a>

                <a class="expItem" data-code="ZY_MJ">美嘉快递</a>

                <a class="expItem" data-code="ZY_MST">美速通</a>

                <a class="expItem" data-code="ZY_MXZY">美西转运</a>

        </ul>
        <ul class="all-list l" style="width: 50%">

            <li class=" clearfix">
                <span class="li-title">N</span>

                <a class="expItem" data-code="INFYZ">南非邮政</a>

                <a class="expItem" data-code="INRLYYZ">尼日利亚邮政</a>

                <a class="expItem" data-code="INWYZ">挪威邮政</a>

                <a class="expItem" data-code="NEDA">能达速递</a>

                <a class="expItem" data-code="NF">南方传媒物流</a>

                <a class="expItem" data-code="NJSBWL">南京晟邦物流</a>

            <li class=" clearfix">
                <span class="li-title">O</span>

                <a class="expItem" data-code="OCS">OCS</a>

                <a class="expItem" data-code="ONTRAC">ONTRAC</a>

                <a class="expItem" data-code="ZY_OEJ">欧e捷</a>

                <a class="expItem" data-code="ZY_OZF">欧洲疯</a>

                <a class="expItem" data-code="ZY_OZGO">欧洲GO</a>

            <li class=" clearfix">
                <span class="li-title">P</span>

                <a class="expItem" data-code="IPTYYZ">葡萄牙邮政</a>

                <a class="expItem" data-code="PADTF">平安达腾飞快递</a>

                <a class="expItem" data-code="PAPA">啪啪供应链</a>

                <a class="expItem" data-code="PCA">PCA Exp</a>

                <a class="expItem" data-code="PJ">品骏</a>

                <a class="expItem" data-code="POSTEIBE">POSTEIB</a>

                <a class="expItem" data-code="PXWL">陪行物流</a>

            <li class=" clearfix">
                <span class="li-title">Q</span>

                <a class="expItem" data-code="EWE">全球快递</a>

                <a class="expItem" data-code="HTKD">青岛恒通快递</a>

                <a class="expItem" data-code="IQQKD">全球快递</a>

                <a class="expItem" data-code="IQTWL">全通物流</a>

                <a class="expItem" data-code="QCKD">全晨快递</a>

                <a class="expItem" data-code="QFKD">全峰快递</a>

                <a class="expItem" data-code="QQYZ">全球邮政</a>

                <a class="expItem" data-code="QRT">全日通快递</a>

                <a class="expItem" data-code="QXT">全信通</a>

                <a class="expItem" data-code="QYHY">秦远海运</a>

                <a class="expItem" data-code="UAPEX">全一快递</a>

                <a class="expItem" data-code="VENUCIA">启辰国际</a>

                <a class="expItem" data-code="ZY_QMT">全美通</a>

                <a class="expItem" data-code="ZY_QQEX">QQ-EX</a>

            <li class=" clearfix">
                <span class="li-title">R</span>

                <a class="expItem" data-code="JP">日本邮政</a>

                <a class="expItem" data-code="RDSE">瑞典邮政</a>

                <a class="expItem" data-code="RFD">如风达</a>

                <a class="expItem" data-code="RLWL">日昱物流</a>

                <a class="expItem" data-code="RRS">日日顺</a>

                <a class="expItem" data-code="SWCH">瑞士邮政</a>

                <a class="expItem" data-code="YAMA">日本大和运输(</a>

                <a class="expItem" data-code="ZY_RDGJ">润东国际快线</a>

                <a class="expItem" data-code="ZY_RT">瑞天快递</a>

                <a class="expItem" data-code="ZY_RTSD">瑞天速递</a>

            <li class=" clearfix">
                <span class="li-title">S</span>

                <a class="expItem" data-code="ISDYZ">苏丹邮政</a>

                <a class="expItem" data-code="ISEWDYZ">萨尔瓦多邮政</a>

                <a class="expItem" data-code="ISEWYYZ">塞尔维亚邮政</a>

                <a class="expItem" data-code="ISLFKYZ">斯洛伐克邮政</a>

                <a class="expItem" data-code="ISLWNYYZ">斯洛文尼亚邮政</a>

                <a class="expItem" data-code="ISPLSYZ">塞浦路斯邮政</a>

                <a class="expItem" data-code="ISTALBYZ">沙特阿拉伯邮政</a>

                <a class="expItem" data-code="SAD">赛澳递</a>

                <a class="expItem" data-code="SAWL">圣安物流</a>

                <a class="expItem" data-code="SCZPDS">速呈宅配</a>

                <a class="expItem" data-code="SDEZ">速递e站</a>

                <a class="expItem" data-code="SDHH">山东海红</a>

                <a class="expItem" data-code="SDSY">首达速运</a>

                <a class="expItem" data-code="SDWL">上大物流</a>

                <a class="expItem" data-code="SF">顺丰快递</a>

                <a class="expItem" data-code="SFC">三态速递</a>

                <a class="expItem" data-code="SHLDHY">上海林道货运</a>

                <a class="expItem" data-code="SJWL">穗佳物流</a>

                <a class="expItem" data-code="SK">穗空</a>

                <a class="expItem" data-code="SKYPOST">SKYPOST</a>

                <a class="expItem" data-code="ST">速通物流</a>

                <a class="expItem" data-code="STO">申通快递</a>

                <a class="expItem" data-code="STO_INTL">申通国际快递</a>

                <a class="expItem" data-code="STONG">首通</a>

                <a class="expItem" data-code="STSD">三态速递</a>

                <a class="expItem" data-code="STWL">速腾物流</a>

                <a class="expItem" data-code="SUBIDA">速必达物流</a>

                <a class="expItem" data-code="SURE">速尔快递</a>

                <a class="expItem" data-code="SXHMJ">山西红马甲</a>

                <a class="expItem" data-code="SYJHE">沈阳佳惠尔</a>

                <a class="expItem" data-code="SYKD">世运快递</a>

                <a class="expItem" data-code="UPU">赛维</a>

                <a class="expItem" data-code="YXKD">深圳亿翔物流有</a>

                <a class="expItem" data-code="ZY_JD">时代转运</a>

                <a class="expItem" data-code="ZY_SCS">SCS国际物流</a>

                <a class="expItem" data-code="ZY_SDKD">速达快递</a>

                <a class="expItem" data-code="ZY_SFZY">四方转运</a>

                <a class="expItem" data-code="ZY_SOHO">SOHO苏豪国</a>

                <a class="expItem" data-code="ZY_SONIC">Sonic-E</a>

                <a class="expItem" data-code="ZY_ST">上腾快递</a>

            <li class=" clearfix">
                <span class="li-title">T</span>

                <a class="expItem" data-code="HHTT">天天快递</a>

                <a class="expItem" data-code="HOAU">天地华宇</a>

                <a class="expItem" data-code="ITEQYZ">土耳其邮政</a>

                <a class="expItem" data-code="ITGYZ">泰国邮政</a>

                <a class="expItem" data-code="ITLNDHDBGE">特立尼达和多巴</a>

                <a class="expItem" data-code="ITNSYZ">突尼斯邮政</a>

                <a class="expItem" data-code="ITSNYYZ">坦桑尼亚邮政</a>

                <a class="expItem" data-code="TAILAND138">泰国138</a>

                <a class="expItem" data-code="TAIWANYZ">台湾邮政</a>

                <a class="expItem" data-code="THTX">通和天下</a>

                <a class="expItem" data-code="TNT">TNT快递</a>

                <a class="expItem" data-code="TSSTO">唐山申通</a>

                <a class="expItem" data-code="ZY_TCM">通诚美中快递</a>

                <a class="expItem" data-code="ZY_TJ">天际快递</a>

                <a class="expItem" data-code="ZY_TM">天马转运</a>

                <a class="expItem" data-code="ZY_TN">滕牛快递</a>

                <a class="expItem" data-code="ZY_TPAK">TrakPak</a>

                <a class="expItem" data-code="ZY_TPY">太平洋快递</a>

                <a class="expItem" data-code="ZY_TSZ">唐三藏转运</a>

                <a class="expItem" data-code="ZY_TTHT">天天海淘</a>

                <a class="expItem" data-code="ZY_TWC">TWC转运世界</a>

                <a class="expItem" data-code="ZY_TX">同心快递</a>

                <a class="expItem" data-code="ZY_TY">天翼快递</a>

                <a class="expItem" data-code="ZY_TZH">同舟快递</a>

            <li class=" clearfix">
                <span class="li-title">U</span>

                <a class="expItem" data-code="UEQ">UEQ Exp</a>

                <a class="expItem" data-code="UEX">UEX</a>

                <a class="expItem" data-code="UPS">UPS</a>

                <a class="expItem" data-code="USPS">USPS美国邮</a>

                <a class="expItem" data-code="ZY_UCS">UCS合众快递</a>

            <li class=" clearfix">
                <span class="li-title">W</span>

                <a class="expItem" data-code="IWDMLYZ">危地马拉邮政</a>

                <a class="expItem" data-code="IWGDYZ">乌干达邮政</a>

                <a class="expItem" data-code="IWKLEMS">乌克兰EMS</a>

                <a class="expItem" data-code="IWKLYZ">乌克兰邮政</a>

                <a class="expItem" data-code="IWLGYZ">乌拉圭邮政</a>

                <a class="expItem" data-code="IWLYZ">文莱邮政</a>

                <a class="expItem" data-code="IWZBKSTEMS">乌兹别克斯坦E</a>

                <a class="expItem" data-code="IWZBKSTYZ">乌兹别克斯坦邮</a>

                <a class="expItem" data-code="WHTZX">武汉同舟行</a>

                <a class="expItem" data-code="WJK">万家康</a>

                <a class="expItem" data-code="WPE">维普恩</a>

                <a class="expItem" data-code="WTP">微特派</a>

                <a class="expItem" data-code="ZY_WDCS">文达国际DCS</a>

            <li class=" clearfix">
                <span class="li-title">X</span>

                <a class="expItem" data-code="IXBYYZ">西班牙邮政</a>

                <a class="expItem" data-code="IXFLWL">小飞龙物流</a>

                <a class="expItem" data-code="IXGLDNYYZ">新喀里多尼亚邮</a>

                <a class="expItem" data-code="IXJPEMS">新加坡EMS</a>

                <a class="expItem" data-code="IXJPYZ">新加坡邮政</a>

                <a class="expItem" data-code="IXLYYZ">叙利亚邮政</a>

                <a class="expItem" data-code="IXLYZ">希腊邮政</a>

                <a class="expItem" data-code="IXPSJ">夏浦世纪</a>

                <a class="expItem" data-code="IXPWL">夏浦物流</a>

                <a class="expItem" data-code="IXXLYZ">新西兰邮政</a>

                <a class="expItem" data-code="IXYLYZ">匈牙利邮政</a>

                <a class="expItem" data-code="NSF">新顺丰转运</a>

                <a class="expItem" data-code="XBWL">新邦物流</a>

                <a class="expItem" data-code="XFEX">信丰快递</a>

                <a class="expItem" data-code="XGYZ">香港邮政</a>

                <a class="expItem" data-code="XJ">新杰物流</a>

                <a class="expItem" data-code="XKGJ">星空国际</a>

                <a class="expItem" data-code="XLKD">喜来</a>

                <a class="expItem" data-code="XLYT">祥龙运通</a>

                <a class="expItem" data-code="XYGJ">新元国际</a>

                <a class="expItem" data-code="XYT">希优特</a>

                <a class="expItem" data-code="ZY_XC">星辰快递</a>

                <a class="expItem" data-code="ZY_XDKD">迅达快递</a>

                <a class="expItem" data-code="ZY_XDSY">信达速运</a>

                <a class="expItem" data-code="ZY_XF">先锋快递</a>

                <a class="expItem" data-code="ZY_XGX">新干线快递</a>

                <a class="expItem" data-code="ZY_XIYJ">西邮寄</a>

                <a class="expItem" data-code="ZY_XJ">信捷转运</a>

            <li class=" clearfix">
                <span class="li-title">Y</span>

                <a class="expItem" data-code="AMAZON">亚马逊物流</a>

                <a class="expItem" data-code="EKM">易客满</a>

                <a class="expItem" data-code="IYDLYZ">意大利邮政</a>

                <a class="expItem" data-code="IYDNXYYZ">印度尼西亚邮政</a>

                <a class="expItem" data-code="IYDYZ">印度邮政</a>

                <a class="expItem" data-code="IYGYZ">英国邮政</a>

                <a class="expItem" data-code="IYLYZ">伊朗邮政</a>

                <a class="expItem" data-code="IYMNYYZ">亚美尼亚邮政</a>

                <a class="expItem" data-code="IYMYZ">也门邮政</a>

                <a class="expItem" data-code="IYNYZ">越南邮政</a>

                <a class="expItem" data-code="IYSLYZ">以色列邮政</a>

                <a class="expItem" data-code="IYTG">易通关</a>

                <a class="expItem" data-code="IYWWL">燕文物流</a>

                <a class="expItem" data-code="KDN">KDN</a>

                <a class="expItem" data-code="UC">优速快递</a>

                <a class="expItem" data-code="YADEX">源安达快递</a>

                <a class="expItem" data-code="YBG">洋包裹</a>

                <a class="expItem" data-code="YBJ">邮必佳</a>

                <a class="expItem" data-code="YCSY">远成速运</a>

                <a class="expItem" data-code="YCWL">远成物流</a>

                <a class="expItem" data-code="YD">韵达快递</a>

                <a class="expItem" data-code="YDH">义达国际物流</a>

                <a class="expItem" data-code="YDT">易达通</a>

                <a class="expItem" data-code="YFEX">越丰物流</a>

                <a class="expItem" data-code="YFHEX">原飞航物流</a>

                <a class="expItem" data-code="YFSD">亚风快递</a>

                <a class="expItem" data-code="YFSUYUN">驭丰</a>

                <a class="expItem" data-code="YHXGJSD">一号线国际速递</a>

                <a class="expItem" data-code="YJSD">银捷速递</a>

                <a class="expItem" data-code="YLJY">优联吉运</a>

                <a class="expItem" data-code="YLSY">亿领速运</a>

                <a class="expItem" data-code="YMDD">壹米滴答</a>

                <a class="expItem" data-code="YMWL">英脉物流</a>

                <a class="expItem" data-code="YODEL">YODEL</a>

                <a class="expItem" data-code="YSH">亿顺航</a>

                <a class="expItem" data-code="YSKY">音素快运</a>

                <a class="expItem" data-code="YTD">易通达</a>

                <a class="expItem" data-code="YTKD">运通快递</a>

                <a class="expItem" data-code="YTO">圆通速递</a>

                <a class="expItem" data-code="YUEDANYOUZ">约旦邮政</a>

                <a class="expItem" data-code="YUNDX">运东西网</a>

                <a class="expItem" data-code="YXWL">宇鑫物流</a>

                <a class="expItem" data-code="YYSD">鹰运速递</a>

                <a class="expItem" data-code="YZPY">邮政快递</a>

                <a class="expItem" data-code="ZY_ESONG">宜送转运</a>

                <a class="expItem" data-code="ZY_YGKD">优购快递</a>

                <a class="expItem" data-code="ZY_YJSD">友家速递(UC</a>

                <a class="expItem" data-code="ZY_YPW">云畔网</a>

                <a class="expItem" data-code="ZY_YQ">云骑快递</a>

                <a class="expItem" data-code="ZY_YSSD">优晟速递</a>

                <a class="expItem" data-code="ZY_YSW">易送网</a>

                <a class="expItem" data-code="ZY_YTUSA">运淘美国</a>

            <li class=" clearfix">
                <span class="li-title">Z</span>

                <a class="expItem" data-code="IZBLTYZ">直布罗陀邮政</a>

                <a class="expItem" data-code="IZLYZ">智利邮政</a>

                <a class="expItem" data-code="SJ">郑州速捷</a>

                <a class="expItem" data-code="ZENY">增益快递</a>

                <a class="expItem" data-code="ZH">中骅</a>

                <a class="expItem" data-code="ZJS">宅急送</a>

                <a class="expItem" data-code="ZMKM">芝麻开门</a>

                <a class="expItem" data-code="ZO">中欧</a>

                <a class="expItem" data-code="ZRSD">中睿速递</a>

                <a class="expItem" data-code="ZSKY">准实快运</a>

                <a class="expItem" data-code="ZTE">众通快递</a>

                <a class="expItem" data-code="ZTKY">中铁快运</a>

                <a class="expItem" data-code="ZTO">中通速递</a>

                <a class="expItem" data-code="ZTWL">中铁物流</a>

                <a class="expItem" data-code="ZTWY">中天万运</a>

                <a class="expItem" data-code="ZWSY">中外速运</a>

                <a class="expItem" data-code="ZWYSD">中外运速递</a>

                <a class="expItem" data-code="ZY_ZCSD">至诚速递</a>

                <a class="expItem" data-code="ZYWL">中邮物流</a>

                <a class="expItem" data-code="ZZJH">郑州建华</a>

        </ul>
        <div class="box"></div>
    </div>
</div>
<!--companys end-->
<!--搜索成功 start-->
<div class="query-outline hide " id="searchSuccess" >
    <div class="up-title">
        <ul>
            <li class="title-item expressTitle" ></li>
            <li class="title-item expressTel"><img src="/assets/OutInvoke/PC/images/phone.png" alt=""></li>
            <li class="title-item">
                <img src="/assets/OutInvoke/PC/images/internet.png" alt="">
                <a href="" target="_blank" class="expressWebSite">官网</a>
            </li>
        </ul>
    </div>
    <div class="store-content">
        <div class="sc-show">
            <ul id="ultrack">
            </ul>
        </div>
        <div class="tips_bottom2">物流信息由 <a class="col-common" href="http://kdniao.com/" target="_blank">快递鸟</a> 提供</div>
    </div>
</div>
<!--搜索成功 end-->
<!--搜索失败start-->
<div class="query-outline hide " id="searchFail">
    <div class="up-title">
        <ul>
            <li class="title-item expressTitle" >韵达快递</li>
            <li class="title-item expressTel"><img src="/assets/OutInvoke/PC/images/phone.png" alt="">电话：021-069365216</li>
            <li class="title-item">
                <img src="/assets/OutInvoke/PC/images/internet.png" alt="">
                <a href="" target="_blank" class="expressWebSite">官网</a>
            </li>
        </ul>
    </div>
    <div class="store-content">

        <span class="f24 error-title">抱歉,此单号暂无轨迹</span>
        <ul class="clearfix error-box">
            <li class="show-error error-icon1">
                运单号正确请稍后重试，可能是网络问题。 <br>或点击右上角快递公司官网地址进行查询。
            </li>
            <li class="show-error error-icon2">可能是运单号错误，<br> 请重新输入</li>
        </ul>
        <div class="tips_bottom2">物流信息由 <a class="col-common" href="http://kdniao.com/" target="_blank">快递鸟</a> 提供</div>
    </div>
</div>
<!--搜索失败end-->
</body>
<script src="{{url('js/jquery.min.js')}}"></script>
<script src="{{url('js/webchat.js')}}"></script>
<script src="{{url('js/SearchTrack.js')}}"></script>

</html>