<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id_book
 * @property string $title
 * @property int $year
 * @property string $publisher
 * @property string $description
 * @property string $img
 * @property int $author_id
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year', 'publisher', 'description', 'img', 'author_id'], 'required'],
            [['year', 'author_id'], 'integer'],
            [['description', 'img'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['publisher'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'author_id']],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_book' => 'Id Book',
            'title' => 'Title',
            'year' => 'Year',
            'publisher' => 'Publisher',
            'description' => 'Description',
            'img' => 'Img',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['author_id' => 'author_id']);
    }
}
