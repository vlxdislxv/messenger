<?php

use app\modules\user\assets\DefaultAsset;
use \yii\helpers\Html;

$theme = DefaultAsset::register($this);
use \yii\widgets\ActiveForm;

$this->title = 'Sign Up';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="limiter">
    <div class="container-login100" style="background-image: url('<?=$theme->baseUrl?>/images/bg-01.jpg');">
        <div class="wrap-login100">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'login100-form validate-form'
                ]
            ]); ?>
            <span class="login100-form-logo">
                <i class="zmdi zmdi-landscape"></i>
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
                Sign Up
            </span>

            <?= $form->field($model, 'email', [
                'template' => '
                        <div data-validate="Enter Email" class="wrap-input100 validate-input">{input}
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>'])
                ->textInput([
                    'class' => 'input100',
                    'placeholder' => 'Enter Email',
                ]) ?>

            <?= $form->field($model, 'username', [
                'template' => '
                        <div data-validate="Enter Username" class="wrap-input100 validate-input">{input}
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>'])
                ->textInput([
                    'class' => 'input100',
                    'placeholder' => 'Enter Username',
                ]) ?>


            <?= $form->field($model, 'password', [
                'template' => '
                        <div data-validate="Enter Password" class="wrap-input100 validate-input">{input}
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>'])
                ->passwordInput([
                    'class' => 'input100',
                    'placeholder' => 'Enter Password',
                ]) ?>

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Sign Up
                </button>
            </div>

            <div class="text-center p-t-30">
                <a class="txt1" href="/user/login">
                    Log In?
                </a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>