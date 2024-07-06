<?php

/** @var View $this */
/** @var string $content */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?= Yii::$app->homeUrl ?>">
                <?= Yii::$app->name ?>
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="<?= Yii::$app->homeUrl ?>">Home</a>
                <a class="navbar-item" href="<?= Url::to(['/admin/index', 'token' => 'xyz123']) ?>">Admin</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php try {
            echo Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]);
        } catch (Throwable $e) { ?>
            <div class="notification is-danger">
                <p>Breadcrumbs rendering failed: <?= Html::encode($e->getMessage()) ?></p>
            </div>
        <?php } ?>
        <?php try {
            echo $content;
        } catch (Throwable $e) { ?>
            <div class="notification is-danger">
                <p>Content rendering failed: <?= Html::encode($e->getMessage()) ?></p>
            </div>
        <?php } ?>
    </div>
</div>

<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>&copy; Artem Rytikoff <?= date('Y') ?></strong>
        </p>
        <p>
            Powered by <a href="https://www.yiiframework.com/" rel="external">Yii Framework</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.3/dist/cdn.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
