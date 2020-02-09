<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $article->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Загрузить превью', ['set-image', 'id' => $article->id], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Установить категорию', ['set-category', 'id' => $article->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Установить теги', ['set-tag', 'id' => $article->id], ['class' => 'btn btn-body']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $article->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $article,
        'attributes' => [
            'id',
            'title',
            'annotation',
            'content',
            'article_date',
            'preview',
            'viewed',
            'author',
            'status',
            'category_id',
        ],
    ]) ?>

</div>
