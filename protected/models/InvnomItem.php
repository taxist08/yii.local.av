<?php

/**
 * This is the model class for table "invnom_item".
 *
 * The followings are the available columns in table 'invnom_item':
 * @property integer $item_id
 * @property integer $type_id
 * @property integer $date_add
 * @property string $distribution
 * @property integer $inv_nom
 * @property string $item_model
 * @property string $item_sn
 * 
 */
class InvnomItem extends CActiveRecord
{
    public $destination;
    public $maxInvNom;
    public $move_date;


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return InvnomItem the static model class
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
        return 'invnom_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_id, brand_id, distribution,  item_model', 'required'),
            array(
                'type_id, date_add, inv_nom, inv_1c',
                'numerical',
                'integerOnly' => true),
            array(
                'distribution, item_model, item_sn',
                'length',
                'max' => 150),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'item_id, type_id, brand_id, date_add, distribution, inv_nom, item_model, item_sn, inv_1c, brand_search,comment,destination',
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
                'InvnomItemType',
                'type_id'),
            'brand' => array(
                self::BELONGS_TO,
                'InvnomBrand',
                'brand_id'),
            'move' => array(
                self::HAS_MANY,
                'InvnomMove',
                'item_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'item_id' => 'Item',
            'type_id' => 'Type',
            'inv_1c' => 'Number in 1c',
            'date_add' => 'Date Add',
            'distribution' => 'Distribution',
            'inv_nom' => 'Inv Nom',
            'item_model' => 'Item Model',
            'item_sn' => 'Item Sn',
            'comment' => 'comment',
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
        $criteria->with = array(
            'type' => array('select' => array('type_id', 'type_name')),
            'brand' => array('select' => array('brand_id', 'brand_name')),
            'move' => array('select' => array(
                    'rec_id',
                    'destination_name',
                    'move_date')),
            );

        //       $criteria->compare('item_id', $this->item_id);
        // $criteria->compare('type_id', $this->type_id);
        if (isset($this->type_id) && !empty($this->type_id)) {
            $criteria->compare('type.type_id', '=' . $this->type_id, true);
        }
        if (isset($this->brand_id) && !empty($this->brand_id)) {
            $criteria->compare('brand.brand_id', '=' . $this->brand_id, true);
        }
        if (isset($_POST['destination']) && !empty($_POST['destination'])) {
            $criteria->addSearchCondition('move.destination', $_POST['destination']);
            // exit($_POST['destination']);
        }
        //      $criteria->compare('date_add', $this->date_add);
        $criteria->compare('t.distribution', $this->distribution, true);
        $criteria->compare('t.inv_1c', $this->inv_1c, true);
        $criteria->compare('t.inv_nom', $this->inv_nom, true);
        $criteria->compare('t.item_model', $this->item_model, true);
        $criteria->compare('t.item_sn', $this->item_sn, true);
        $criteria->compare('move.destination', $this->destination, true);
        $criteria->together = true;

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'move.rec_id DESC', ),
            /*'sort' => array('attributes' => array('t.item_model' => array(
            'asc' => $expr = 't.item_model',
            'desc' => $expr . 'DESC',
            ), )),*/
            ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function searchnull()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = " move.`item_id` is null";
        $criteria->with = array(
            'type' => array('select' => array('type_id', 'type_name')),
            'brand' => array('select' => array('brand_id', 'brand_name')),
            'move' => array('select' => array('rec_id', 'destination_name, move_date')),
            );

        if (isset($this->type_id) && !empty($this->type_id)) {
            $criteria->compare('type.type_id', '=' . $this->type_id, true);
        }
        if (isset($this->brand_id) && !empty($this->brand_id)) {
            $criteria->compare('brand.brand_id', '=' . $this->brand_id, true);
        }
        if (isset($_POST['destination']) && !empty($_POST['destination'])) {
            $criteria->addSearchCondition('move.destination', $_POST['destination']);
        }
        $criteria->compare('t.distribution', $this->distribution, true);
        $criteria->compare('t.inv_1c', $this->inv_1c, true);
        $criteria->compare('t.inv_nom', $this->inv_nom, true);
        $criteria->compare('t.item_model', $this->item_model, true);
        $criteria->compare('t.item_sn', $this->item_sn, true);
        $criteria->compare('move.destination', $this->destination, true);
        if ($this->date_add)
            $criteria->compare('t.date_add', strtotime($this->date_add), true);
        $criteria->together = true;


        if (isset($_POST['destination']) && !empty($_POST['destination'])) {
            $criteria->addSearchCondition('move.destination', $_POST['destination']);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'move.rec_id DESC', ),
            ));
    }

    /**
     * */
    public function suggestTag($keyword)
    {
        $crt = new CDbCriteria();
        $crt->select = "item_id,item_model";
        $crt->condition = 'item_model LIKE :keyword';
        $crt->group = 'item_model';
        $crt->distinct = true;
        $crt->params = array(':keyword' => '%' . strtr($keyword, array(
                '%' => '\%',
                '_' => '\_',
                '\\' => '\\\\')) . '%', );


        $tags = $this->findAll($crt);
        return $tags;
    }
    public function suggestDist($keyword)
    {
        $crt = new CDbCriteria();
        $crt->select = "item_id,distribution";
        $crt->condition = 'distribution LIKE :keyword';
        $crt->group = 'distribution';
        $crt->distinct = true;
        $crt->params = array(':keyword' => '%' . strtr($keyword, array(
                '%' => '\%',
                '_' => '\_',
                '\\' => '\\\\')) . '%', );


        $tags = $this->findAll($crt);
        return $tags;
    }
    public function getMaxNom($type_id)
    {
        $criteria = new CDbCriteria;
        $criteria->select = new CDbExpression('MAX(inv_nom) as maxInvNom');
        $criteria->condition = 'inv_nom LIKE \'' . $type_id . '%\'';
        $criteria->params = array(':type_id' => $type_id);
        $max = InvnomItem::model()->find($criteria);
        ;
        return $max->maxInvNom;
    }

    public function getDistList()
    {
        return CHtml::listData(self::model()->findAll(array('select' => array('distribution',
                    'distribution'))), 'distribution', 'distribution');
    }

    protected function afterFind()
    {
     /*   $date = date("Y-m-d", $this->date_add);
        $this->date_add = $date;
        parent::afterFind();
        */
    }
}
