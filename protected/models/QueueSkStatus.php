<?php

/**
 * This is the model class for table "queue_sk_status".
 *
 * The followings are the available columns in table 'queue_sk_status':
 * @property integer $queue_id
 * @property integer $user_id
 * @property integer $date_add
 * @property integer $status_id
 */
class QueueSkStatus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QueueSkStatus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'queue_sk_status';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('queue_id, user_id, date_add, status_id', 'required'),
			array('queue_id, user_id, date_add, status_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('queue_id, user_id, date_add, status_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'queue' => array(self::BELONGS_TO,'QueueSk','queue_id'), 
                    'user' => array(self::BELONGS_TO,'Users','user_id'),
                    'status_type' => array(self::BELONGS_TO,'QueueSkStatusType','status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'queue_id' => 'Queue',
			'user_id' => 'User',
			'date_add' => 'Date Add',
			'status_id' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('queue_id',$this->queue_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_add',$this->date_add);
		$criteria->compare('status_id',$this->status_id);
        $criteria->order = 'date_add desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array('defaultOrder' =>'date_add DESC', ),
		));
	}
}