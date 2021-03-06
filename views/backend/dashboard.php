<?php partialView('_dash_header');?>
  <body>
    <?php partialView('_dash_sidebar');?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>
            <?php partialView('_notification');?>
            <div class="well">
                <div class="alert alert-info">
                    <?php printf("Your are logged in as <strong> %s </strong>", $_SESSION['user']['username']);?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php partialView('_dash_footer');?>
