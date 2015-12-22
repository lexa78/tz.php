<?php

use app\models\Author;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

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
$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Поиск</div>

                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['method' => 'get']); ?>

                        <?= $form->field($searchModel, 'name'); ?>

                        <?= $form->field($searchModel, 'author.last_name')->dropDownList(ArrayHelper::map(Author::find()->all(), 'last_name', 'last_name')); ?>

                        <?= $form->field($searchModel, 'date')->widget(DatePicker::className(),
                            [
                                'language' => 'ru',
                                'name' => 'date',
                                'dateFormat' => 'php:d F Y',
                            ]); ?>

                        <?= $form->field($searchModel, 'after_date')->widget(DatePicker::className(),
                            [
                                'language' => 'ru',
                                'name' => 'after_date',
                                'dateFormat' => 'php:d F Y',
                            ]); ?>

                        <div class="form-group">
                            <?= Html::submitButton('Искать', ['class' => 'btn btn-info']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    //        'date:datetime',
            ['attribute' => 'date',
            'format' => ['date', 'php:d F Y']],

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
