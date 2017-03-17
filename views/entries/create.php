<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Entries */

$this->title = Yii::t('app', 'New Time Entry');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
