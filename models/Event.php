<?php

namespace common\models;

use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $event_type
 * @property string|null $resourceId
 * @property string $title
 * @property int|null $allDay
 * @property string|null $start
 * @property string|null $end
 * @property string|null $url
 * @property string|null $className
 * @property int|null $editable
 * @property int|null $startEditable
 * @property int|null $durationEditable
 * @property string|null $rendering
 * @property string|null $overlap
 * @property string|null $constraint
 * @property string|null $source
 * @property string|null $color
 * @property string|null $backgroundColor
 * @property string|null $borderColor
 * @property string|null $textColor
 * @property string|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $updated_at
 *
 * @property User $user
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'event_type', 'allDay', 'editable', 'startEditable', 'durationEditable', 'created_by', 'updated_by'], 'integer'],
            [['start', 'end', 'created_at', 'updated_at'], 'safe'],
            [['resourceId', 'color', 'backgroundColor', 'borderColor', 'textColor'], 'string', 'max' => 20],
            [['title', 'url', 'rendering', 'overlap', 'constraint', 'source'], 'string', 'max' => 255],
            [['className'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'event_type' => Yii::t('app', 'Event Type'),
            'resourceId' => Yii::t('app', 'Resource ID'),
            'title' => Yii::t('app', 'Title'),
            'allDay' => Yii::t('app', 'All Day'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'url' => Yii::t('app', 'Url'),
            'className' => Yii::t('app', 'Class Name'),
            'editable' => Yii::t('app', 'Editable'),
            'startEditable' => Yii::t('app', 'Start Editable'),
            'durationEditable' => Yii::t('app', 'Duration Editable'),
            'rendering' => Yii::t('app', 'Rendering'),
            'overlap' => Yii::t('app', 'Overlap'),
            'constraint' => Yii::t('app', 'Constraint'),
            'source' => Yii::t('app', 'Source'),
            'color' => Yii::t('app', 'Color'),
            'backgroundColor' => Yii::t('app', 'Background Color'),
            'borderColor' => Yii::t('app', 'Border Color'),
            'textColor' => Yii::t('app', 'Text Color'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function getEventType()
    {
        return [
           0=> Yii::t('app', 'Vacation'),
            1=>  Yii::t('app', 'Sick Leave'),
            2=>  Yii::t('app', 'Meeting'),

        ];
    }


    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
