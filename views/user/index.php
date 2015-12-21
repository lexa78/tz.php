<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Зарегистрированые пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-title-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Зарегистрировать нового пользователя', ['reg'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email',
            [
                'attribute' => 'role',
                'format' => 'text',
                'value'=>function ($data) {
                    return ($data->role == 10) ? 'user' : 'admin';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
