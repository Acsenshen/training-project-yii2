<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\ArticleTag;
use yii\data\Pagination;

class Article extends \yii\db\ActiveRecord
{
    const statusAllow = 1;
    const statusDisallow = 2;

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
    public function saveImage(String $nameFile):bool
    {
        $this->preview = $nameFile;
        return $this->save();
    }

    // Удаляем картинку после удаления записи
    public function deleteImage():bool
    {
        $image = new ImageUpload();
        return $image->deleteOldImage($this->preview);
    }

    // Получаем текущую картинку стать
    public function getImage():string
    {
        $image = new ImageUpload();
        $dir = $image->getFolder() . $this->preview;

        if ((empty($this->preview)) || ($this->preview == null) || (!file_exists($dir))) {
            return "/img/default.png";
        } else {
            return '/uploads/' . $this->preview;
        }
    }

    public static function getAll(int $pageSize = 3):array
    {
        $article = Article::find(); // Формируем запрос
        $articleCount = $article->count(); // Берем общее количество статей
        $pages = new Pagination(['totalCount' => $articleCount, 'pageSize' => $pageSize]);
        $articles = $article->offset($pages->offset)->limit($pages->limit)->all(); // Лимитируем наш запрос используя пагинацию и выводим все статьи
        
        // offset Показывает 3 записи в зависимости от страницы. Если 1 страница, то 1.2.3, но если 2 страница то 2.3.4
        // limit - лимит статей на странице
        
        $data['articles'] = $articles;
        $data['pages'] = $pages;
        return $data;
    }


    // Удаляем картинку после удаления записи (Этот метод вызывается перед удалением записи)
    public function beforeDelete():bool
    {
        $this->deleteImage(); // Вызов функции
        return parent::beforeDelete();
    }

    // Устанавливаем связь между категориями
    public function getCategory():object
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    // Текущяя ID категории
    public function getSelectedCategoryId():int
    {
        return ($this->category_id) ? $this->category_id : '0';
    }

    // Текущее имя категории
    public function getCategoryName():string
    {
        return $this->category->title;
    }

    // Cохраняем категорию
    public function saveCategory(int $newCategory_id):bool
    {
        $category = Category::findOne($newCategory_id); // Ищем модель
        if ($category != null) {
            $this->link('category', $category); // Устанавливаем связь
            return true;
        }
    }

    // Устанавливаем связь между тегами и статьей (получаем все теги со стороны статьи)
    public function getTag():object
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('article_tag', ['article_id' => 'id']);
    }

    // Получаем ID выбранных тегов
    public function getSelectedTagId():array
    {
        $selectedTagId = $this->getTag()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedTagId, 'id');
    }

    // Получаем имена выбранных тегов
    public function getArticleTag():array
    {
        $selectedTagName = $this->getTag()->select('title')->asArray()->all();
        return ArrayHelper::getColumn($selectedTagName, 'title');
    }

    // Сохраняем теги
    public function SaveTag(Array $newTagsId):bool
    {
        if (is_array($newTagsId)) {
            $this->deleteOldTag();
            foreach ($newTagsId as $newTagId) {
                $tag = Tag::findOne($newTagId);
                $this->link('tag', $tag);
            }
            return true;
        }
    }

    // Удаление старых тегов
    private function deleteOldTag():bool
    {
        return ArticleTag::deleteAll(['article_id' => $this->id]);
    }

    // Устанавливаем связь между комментариями
    public function getComment():object
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    // Получить комментарии
    public function getArticleComment():array
    {
        return $this->getComment()->where(['status' => 1])->all();
    }

    public function getUser():object
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    // Счетчик просмотров
    public function viewedCount():bool
    {
        $this->viewed += 1;
        return $this->save(false);
    }

    // Сохранение статьи
    public function saveArticle():bool
    {
        $this->author = Yii::$app->user->id;
        $this->status = self::statusDisallow;
        return $this->save();
    }

    // Одобрена или нет
    public function isAllowed():bool 
    {
        if ($this->status == self::statusAllow) {
            return true;
        } else {
            return false;
        }
    }

    // Одобрена
    public function allow() :bool
    {
        $this->status = self::statusAllow;
        return $this->save(false);
    }

    // Не одобрена
    public function disallow():bool
    {
        $this->status = self::statusDisallow;
        return $this->save(false);
    }
}
