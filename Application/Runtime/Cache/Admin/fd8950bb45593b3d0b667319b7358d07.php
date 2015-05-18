<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>软件中心CMS内容管理系统</title>

    <meta charset="UTF-8">
    <link href="/ewebcmsxgc/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css"/>
    <link href="/ewebcmsxgc/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css"/>
    <link href="/ewebcmsxgc/Public/assets/css/page-min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/style.css"/>

    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/common.js"></script>
    <style>
        body {
            width: 95%;
            margin: 0 auto;
        }

        .box_left {
            width: 49%;
            float: left;
            margin: 20px 0px;
            overflow: visible;
        }


        .box_right {
            width: 49%;
            float: right;
            margin: 20px 0px;
            overflow: visible;

        }

        .myinfo {
            height: 200px;
            margin-bottom: 10px;
            padding-bottom: 20px;
            overflow: visible;
            width: 100%;
            border: 1px solid #d1dee2;
            border: 1px solid #d1dee2;
            background: #fff;
            -moz-border-radius: 3px;
            border-radius: 8px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
        }

        .topbanner {
            background-color: #fff;
            height: 20px;
            border-bottom: 1px solid #c7d8ea;
            color: #3a6ea5;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            background: url(/ewebcmsxgc/Public/Images/x_bg.png) repeat-x;
            height: 26px;
            line-height: 28px;
            padding: 0 10px;
        }

        .info {
            margin-top: 10px;
            margin-left: 10px;
            font-size: 14px;
            /*overflow: visible;*/
            overflow: hidden;
        }

    </style>
</head>
<body>
<div class="box_left">
    <div class="myinfo">
        <div class="topbanner">个人信息
        </div>
        <div class="info">
            <table class="table table-bordered table-striped definewidth">
                <colgroup>
                    <col class="span1">
                    <col class="span7">
                </colgroup>
                <tbody>
                <tr>
                    <td>
                        <span class="label label-success">用户名：</span>
                    </td>
                    <td><?php echo ($user["name"]); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-info">角色：</span>
                    </td>
                    <td><?php echo ($user["rolename"]); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-success">上次登录时间:</span>

                    </td>
                    <td><?php echo (date("y-m-d H:i:s",$user["ldate"])); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-info">上次登录IP:</span>
                    </td>
                    <td><?php echo ($user["lip"]); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-success">本次登录IP:</span>
                    </td>
                    <td><?php echo ($user["cip"]); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="myinfo">
        <div class="topbanner">文档信息</div>
        <div class="info">
            <table class="table table-bordered table-striped definewidth">
                <colgroup>
                    <col class="span1">
                    <col class="span7">
                </colgroup>
                <tbody>
                <tr>
                    <td>
                        <span class="label label-success">文档类别总数：</span>
                    </td>
                    <td><?php echo ($classnum); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-info">新增文章数量：</span>
                    </td>
                    <td><?php echo ($newsadd); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-success">总文章数量:</span>

                    </td>
                    <td><?php echo ($newsnum); ?></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div class="box_right">
    <div class="myinfo">
        <div class="topbanner">会员留言</div>
        <div class="info">
            <table class="table table-bordered table-striped definewidth">
                <colgroup>
                    <col class="span1">
                    <col class="span7">
                </colgroup>
                <tbody>
                <tr>
                    <td>
                        <span class="label label-success">新增会员数：</span>
                    </td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-info">会员总数：</span>
                    </td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-success">新增留言:</span>

                    </td>
                    <td><?php echo ($msgadd); ?></td>
                </tr>
                <tr>
                    <td>
                        <span class="label label-info">留言总数:</span>
                    </td>
                    <td><?php echo ($msgnum); ?></td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="myinfo">
        <div class="topbanner">其他信息</div>
        <div class="info">
            <table class="table table-bordered table-striped definewidth">
                <colgroup>
                    <col class="span1">
                    <col class="span7">
                </colgroup>
                <tbody>
                <tr>
                    <td>
                        <span class="label label-success">访客流量查看</span>
                    </td>
                    <td><a href="http://www.baidu.com" target="_black">CNZZ</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>


</body>


</html>
<script type="text/javascript" src="/ewebcmsxgc/Public/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/ewebcmsxgc/Public/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/ewebcmsxgc/Public/assets/js/config-min.js"></script>
<script type="text/javascript">
    BUI.use('common/page');

    BUI.use('bui/chart', function (Chart) {
        var fchart = new Chart.Chart({
            render: '#fcanvas',
            width: 350,
            height: 330,
            title: {
                text: '一级部门发表文档统计'
            },
            legend: null,//不显示图例
            seriesOptions: { //设置多个序列共同的属性
                pieCfg: {
                    colors: [
                        '#1ABC9C',
                        '#2ECC71',
                        '#3498DB',
                        '#E74C3C',
                        '#F1C40F',
                        '#E67E22',
                        '#9B59B6',
                        '#34495E',
                        '#95A5A6'
                    ],
                    allowPointSelect: true,
                    labels: {
                        distance: 8,
                        label: {
                            //文本信息可以在此配置
                        },
                        renderer: function (value, item) { //格式化文本
                            return value + ' ' + (item.point.percent * "<?php echo ($newsnum); ?>").toFixed(2) + '篇';
                        }
                    }
                }
            },
            tooltip: {
                pointRenderer: function (point) {
                    return (point.percent * 100).toFixed(2) + '%';
                }
            },
            series: [{
                type: 'pie',
                name: '发表文档数',
                data: [
                <?php $nam = $fdptnum[0]['name']; $num = $fdptnum[0]['fnum']; echo "{name:'$nam',y:$num,sliced:true,selected:true},"; ?>
                <?php $count = count($fdptnum); for ($i = 1; $i < $count; $i++) { $name = $fdptnum[$i]['name']; $fnum = $fdptnum[$i]['fnum']; echo"['$name',  $fnum],"; } ?>
                        ]
                        }]
                });
    fchart.render();

    var chart = new Chart.Chart({
        render: '#canvas',
        width: 350,
        height: 330,
        title: {
            text: '二级部门发表文档统计'
        },
        legend: null,//不显示图例
        seriesOptions: { //设置多个序列共同的属性
            pieCfg: {
                colors: [
                    '#F1C40F',
                    '#E67E22',
                    '#9B59B6',
                    '#34495E',
                    '#95A5A6',
                    '#1ABC9C',
                    '#2ECC71',
                    '#3498DB',
                    '#E74C3C',
                ],
                allowPointSelect: true,
                labels: {
                    distance: 8,
                    label: {
                        //文本信息可以在此配置
                    },
                    renderer: function (value, item) { //格式化文本
                        return value + ' ' + (item.point.percent * "<?php echo ($newsnum); ?>").toFixed(2) + '篇';
                    }
                }
            }
        },
        tooltip: {
            pointRenderer: function (point) {
                return (point.percent * 100).toFixed(2) + '%';
            }
        },
        series: [{
            type: 'pie',
            name: '发表文档数',
            data: [
            <?php $nam = $dptnum[0]['name']; $num = $dptnum[0]['cnum']; echo"{name:'$nam',y:$num,sliced:true,selected:true},"; ?>
            <?php $count = count($dptnum); for ($i = 1; $i < $count; $i++) { $name = $dptnum[$i]['name']; $cnum = $dptnum[$i]['cnum']; echo " ['$name',  $cnum],"; } ?>
    ]
    }]
    })
    ;
    chart.render();
    })
    ;

</script>