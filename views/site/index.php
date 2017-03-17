<?php

/* @var $this yii\web\View */

$this->title = 'TimeKeeper';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=Yii::t('app','Welcome!');?></h1>

        <?=\yii\bootstrap\Html::a(Yii::t('app','Add Time Entry'),'entries/create',['class'=>'btn btn-lg btn-success']);?>
    </div>
</div>
