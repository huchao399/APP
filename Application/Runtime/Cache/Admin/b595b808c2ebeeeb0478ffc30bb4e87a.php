<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">

<title>明日科技后台</title>
<link href="/APP/Public/css/module.css" rel="stylesheet"/>

<link href="/APP/Public/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
<link href="/APP/Public/font-awesome/css/font-awesome.css?v=4.3.0" rel="stylesheet">


<link href="/APP/Public/css/animate.css" rel="stylesheet">
<link href="/APP/Public/css/admin-style.css?v=2.2.0" rel="stylesheet">

<!-- Mainly scripts -->
<script src="/APP/Public/js/jquery-2.1.1.min.js"></script>
<script src="/APP/Public/js/bootstrap.min.js?v=3.4.0"></script>



<!--Layer-->
<script src="/APP/Public/static/layer/layer.js"></script>

<script type="text/javascript" src="/APP/Public/js/admin.js"></script>

<script src="/APP/Public/js/jquery.metisMenu.js"></script>







</head>
<body>
<div id="wrapper">
    <script>
    $(function(){
        var controller_name = "<?php echo CONTROLLER_NAME;?>";
        var nav     = $('.nav-second-level a');
        nav.each(function(){
            var url = $(this).attr('href');
            console.log(url);
            if(url.indexOf('/'+controller_name) > 0){
                $(this).parent().addClass('active');
                return false;
            }
        });
    });
