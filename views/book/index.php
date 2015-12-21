<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php
Modal::begin([
    'header' => '<h2>Подробная информация</h2>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);

echo '<div id="modalContent"></div>';

Modal::end();
?>

<?php
$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'preview:image',
            [
                'label' => 'Превью',
                'format' => 'raw',
                'value' => function($data){
                    return Html::img('@web/uploads/'.$data->preview, [
                        'alt'=>$data->preview,
                        'style' => 'width:40px;',
                        'class' => 'biggerImg'
                    ]);
                },
            ],
            'author.last_name',
            'date:datetime',
            'created_at:datetime',
            // 'updated_at',
            // 'author_id',

           // ['class' => '\app\commands\ActionColumnForPjax'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}{link}',
                'buttons' => [
                    'view' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"></span>',
                            null,[
                                    'class' => 'modalButton',
                                    'title' => Yii::t('yii', 'View'),
                                    'aria-label' => Yii::t('yii', 'View'),
                                    'data-pjax' => '0',
                    'value' =>$url]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
