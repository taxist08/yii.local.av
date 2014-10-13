<?php

/**
 * This is the model class for table "cartriges".
 *
 * The followings are the available columns in table 'cartriges':
 * @property integer $cartrige_id
 * @property integer $type_id
 * @property string $comment
 */
class Cartriges extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cartriges the static model class
     */
    public static function model($className = __class__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'cartriges';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id', 'required'),
            array(
                'type_id',
                'numerical',
                'integerOnly' => true),
            array(
                'comment',
                'length',
                'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'cartrige_id, type_id, comment, mtype, laststatus, lastsmove',
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
        //return array();
        return array(
            'type' => array(
                self::BELONGS_TO,
                'CartrigesType',
                'type_id'),
            'move' => array(
                self::HAS_MANY,
                'CartrigesMove',
                'cartrige_id'),

            'lastsmove' => array(
                self::HAS_ONE,
                'CartrigesMove',
                'cartrige_id',
                'order' => 'move_date DESC'),

            'laststatus' => array(
                self::HAS_ONE,
                'CartrigesMoveType',
                array('move_type' => 'move_type'),
                'through' => 'lastsmove','order' => 'move_date DESC'),
                
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'cartrige_id' => 'Cartrige',
            'type_id' => Yii::t("cartrige", 'Type'),
            'comment' => Yii::t("cartrige", 'Comments'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('cartrige_id', $this->cartrige_id, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('comment', $this->comment, true);
        // $criteria->with = array('mtype' => array('select' => array('type_id', 'type_name')));

        return new CActiveDataProvider($this, array('criteria' => $criteria,'pagination' => array('pageSize' => 30), ));
    }
}
