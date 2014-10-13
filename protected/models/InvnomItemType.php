<?php

/**
 * This is the model class for table "invnom_item_type".
 *
 * The followings are the available columns in table 'invnom_item_type':
 * @property integer $type_id
 * @property integer $parent_id
 * @property string $type_name
 * @property string $type_desc
 */
class InvnomItemType extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InvnomItemType the static model class
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
        return 'invnom_item_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, type_name, type_desc', 'required'),
            array(
                'parent_id',
                'numerical',
                'integerOnly' => true),
            array(
                'type_name',
                'length',
                'max' => 50),
            array(
                'type_desc',
                'length',
                'max' => 150),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'type_id, parent_id, type_name, type_desc',
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
        return array('item' => array(
                self::HAS_MANY,
                'InvnomItem',
                'type_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'type_id' => 'Type',
            'parent_id' => 'Parent',
            'type_name' => 'Type Name',
            'type_desc' => 'Type Desc',
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

        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->compare('type_desc', $this->type_desc, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function getTypeList()
    {
        $types = InvnomItemType::model()->findAll();
        $result = array();
        foreach ($types as $t)
            if ($t->parent_id!=0)
            $result[$t->parent_id][$t->type_id] = $t->type_name;
        /*array(
        'label' => $t->type_name,
        'value' => $t->type_name,
        'id' => $t->type_id,
        );
        */
        return $result;
    }
}