</script>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header" style="padding: 25px 20px;">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" height="60px" src="/APP/Public/images/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo (session('admin_username')); ?></strong>
                         </span>  <span class="text-muted text-xs block"><?php if(($_SESSION['admin_id']) == "1"): ?>超级管理员<?php else: ?>管理员<?php endif; ?> <b class="caret"></b></span> </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo U('Index/changePassword');?>">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Public/logout');?>">安全退出</a>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    MR
                </div>
            </li>
            <li class="active">
                <a href="#"><i class="fa fa-edit" style="width: 18px"></i> <span class="nav-label">管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo U('HighLevel/lists');?>">高级分类</a></li>
                    <li><a href="<?php echo U('MiddleLevel/lists');?>">中级分类</a></li>
                    <li><a href="<?php echo U('ElementaryLevel/lists');?>">初级分类</a></li>
                    <li><a href="<?php echo U('DataList/lists');?>">数据管理</a></li>
                    <li><a href="<?php echo U('Hot/lists');?>">热门管理</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>





    
    <div id="page-wrapper" class="gray-bg dashbard-1">
         <!--顶部-->
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>高级分类管理</h5> <!--标题-->
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <!--搜索开始-->
                                <!--<form action="/APP/index.php/Admin/Index/index.html" method="post" id="search">-->
                                <!--<div class="search" style="padding-left: 16px">-->
                                <!--<select name="course_type" id="course_id" class="col-sm-2">-->
                                <!--<option value="">请选择课程类型</option>-->
                                <!--<option value="0" <?php if(($course_type === 0)): ?>selected<?php endif; ?> >特训营</option>-->
                                <!--<option value="1" <?php if(($course_type === 1)): ?>selected<?php endif; ?> >体系课程</option>-->
                                <!--<option value="2" <?php if(($course_type === 2)): ?>selected<?php endif; ?> >实战课程</option>-->
                                <!--</select>-->
                                <!--<select name="category_id" id="" class="col-sm-2">-->
                                <!--<option value="0">请选择课程分类</option>-->
                                <!--<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                                <!--<option value="<?php echo ($vo["entity_id"]); ?>" <?php if(($vo["entity_id"] == $category_id)): ?>selected<?php endif; ?>-->
                                <!--><?php echo ($vo["cate_name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                                <!--</select>-->
                                <!--<div class="col-sm-3 input-group">-->
                                <!--<input type="text" class="form-control" placeholder="请输入课程名或者老师名" name="keyword" value="<?php echo ($keyword); ?>">-->
                                <!--<span class="input-group-btn">-->
                                <!--<button type="submit" class="btn btn-sm btn-primary" style="height: 34px"> 搜索</button>-->
                                <!--</span>-->
                                <!--</div>-->
                                <!--</div>-->
                                <!--</form>-->
                                <!--搜索结束-->

                                <div class="col-sm-4">
                                    <div class="input-button">
                                        <a href="<?php echo U('addCourse');?>">
                                            <button class="btn btn-primary add" type="button"><i class="fa fa-plus"></i>&nbsp;新增
                                            </button>
                                        </a>
                                        <button class="btn btn-warning delete-all" type="button" url="<?php echo U('delAll');?>"><i
                                                class="fa fa-minus "></i>&nbsp;删除
                                        </button>
                                        <button class="btn btn-info    confirm updateSort" type="button"><i
                                                class="fa fa-pencil "></i>&nbsp;修改排序
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!--表格开始    -->
                            <form action="<?php echo U(GROUP_NAME.'/Course/updateSort');?>" method="post" name="updateSort"
                                  id="updateSort">
                                <input type="hidden" name="page_num" value="<?php echo ($_GET['p']); ?>"/>
                                <div class="table-responsive">
                                    <table class="table  table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 35px;">
                                                <input type="checkbox" id="checkAll" class="check-all">
                                                <label for="checkAll"></label>
                                            </th>
                                            <th>课程ID</th>
                                            <th>课程名称</th>
                                            <th>主讲教师</th>
                                            <th>课程分类</th>
                                            <th>是否推荐</th>
                                            <th>排序</th>
                                            <th>课程类型</th>
                                            <th>等级</th>
                                            <th style="width: 100px">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(is_array($course)): foreach($course as $key=>$v): ?><tr>
                                                <td>
                                                    <input class="ids regular-checkbox" type="checkbox"
                                                           value="<?php echo ($v["entity_id"]); ?>" name="ids[]"
                                                           id="check_<?php echo ($v["entity_id"]); ?>">
                                                    <label for="check_<?php echo ($v["entity_id"]); ?>"></label>
                                                </td>
                                                <td> <?php echo ($v["entity_id"]); ?></td>
                                                <td> <?php echo ($v["course_name"]); ?></td>
                                                <td> <?php echo ($v["main_teacher"]); ?></td>
                                                <td>
                                                    <?php if(is_array($category)): foreach($category as $key=>$vo): if(($vo['entity_id'] == $v['category_id'])): echo ($vo["cate_name"]); endif; endforeach; endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($v['isRecommend'] >= 1): ?>是
                                                        <?php else: ?>
                                                        否<?php endif; ?>
                                                </td>
                                                <td class="sort"><input type="text" value="<?php echo ($v["sort"]); ?>"
                                                                        style="width:80px"/></td>
                                                <td>
                                                    <?php switch($v["course_type"]): case "0": ?>特训营<?php break;?>
                                                        <?php case "1": ?>体系课程<?php break;?>
                                                        <?php case "2": ?>实战课程<?php break; endswitch;?>
                                                </td>
                                                <td> <?php echo ((isset($v["level_price"]["level_name"]) && ($v["level_price"]["level_name"] !== ""))?($v["level_price"]["level_name"]):'无'); ?></td>
                                                <td style="width: 80px"><a
                                                        href="<?php echo U(GROUP_NAME.'/Course/edit','id='.$v['entity_id']);?>">编辑</a>
                                                    <a class="confirm"
                                                       href="<?php echo U(GROUP_NAME.'/Course/delete','id='.$v['entity_id']);?>">删除</a>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                    <!--分页开始-->
                                    <div style="padding-top:15px;float: right; ">
                                        <div class="page"><?php echo ($page); ?></div>
                                    </div>
                                    <!--分页结束-->
                                </div>
                            </form>
                            <!--表格结束-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--尾部-->
        
    </div>

    <script type="text/javascript">
        //修改排序
        $('.input-button .updateSort').click(function () {
            var ids = $("input:checked");
            if (!ids.length) {
                layer.msg('请选择操作数据');
                return false;
            }
            ids.each(function () {
                var sort = $(this).parent().siblings('.sort').children().attr('name', "sort[]");
            });
            $('#updateSort').submit();
        });

    </script>


</div>
</body>
</html>