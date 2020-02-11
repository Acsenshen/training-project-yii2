<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;


$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $this->title;\yii\web\YiiAsset::register($this);

?>
<div class="article-index">

    <h1 class="pb-4"><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
              'attribute' => 'category_id',
              'value' => 'category.title'
            ],
            [
              'attribute' => 'author',
              'label' => 'Номер договора',
              'filter' => Select2::widget([
                      'model' => $searchModel,
                      'attribute' => 'author',
                      'data' => \yii\helpers\ArrayHelper::map(app\models\User::find()->orderBy("name")->all(), 'id', 'name'),
                      'theme' => Select2::THEME_BOOTSTRAP,
                      'pluginOptions' => [
                          'allowClear' => true,
                      ],
                      'options' => [
                          'placeholder' => 'Выбрать договор',
                      ],
                  ]
              ),
              'value' => 'author'
          ],
            'article_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>





</div>
