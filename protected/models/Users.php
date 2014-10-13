<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $full_name
 * @property string $url
 * @property string $pass
 * @property string $salt
 * @property integer $role
 * @property string $mail
 * @property string $create
 * @property string $changed
 * @property integer $del
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, pass, salt, mail', 'required'),
			array('role, del', 'numerical', 'integerOnly'=>true),
			array('url, mail', 'length', 'max'=>40),
			array('pass, salt', 'length', 'max'=>255),
			array('create, changed', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, url, pass, salt, role, mail, create, changed, del', 'safe', 'on'=>'search'),
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
            'move' => array(self::HAS_MANY, 'InvnomMove', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'url' => 'Url',
			'pass' => 'Pass',
			'salt' => 'Salt',
			'role' => 'Role',
			'mail' => 'Mail',
			'create' => 'Create',
			'changed' => 'Changed',
			'del' => 'Del',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('create',$this->create,true);
		$criteria->compare('changed',$this->changed,true);
		$criteria->compare('del',$this->del);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}