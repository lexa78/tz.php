<?php

use himiklab\thumbnail\EasyThumbnailImage;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin()?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php
    echo EasyThumbnailImage::thumbnailImg(
        Yii::$app->params['uploadPath'] . $model->preview,
        300,
        300,
        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
        ['alt' => 'screen']
    );
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            //'preview',
            'date:datetime',
            'created_at:datetime',
            'updated_at:datetime',
            'author.last_name',
        ],
    ]) ?>

    <?php Pjax::end();?>
</div>
