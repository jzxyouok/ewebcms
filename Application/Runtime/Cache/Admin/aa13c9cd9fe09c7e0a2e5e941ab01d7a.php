<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>软件中心CMS内容管理系统</title>

    <meta charset="UTF-8">
    <link href="/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/assets/css/page-min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/style.css"/>

    <script type="text/javascript" src="/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/Public//Js/common.js"></script>
    <style>
        body {
            width: 95%;
            margin: 0 auto;
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
            background: url(/Public/Images/x_bg.png) repeat-x;
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

        .dptstate {
            width: 95%;
            height: 280px;
            width: 100%;
            margin: 20px auto 20px;
        }

        #fyear, #fmonth, #fweek, #cyear, #cmonth, #cweek, #uyear, #umonth, #uweek {
            float: left;
            width: 32%;
        }

        #fmonth, #fweek, #cmonth, #cweek, #umonth, #uweek {
            margin-left: 20px;
        }

        .state {
            height: 280px;
        }
    </style>
</head>
<body>
<div class="dptstate">
    <div class="myinfo state">
        <div class="topbanner">
            用户发表文档统计
        </div>
        <div class="info">
            <!--对各部门信息进行统计-->

            <!--饼状图的容器-->
            <div id="uweek"></div>
            <div id="umonth"></div>
            <div id="uyear"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="dptstate">
    <div class="myinfo state">
        <div class="topbanner">
            一级部门发表文档统计信息
        </div>
        <div class="info">
            <!--对各部门信息进行统计-->

            <!--饼状图的容器-->
            <div id="fweek"></div>
            <div id="fmonth"></div>
            <div id="fyear"></div>

        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="dptstate">
    <div class="myinfo state">
        <div class="topbanner">
            二级部门发表文档统计信息
        </div>
        <div class="info">
            <!--对各部门信息进行统计-->
            <!--饼状图的容器-->
            <div id="cweek"></div>
            <div id="cmonth"></div>
            <div id="cyear"></div>
        </div>
    </div>
</div>


<script type="text/javascript" src="/Public/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/Public/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/Public/assets/js/config-min.js"></script>
<?php if(is_array($dptlist)): foreach($dptlist as $k=>$val): if(is_array($val)): $i = 0; $__LIST__ = $val;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $b = array('name' => $vo['f']['name'], 'fnum' => $vo['f']['fnumber']); $fdptnum[] = $b; unset($b); ?>
        <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i; $a = array('name' => $chd['name'], 'cnum' => $chd['cnumber']); $dptnum[] = $a; unset($a); endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>

    <?php $key=$k; ?>
    <script type="text/javascript">
        BUI.use('common/page');

        BUI.use('bui/chart', function (Chart) {
            var fchart = new Chart.Chart({
                render: "#f<?php echo ($key); ?>",
                width: 350,
                height: 330,
                title: {
                    text: "<?php echo ($key); ?>ly"
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
                            distance: 9,
                            label: {
                                //文本信息可以在此配置
                            },
                            renderer: function (value, item) { //格式化文本
                                return value + ' ' + (item.point.percent * "<?php echo ($newsnum[$key]); ?>").toFixed(2) + '篇';
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
            render: "#c<?php echo ($key); ?>",
            width: 350,
            height: 330,
            title: {
                text: "<?php echo ($key); ?>ly"
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
                        distance: 9,
                        label: {
                            //文本信息可以在此配置
                        },
                        renderer: function (value, item) { //格式化文本
                            return value + ' ' + (item.point.percent * "<?php echo ($newsnum[$key]); ?>").toFixed(2) + '篇';
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
        });
        chart.render();
        });

    </script>

    <?php unset($fdptnum); unset($dptnum); endforeach; endif; ?>

<?php if(is_array($usernum)): foreach($usernum as $key=>$vo): if(is_array($vo)): foreach($vo as $key1=>$vo1): $unum[]=array('name' => $key1,'unum' => $vo1); endforeach; endif; ?>
    <script>
        BUI.use('common/page');

        BUI.use('bui/chart',function (Chart) {

            var chart = new Chart.Chart({
                render : '#u<?php echo ($key); ?>',
                width : 350,
                height : 330,
                title : {
                    text : '<?php echo ($key); ?>ly'
                },
                legend : null ,//不显示图例
                seriesOptions : { //设置多个序列共同的属性
                    pieCfg : {
                        colors:[
                            '#7AC5CD',
                            '#EE3B3B',
                            '#FF7F00',
                            '#F1C40F',
                            '#E67E22',
                            '#1ABC9C',
                            '#2ECC71',
                            '#34495E',
                            '#95A5A6',
                            '#3498DB',
                            '#E74C3C',
                            '#9B59B6',
                        ],
                        allowPointSelect : true,
                        labels : {
                            distance : 20,
                            label : {
                                //文本信息可以在此配置
                            },
                            renderer : function(value,item){ //格式化文本
                                return value + ' ' + (item.point.percent * "<?php echo ($allnum); ?>").toFixed(2)  + '篇';
                            }
                        }
                    }
                },
                tooltip : {
                    pointRenderer : function(point){
                        return (point.percent * 100).toFixed(2)+ '%';
                    }
                },
                series : [{
                    type: 'pie',
                    name: '发表文档数',
                    data: [
                    <?php $nam = $unum[0]['name']; $num = $unum[0]['unum']; echo"{name:'$nam',y:$num,sliced:true,selected:true},"; ?>
            <?php $count = count($unum); for ($i = 1; $i < $count; $i++) { $name = $unum[$i]['name']; $unum = $unum[$i]['unum']; echo " ['$name',  $unum],"; } ?>


            ]
        }]
        });

        chart.render();
        });
    </script>

    <?php unset($unum); endforeach; endif; ?>

</body>
</html>