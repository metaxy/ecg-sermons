<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
//$this->registerCssFile('http://fonts.googleapis.com/css?family=Roboto:400,500,700');
if (Yii::$app->user->can('useMessages')) {
    $messageCount = \app\models\Message::myUnreadMessagesCount();
    $messageBadge = $messageCount > 0 ? '<span class="badge badge-xs badge-pink">' . $messageCount . '</span>' : '';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-32x32.png"
          sizes="32x32">
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-16x16.png"
          sizes="16x16">
    <link rel="shortcut icon" type="image/x-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon.ico"/>
    <link rel="icon" type="image/x-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon.ico"/>
    <link rel="icon" type="image/gif" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon.gif"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon.png"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-57x57.png"
          sizes="57x57"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-60x60.png"
          sizes="60x60"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-72x72.png"
          sizes="72x72"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-76x76.png"
          sizes="76x76"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-114x114.png"
          sizes="114x114"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-120x120.png"
          sizes="120x120"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-128x128.png"
          sizes="128x128"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-144x144.png"
          sizes="144x144"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-152x152.png"
          sizes="152x152"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-180x180.png"
          sizes="180x180"/>
    <link rel="apple-touch-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/apple-touch-icon-precomposed.png"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-16x16.png"
          sizes="16x16"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-32x32.png"
          sizes="32x32"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-96x96.png"
          sizes="96x96"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-160x160.png"
          sizes="160x160"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-192x192.png"
          sizes="192x192"/>
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon-196x196.png"
          sizes="196x196"/>
    <meta name="msapplication-TileImage" content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-144x144.png"/>
    <meta name="msapplication-TileColor" content="#4267a0"/>
    <meta name="msapplication-navbutton-color" content="#ffffff"/>
    <meta name="msapplication-square70x70logo"
          content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-70x70.png"/>
    <meta name="msapplication-square144x144logo"
          content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-144x144.png"/>
    <meta name="msapplication-square150x150logo"
          content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-150x150.png"/>
    <meta name="msapplication-wide310x150logo"
          content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-310x150.png"/>
    <meta name="msapplication-square310x310logo"
          content="<?= Yii::getAlias('@web') ?>/images/favicon/win8-tile-310x310.png"/>

    <link rel="manifest" href="<?= Yii::getAlias('@web') ?>/images/favicon/manifest.json">
    <link rel="mask-icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/safari-pinned-tab.svg" color="#5b9ad5">
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/images/favicon/favicon.ico">
    <meta name="msapplication-config" content="<?= Yii::getAlias('@web') ?>/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#0073c7">
    <base href="<?= Yii::getAlias('@web') ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(\Yii::$app->name) ?> - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php
     $messages = include(\Yii::getAlias('@app')."/messages/".Yii::$app->language."/js.php");
    ?>
    <script>
        var bkoMessages = <?= json_encode($messages)?>;

    </script>
    <?php
    $this->registerJs("bootbox.setDefaults({locale: '".Yii::$app->language."'});", \yii\web\View::POS_READY, 'bootbox-i18n');
    ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php if (!Yii::$app->user->isGuest) { ?>

    <header id="topnav">

        <div class="topbar-main">
            <div class="container">

                <a href="/" class="logo"><img src="<?= Yii::getAlias('@web') ?>/images/bko-logo-white.png"
                                                  height="28"> <span><?= t('menu.name') ?></span></a>

                <div id="navigation">
                    <?= yii\widgets\Menu::widget([
                        'options' => ['class' => 'navigation-menu'],
                        'encodeLabels' => false,
                        'submenuTemplate' => "\n<ul class='submenu'>\n{items}\n</ul>\n",
                        'items' => [
                            [
                                'label' => '<i class="mdi mdi-view-dashboard"></i> ' . t('menu.dashboard'),
                                'url' => ['site/index']
                            ],
                            [
                                'label' => '<i class="mdi mdi-account"></i> ' . t('menu.users'),
                                'url' => ['user/list'],
                                'visible' => Yii::$app->user->can('manageSchool')
                            ],
                            [
                                'label' => '<i class="mdi mdi-chair-school"></i> ' . t('menu.courses'),
                                'url' => ['course/list'],
                                'visible' => Yii::$app->user->can('manageClass'),
                            ],
                            [
                                'label' => '<i class="mdi mdi-clipboard-outline"></i> ' . t('menu.tasks'),
                                'url' => ['homework/list'],
                                'visible' => Yii::$app->user->can('submitTask'),
                            ],
                            [
                                'label' => '<i class="mdi mdi-clipboard-outline"></i> ' . t('menu.tasks'),
                                'url' => ['task/list'],
                                'visible' => Yii::$app->user->can('manageClass'),
                            ],
                            [
                                'label' => '<i class="mdi mdi-file-tree"></i> ' . t('menu.upload'),
                                'url' => ['upload/list'],
                                'visible' => Yii::$app->user->can('manageClass'),
                            ],
                            [
                                'label' => '<i class="mdi mdi-email"></i> ' . t('menu.message') . $messageBadge,
                                'url' => ['message/inbox'],
                                'visible' => Yii::$app->user->can('useMessages'),
                            ],
                            [
                                'label' => '<i class="mdi mdi-account"></i>' . t('menu.account'),
                                'options' => ['class' => 'has-submenu hidden-xs hidden-sm'],
                                'url' => ['user/profile'],
                                'items' => [
                                    ['label' => '<i class="mdi mdi-account-settings"></i> ' . t('menu.profile'), 'url' => ['user/profile',]],
                                    ['label' => '<i class="mdi mdi-logout"></i> ' . t('menu.logout', ['name' => Yii::$app->user->identity->firstName]), 'url' => ['site/logout']],
                                ],
                                'visible' => !Yii::$app->user->isGuest
                            ],
                            [
                                'label' => '<i class="mdi mdi-account"></i>' . t('menu.account'),
                                'options' => ['class' => 'hidden-md hidden-lg'],
                                'url' => ['user/profile'],
                                'visible' => !Yii::$app->user->isGuest
                            ],
                            [
                                'label' => '<i class="mdi mdi-logout"></i>' . t('menu.logout', ['name' => Yii::$app->user->identity->firstName]),
                                'options' => ['class' => 'hidden-md hidden-lg'],
                                'url' => ['site/logout'],
                                'visible' => !Yii::$app->user->isGuest
                            ],
                            ['label' => 'Meine', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ],
                    ]); ?>
                </div>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
        </div>


    </header>

    <div class="wrapper">
        <main class="main-container">
            <div class="container">
                <?php if (!empty($this->params['alerts'])): ?>

                    <?php foreach ($this->params['alerts'] as $alert) {
                        echo "<div class='{$alert['css']}'>";
                        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
                        echo "<i class='mdi mdi-{$alert['icon']}'></i> ";
                        echo $alert['text'];
                        echo "</div>";
                    } ?>


                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>

                        <?php if (\Yii::$app->session->get('prev_user_id') && \Yii::$app->user->id != \Yii::$app->session->get('prev_user_id')) {
                            echo "<div class=\"alert alert-info\">";
                            echo t('site.youAre', ['name' => \app\helpers\Access::user()->fullName]);
                            echo " ";
                            echo "<a class=\"alert-link\" href='" . \yii\helpers\Url::to(['user/impersonate', 'id' => \Yii::$app->session->get('prev_user_id')]) . "'>" . t('site.undoImpersonate') . "</a>";
                            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        if (!isset($this->params['customTitle'])) {
                            echo '<h2 class="m-b-20">' . $this->title . '</h2>';
                        }
                        ?>
                    </div>
                    <?php if (!empty($this->params['actions'])): ?>
                        <div class="col-sm-6">
                            <div class="actions">


                                <?= yii\bootstrap\Nav::widget([
                                    'options' => ['class' => 'nav-pills2'],
                                    'encodeLabels' => false,
                                    'items' => $this->params['actions'],
                                ]); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?= $content; ?>

            </div>
            <?= $this->render('sidebar_right') ?>
        </main>

    </div>
    <?php
        if(\app\helpers\Access::demo()) {
            echo '<div class="banner-bottom alert alert-dismissible">';

            echo t('demo.thisIsDemo');
            echo "<a href='http://bibelkunde.online/site/register' class='btn btn-danger'>";
            echo t('demo.register');
            echo "</a>";
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            echo '</div>';
      }
    ?>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <h4><i class="mdi mdi-information"></i> <?= t('site.about')?></h4>
                    <p>&copy; Bibelkunde.online <?= date('Y') ?></p>
                    <?php
                    if (\app\helpers\Access::can(\app\enums\Permission::MANAGE_SCHOOL)) {
                        echo "<p><a href='https://github.com/ebtc/bko3/commit/".\Yii::$app->params['version']."' >Version</a></p>";
                    }
                    ?>
                </div>
                <div class="col-md-4 col-xs-12">
                    <h4><i class="mdi mdi-contact-mail"></i> <?= t('site.contact') ?></h4>
                    <p>
                        <?= t('site.contact.text', ['email' => \Yii::$app->params['adminEmail']]); ?>

                    </p>
                </div>
                <div class="col-md-4 col-xs-12">
                    <h4><i class="mdi mdi-bug"></i> <?= t('site.bugReport') ?></h4>
                    <p>
                        <?= t('site.bugReport.text', ['email' => \Yii::$app->params['bugsEmail']]); ?>

                    </p>
                </div>
            </div>

        </div>
    </footer>

<?php } else {
    echo $content;
} ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
