<?php

use app\modules\user\assets\DefaultAsset;
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;

$theme = DefaultAsset::register($this);

$this->title = 'Login';

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
    <div class="container-login100" style="background-image: url('<?= $theme->baseUrl ?>/images/bg-01.jpg');">
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
                Log in
            </span>

            <?= $form->field($model, 'login', [
                'template' => '
                        <div data-validate="Enter Login" class="wrap-input100 validate-input">{input}
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>'])
                ->textInput([
                    'class' => 'input100',
                    'placeholder' => 'Enter Login',
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


            <div class="contact100-form-checkbox">
                <input class="input-checkbox100" id="ckb1" type="checkbox" name="LoginForm[rememberMe]" value="1">
                <label class="label-checkbox100" for="ckb1">
                    Remember me
                </label>
            </div>

            <div class="container-login100-form-btn">
                <button class="login100-form-btn">
                    Login
                </button>
            </div>

            <div class="text-center p-t-30">
                <a class="txt1" href="/user/signup">
                    Sign Up?
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