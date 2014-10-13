<?php

/**
 * This is the model class for table "invnom_move".
 *
 * The followings are the available columns in table 'invnom_move':
 * @property integer $item_id
 * @property string $destination_name
 * @property integer $move_date
 * @property string $comments
 */
class InvnomMove extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InvnomMove the static model class
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
        return 'invnom_move';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item_id, destination_name, move_date,user_id', 'required'),
            array(
                'item_id, move_date',
                'numerical',
                'integerOnly' => true),
            array(
                'destination_name',
                'length',
                'max' => 150),
            array(
                'comments',
                'length',
                'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'item_id, destination_name, move_date, comments',
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
                    'item' => array(self::BELONGS_TO,'InvnomItem','item_id'), 
                    'user' => array(self::BELONGS_TO,'Users','user_id'),
        
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'item_id' => 'Item',
            'destination_name' => 'Destination Name',
            'move_date' => 'Move Date',
            'comments' => 'Comments',
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

        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('destination_name', $this->destination_name, true);
        $criteria->compare('move_date', $this->move_date);
        $criteria->compare('comments', $this->comments, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

}
