<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);

?>
<div class="article-index">

    <h1 class="pb-4"><?= Html::encode($this->title) ?></h1>

<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Все новости</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2">
          <a href="/admin/article/create" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md text-center">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Заголовок</th>
            <th class="text-center">Автор</th>
            <th class="text-center">Категория</th>
            <th class="text-center">Дата публикации</th>
            <th class="text-center">Действия</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) { ?>
          <tr>
            <td class="pt-3-half"><?= $article->id ?></td>
            <td class="pt-3-half"><?= $article->title ?></td>
            <td class="pt-3-half"><?= $article->author ?></td>
            <td class="pt-3-half"><?= $article->category_id ?></td>
            <td class="pt-3-half"><?= $article->article_date ?></td>
            <td>
            <?= Html::a('<i class="fas fa-lg fa-eye"></i>', ['view', 'id' => $article->id], ['class' => 'btn btn-info btn-rounded btn-sm my-0']) ?>
            <?php if ($article->isAllowed()) { ?>
            <?= Html::a('<i class="fas fa-lg fa-times"></i>', ['disallow', 'id' => $article->id], ['class' => 'btn btn-warning btn-rounded btn-sm my-0']) ?>
            <?php } else { ?>
            <?= Html::a('<i class="fas fa-lg fa-check"></i>', ['allow', 'id' => $article->id], ['class' => 'btn btn-success btn-rounded btn-sm my-0']) ?>
            <?php } ?>
            <?= Html::a('<i class="fas fa-lg fa-edit"></i>', ['update', 'id' => $article->id], ['class' => 'btn btn-warning btn-rounded btn-sm my-0']) ?>
            <?= Html::a('<i class="fas fa-lg fa-trash"></i>', ['delete', 'id' => $article->id], [
            'class' => 'btn btn-danger btn-rounded btn-sm my-0',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данную новость?',
                'method' => 'POST',
            ],
            ]) ?>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->


</div>
