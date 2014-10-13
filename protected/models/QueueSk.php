<?php
/*SELECT *, GROUP_CONCAT(CONCAT(qc.comment,' (',u.full_name,')') ORDER BY qc.date_add ASC SEPARATOR ', ') AS comments FROM `queue_sk` AS q LEFT JOIN queue_sk_comments AS qc ON q.`queue_id`=qc.`queue_id` LEFT JOIN users AS u ON qc.user_id=u.id GROUP BY q.`queue_id`*/
/**
 * This is the model class for table "queue_sk".
 *
 * The followings are the available columns in table 'queue_sk':
 * @property integer $queue_id
 * @property integer $queue_number
 * @property string $destination_name
 * @property integer $quantity
 * @property integer $date_out
 * @property integer $priority
 * @property string $car_number
 */
class QueueSk extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return QueueSk the static model class
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
        return 'queue_sk';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('queue_number, destination_name, date_out ', 'required'),
            array(
                'quantity, priority',
                'numerical',
                'integerOnly' => true),
            array(
                'destination_name,car_number,seal,car_info',
                'length',
                'max' => 255),
            array(
                'attach',
                'file',
                'types' => 'xls, xlsx, pdf, ods',
                'allowEmpty' => true,
                'on' => 'insert,update'),
            array(
                'queue_id, user_id, queue_number, destination_name, quantity, date_out, priority, car_number,seal,car_info ',
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
            'status' => array(
                self::HAS_MANY,
                'QueueSkStatus',
                'queue_id'),
            'laststatus' => array(
                self::HAS_ONE,
                'QueueSkStatus',
                'queue_id',
                'order' => 'date_add DESC'),
            'comments' => array(
                self::HAS_MANY,
                'QueueSkComments',
                'queue_id'),
            'commentCount' => array(
                self::STAT,
                'QueueSkComments',
                'queue_id'),
            'statusCount' => array(
                self::STAT,
                'QueueSkStatus',
                'queue_id'),
            'user' => array(
                self::BELONGS_TO,
                'Users',
                'user_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'queue_id' => 'Queue',
            'queue_number' => Yii::t("sk", 'Queue number'),
            'destination_name' => Yii::t("sk", 'Destination'),
            'quantity' => Yii::t("sk", 'Quantity'),
            'date_out' => Yii::t("sk", 'Date Out'),
            'priority' => Yii::t("sk", 'Priority'),
            'attach' => Yii::t("sk", 'Attach'),
            'attach_src' => Yii::t("sk", 'Attach Source'),
            'seal' => Yii::t("sk", 'Seal'),
            'car_number' => Yii::t("sk", 'Car number'),
            'car_info' => Yii::t("sk", 'Car info'),
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

        $criteria->together = true;
        $criteria->with = 'status';
        $criteria->group = 't.queue_id';
        $criteria->compare('queue_id', $this->queue_id);
        $criteria->compare('queue_number', $this->queue_number, true);
        $criteria->compare('destination_name', $this->destination_name, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('seal', $this->seal, true);
        $criteria->compare('car_number', $this->car_number, true);
        $criteria->compare('car_info', $this->car_info, true);

        if ($this->date_out)
            $criteria->compare('date_out', strtotime($this->date_out), true);
        if ($this->laststatus)
            $criteria->compare('laststatus.status_id', $this->laststatus, true);

        $criteria->compare('priority', $this->priority);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 70),
            'sort' => array('defaultOrder' =>
                    't.priority DESC, t.date_out ASC, status.date_add ASC', ),
            ));
    }
    protected function beforeSave()
    {
        if (!parent::beforeSave())
            return false;


        $this->date_out = strtotime($this->date_out);

        if (($this->scenario == 'insert' || $this->scenario == 'update') && ($attach =
            CUploadedFile::getInstance($this, 'attach'))) {
            $this->deleteAttach();

            
            $file_src = 'files' . DIRECTORY_SEPARATOR . 'sk' . DIRECTORY_SEPARATOR . date("Ym") .
                DIRECTORY_SEPARATOR . time();
            $this->attach = $attach;
            $this->attach_src = $file_src;
            $path = Yii::getPathOfAlias('webroot.files.sk') . DIRECTORY_SEPARATOR . date("Ym");
            if (!is_dir($path)) {
                try {
                    mkdir($path, '777');
                }
                catch (exception $e) {
                    throw new CHttpException(500, 'Не могу создать папку ' . $path);
                }
            }
            $this->attach->saveAs(Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $this->attach_src);
        }

        return true;
    }

    protected function beforeDelete()
    {
        if (!parent::beforeDelete())
            return false;
        $this->deleteAttach(); // удалили модель? удаляем и файл
        return true;
    }

    public function deleteAttach()
    {
        $attachPath = Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . $this->attach_src;
        if (is_file($attachPath))
            unlink($attachPath);
    }

    protected function afterFind()
    {
        $date = date('Y-m-d', $this->date_out);
        $this->date_out = $date;
        parent::afterFind();
    }
}
