<?php

/**
 * This is the model class for table "profnastil".
 *
 * The followings are the available columns in table 'profnastil':
 * @property integer $order_id
 * @property integer $date_add
 * @property integer $user_id
 * @property integer $stuff_id
 * @property string $mark
 * @property string $raw
 * @property integer $thickness
 * @property integer $length
 * @property integer $quantity
 * @property integer $volume
 * @property integer $status_id
 * @property string $city
 * @property integer $delivery_id
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property ProfnastilStuff $stuff
 * @property ProfnastilStatus $status
 * @property ProfnastilDelivery $delivery
 */
class Profnastil extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'profnastil';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('stuff_id, mark, raw, quantity, city, delivery_id,', 'required'),
            array(
                'date_add, user_id, stuff_id, thickness, length, quantity, volume, status_id, delivery_id',
                'numerical',
                'integerOnly' => true),
            array(
                'mark',
                'length',
                'max' => 100),
            array(
                'raw, city',
                'length',
                'max' => 20),
            array(
                'comment',
                'length',
                'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'order_id, date_add, user_id, stuff_id, mark, raw, thickness, length, quantity, volume, status_id, city, delivery_id, comment',
                'safe',
                'on' => 'search'),
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
            'user' => array(
                self::BELONGS_TO,
                'Users',
                'user_id'),
            'stuff' => array(
                self::BELONGS_TO,
                'ProfnastilStuff',
                'stuff_id'),
            'status' => array(
                self::BELONGS_TO,
                'ProfnastilStatus',
                'status_id'),
            'delivery' => array(
                self::BELONGS_TO,
                'ProfnastilDelivery',
                'delivery_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'order_id' => 'Order',
            'date_add' => 'Date Add',
            'user_id' => 'User',
            'stuff_id' => 'Stuff',
            'mark' => 'Mark',
            'raw' => 'Raw',
            'thickness' => 'Толщина',
            'length' => 'Длина',
            'quantity' => 'Кол-во, шт.',
            'volume' => 'Объем в м2 (если неизвестна длина)',
            'status_id' => 'Состояние',
            'city' => 'City',
            'delivery_id' => 'Способ доставки до заказчика',
            'comment' => 'Комментарий',
            );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('order_id', $this->order_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('stuff_id', $this->stuff_id);
        $criteria->compare('mark', $this->mark, true);
        $criteria->compare('raw', $this->raw, true);
        $criteria->compare('thickness', $this->thickness);
        $criteria->compare('length', $this->length);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('volume', $this->volume);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('delivery_id', $this->delivery_id);
        $criteria->compare('comment', $this->comment, true);
        if ($this->date_add)
            $criteria->compare('date_add', strtotime($this->date_add), true);
        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Profnastil the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }


    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            $this->user_id = Yii::app()->user->id;
            $this->status_id = 1;
            $this->date_add = time();
            return true;
        }
        return false;
    }
    /**
     * 
     * */
    public function suggestTag($tag, $keyword)
    {
        $crt = new CDbCriteria();
        $crt->select = $tag;
        $crt->condition = $tag . ' LIKE :keyword';
        $crt->group = $tag;
        $crt->distinct = true;
        $crt->params = array(':keyword' => '%' . strtr($keyword, array(
                '%' => '\%',
                '_' => '\_',
                '\\' => '\\\\')) . '%', );


        $tags = $this->findAll($crt);
        return $tags;

    }
    protected function afterFind()
    {
        $date = date('Y-m-d', $this->date_add);
        $this->date_add = $date;
        parent::afterFind();
    }
}
