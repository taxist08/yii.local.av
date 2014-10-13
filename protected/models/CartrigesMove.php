<?php

/**
 * This is the model class for table "cartriges_move".
 *
 * The followings are the available columns in table 'cartriges_move':
 * @property integer $rec_id
 * @property integer $cartrige_id
 * @property integer $move_date
 * @property integer $user_id
 * @property string $destination
 * @property integer $is_full
 * @property string $comment
 */
class CartrigesMove extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CartrigesMove the static model class
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
        return 'cartriges_move';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cartrige_id, move_date, user_id, destination, move_type', 'required'),
            array(
                'cartrige_id, move_date, user_id, is_full, move_type',
                'numerical',
                'integerOnly' => true),
            array(
                'destination',
                'length',
                'max' => 150),
            array(
                'comment',
                'length',
                'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'rec_id, cartrige_id, move_date, user_id, destination, is_full, comment, move_type',
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
            'cartrige' => array(
                self::BELONGS_TO,
                'Cartriges',
                'cartrige_id'),
            'user' => array(
                self::BELONGS_TO,
                'Users',
                'user_id'),
            'mtype' => array(
                self::BELONGS_TO,
                'CartrigesMoveType',
                'move_type'));
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'rec_id' => 'Rec',
            'cartrige_id' => 'Cartrige',
            'move_type' => 'Move Type',
            'move_date' => 'Move Date',
            'user_id' => 'User',
            'destination' => 'Destination',
            'is_full' => 'Is Full',
            'comment' => 'Comment',
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

        $criteria->compare('rec_id', $this->rec_id);
        $criteria->compare('cartrige_id', $this->cartrige_id);
        $criteria->compare('move_date', $this->move_date);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('destination', $this->destination, true);
        $criteria->compare('is_full', $this->is_full);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    public function suggestDest($keyword)
    {
        $crt = new CDbCriteria();
        $crt->select = "destination";
        $crt->condition = 'destination LIKE :keyword';
        $crt->group = 'destination';
        $crt->distinct = true;
        $crt->params = array(':keyword' => '%' . strtr($keyword, array(
                '%' => '\%',
                '_' => '\_',
                '\\' => '\\\\')) . '%', );


        $tags = $this->findAll($crt);
        return $tags;
    }
}
