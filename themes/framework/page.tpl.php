<?PHP 
    //echo arg(1);
if ($user->uid && arg(4)!='edit' && arg(1)!='new-ticket'): 

?>
    <nav class="navbar navbar-inverse" style="margin:0px; height:46.883 px; ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?PHP echo url("project/select-project"); ?>">Ticket Manager</a>
            </div>
                <ul id="home_menu" class="nav navbar-nav">
                    <li ><a href="<?PHP echo url("project/select"); ?>">Dashboard</a></li>
                    <li><a href="<?PHP echo url("ticket/assigned/view-all"); ?>?page=1">View All</a></li>
                    <li><a href="<?PHP echo url("ticket/new-ticket"); ?>">Create</a></li>
                <?PHP endif ?>
                <?PHP if ($GLOBALS['role'] == 'administrator' && arg(4)!='edit' && arg(1)!='new-ticket'): ?>
                    <li><a href="<?PHP echo url("project/new-project"); ?>">Create Project</a></li>
                <?PHP endif ?>
                <?PHP if ($user->uid && arg(4)!='edit' && arg(1)!='new-ticket'): ?>
                    <li><a href="<?PHP echo url("project/add-users"); ?>">Add Users</a></li>

                    <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Page 1-1</a></li>
                      <li><a href="#">Page 1-2</a></li>
                      <li><a href="#">Page 1-3</a></li>
                    </ul>
                   <form  action="<?php $_SERVER['PHP_SELF']; ?>" method = "POST">
                  <select name = "project"  onchange="this.form.submit();"> <?php echo get_projects($_SESSION['project']); ?>
                  </select></form>
                  </li> align-content: center;-->
                    <li class="form-group"  style =" padding-top:8px; margin:0px; border:0px;  ">
                        <form role = "form" action="<?php $_SERVER['PHP_SELF']; ?>" method = "POST">
                            <select name = "project"  class="form-control" onchange="this.form.submit();"> <?php echo get_projects($_SESSION["project"]); ?>
                            </select></form>            
                    </li>    
                    <!--<li><a href="#">Page 2</a></li>-->
                    <li><a href="<?PHP echo url("user/logout") ?>">Log out</a></li>
                </ul>
            </div>
    </nav>
<?PHP endif ?>
    

    <div id="full-container" class="col-md-12 complete-container">

    <?php
if ($user->uid && arg(4)!='edit' && arg(1)!='select' && arg(1)!='new-ticket'): {
        ?>  
        <nav id="navbar-inverse-sidebar" class='row col-md-2 navbar navbar-inverse sidebar' role='navigation' style="padding:0px; margin-right:6px;">
            <div class='container-fluid'>
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#bs-sidebar-navbar-collapse-1'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <!--<a class="navbar-brand" href="#"></a-->
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class='collapse navbar-collapse' id='bs-sidebar-navbar-collapse-1'>
                    <div id="side_menu">
                        <ul class='nav navbar-nav'>
                            <li ><a href='<?PHP echo url('ticket/assigned/view-all'); ?>?page=1'>My Open Issues<span style='font-size:16px;' class='pull-right hidden-xs showopacity glyphicon glyphicon-folder-open'></span></a></li>
                            <li ><a href='<?PHP echo url('ticket/reported/view-all'); ?>?page=1'>Reported By Me<span style='font-size:16px;' class='pull-right hidden-xs showopacity glyphicon glyphicon-user'></span></a></li>
                            <li ><a href='<?PHP echo url('ticket/assigned/view-all'); ?>?page=1'>All Issues<span style='font-size:16px;' class='pull-right hidden-xs showopacity fa fa-files-o'></span></a></li>
                            <li><a href="<?php echo url('ticket/new-ticket'); ?>">Create Issue<span style='font-size:16px;' class='pull-right hidden-xs showopacity fa fa-plus'></span></a></li>
                            <li ><a href="<?PHP echo url('ticket/resolved/view-all'); ?>?page=1">Resolved Issues<span style='font-size:16px;' class='pull-right hidden-xs showopacity fa fa-archive'></span></a></li>
                            <li ><a href="#">Updated Recently<span style='font-size:16px;' class='pull-right hidden-xs showopacity fa fa-floppy-o'></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    <?php } endif ?>

<!--
        <?php
// if ($breadcrumb): print $breadcrumb; endif;
        ?>-->
<!--style="width:100%;" -->
<div class="container col-md-10" >

    <div class="row" >
        <?php print render($page['header']); ?>
        <div class="col-md-10"></div><div class="col-md-5"></div>
        <div class="row col-md-5 pagination">
        <?php  $uri = $_SERVER['REQUEST_URI'];
            if(strpos($uri, 'view-all') !== false && arg(4)!='edit'){
                $pagination = filter_apply_form_submit(); print render($pagination);
            }
                    //echo 'true';
            
             ?>
        </div>
        <div id="main" role="main" class="col-md-12">
            <?php print $messages; ?>
            <a id="main-content"></a>
            <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
            <?php print render($title_prefix); ?>

            <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>

            <?php print render($title_suffix); ?>
            <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            <?php print render($page['content']); ?>
        </div> <!-- /#main -->

    </div> <!-- /#row -->

</div> <!-- /#container -->
</div>
<footer id="footer" role="contentinfo" class="clearfix">
    <?php print render($page['footer']) ?>
<?php print $feed_icons ?>
</footer> <!-- /#footer -->
