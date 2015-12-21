<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TicketTitle */

$this->title = 'Регистрация нового пользователя';
//$this->params['breadcrumbs'][] = ['label' => 'Ticket Titles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-title-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
