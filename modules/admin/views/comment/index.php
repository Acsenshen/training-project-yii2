<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Комментарии';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);

?>
<div class="article-index">

    <h1 class="pb-4"><?= Html::encode($this->title) ?></h1>

<!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Все комментарии</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md text-center">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Текст</th>
            <th class="text-center">Автор</th>
            <th class="text-center">ID Статьи</th>
            <th class="text-center">Дата публикации</th>
            <th class="text-center">Статус</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) { ?>
          <tr>
            <td class="pt-3-half"><?= $comment->id ?></td>
            <td class="pt-3-half"><?= $comment->text ?></td>
            <td class="pt-3-half"><?= $comment->user->name ?></td>
            <td class="pt-3-half"><?= $comment->article_id ?></td>
            <td class="pt-3-half"><?= $comment->comment_date ?></td>
            <td>
            <?php if ($comment->isAllowed()) { ?>
            <?= Html::a('<i class="fas fa-lg fa-times"></i>', ['notallow', 'id' => $comment->id], ['class' => 'btn btn-warning btn-rounded btn-sm my-0']) ?>
            <?php } else { ?>
            <?= Html::a('<i class="fas fa-lg fa-check"></i>', ['allow', 'id' => $comment->id], ['class' => 'btn btn-success btn-rounded btn-sm my-0']) ?>
            <?php } ?>
            <?= Html::a('<i class="fas fa-lg fa-trash"></i>', ['delete', 'id' => $comment->id], [
            'class' => 'btn btn-danger btn-rounded btn-sm my-0',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить данный комментари?',
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
