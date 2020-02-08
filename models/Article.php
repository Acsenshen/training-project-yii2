<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\ArticleTags;
use yii\data\Pagination;

class Article extends \yii\db\ActiveRecord
{
    const STATUS_ALLOW = 1;
    const STATUS_DISALLOW = 2;

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['title', 'annotation', 'content'], 'string'],
            [['article_date'], 'date', 'format' => 'php:Y-m-d'],
            [['article_date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => '255']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'annotation' => 'Annotation',
            'content' => 'Content',
            'article_date' => 'Article Date',
            'preview' => 'Preview',
            'viewed' => 'Viewed',
            'author' => 'Author',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    // Заносим картинку в базу
    public function saveImage($nameFile)
    {
        $this->preview = $nameFile;
        return $this->save();
    }

    // Удаляем картинку после удаления записи
    public function deleteImage()
    {
        $image = new ImageUpload();
        $image->deleteOldImage($this->preview);
    }

    // Получаем текущую картинку стать
    public function getImage()
    {
        $image = new ImageUpload();
        $dir = $image->getFolder() . $this->preview;

        if ((empty($this->preview)) || ($this->preview == null) || (!file_exists($dir))) {
            return "/img/default.png";
        } else {
            return '/uploads/' . $this->preview;
        }
    }

    public static function getAll($pageSize = 3)
    {
        $query = Article::find(); // Формируем запрос
        $countQuery = $query->count(); // Берем общее количество статей
        $pages = new Pagination(['totalCount' => $countQuery, 'pageSize' => $pageSize]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all(); // Лимитируем наш запрос используя пагинацию и выводим все статьи
        
        // offset Показывает 3 записи в зависимости от страницы. Если 1 страница, то 1.2.3, но если 2 страница то 2.3.4
        // limit - лимит статей на странице
        
        $data['articles'] = $articles;
        $data['pages'] = $pages;
        return $data;
    }


    // Удаляем картинку после удаления записи (Этот метод вызывается перед удалением записи)
    public function beforeDelete()
    {
        $this->deleteImage(); // Вызов функции
        return parent::beforeDelete();
    }

    // Устанавливаем связь между категориями
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    // // Текущяя категория
    public function getSelectedCategory()
    {
        return ($this->category_id) ? $this->category_id : '0';
    }

    // Cохраняем категорию
    public function saveCategory($newCategory_id)
    {
        $category = Category::findOne($newCategory_id); // Ищем модель
        if ($category != null) {
            $this->link('category', $category); // Устанавливаем связь
            return true;
        }
    }

    // Устанавливаем связь между тегами и статьей (получаем все теги со стороны статьи)
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])->viaTable('article_tags', ['article_id' => 'id']);
    }

    // Получаем ID выбранных тегов
    public function getSelectedTags()
    {
        $selectedTagsId = $this->getTags()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedTagsId, 'id');
    }

    // Получаем имена выбранных тегов
    public function getNameTags()
    {
        $selectedTagsName = $this->getTags()->select('title')->asArray()->all();
        return ArrayHelper::getColumn($selectedTagsName, 'title');
    }

    // Сохраняем теги
    public function SaveTags($newTags_id)
    {
        if (is_array($newTags_id)) {
            $this->deleteOldTags();
            foreach ($newTags_id as $newTag_id) {
                $tags = Tags::findOne($newTag_id);
                $this->link('tags', $tags);
            }
            return true;
        }
    }

    // Удаление старых тегов
    private function deleteOldTags()
    {
        ArticleTags::deleteAll(['article_id' => $this->id]);
    }

    // Устанавливаем связь между комментариями
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['article_id' => 'id']);
    }

    // Получить комментарии
    public function getArticleComments()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'author']);
    }

    // Счетчик просмотров
    public function viewedCount()
    {
        $this->viewed += 1;
        return $this->save(false);
    }

    // Сохранение статьи
    public function saveArticle()
    {
        $this->author = Yii::$app->user->id;
        $this->status = 2;
        return $this->save();
    }

    // Одобрена или нет
    public function isAllowed() {
        if ($this->status == 1) {
            return true;
        }
    }

    // Одобрена
    public function allow() {
        $this->status = self::STATUS_ALLOW;
        return $this->save(false);
    }

    // Не одобрена
    public function disallow() {
        $this->status = self::STATUS_DISALLOW;
        return $this->save(false);
    }
}
