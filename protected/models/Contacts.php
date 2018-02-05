<?php
class Contacts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                array('first_name, email, gender, state, zip', 'required'),
                array('state', 'numerical', 'integerOnly'=>true),
                array('first_name, last_name, city', 'length', 'max'=>100),
                array('email', 'length', 'max'=>200),
                array('gender, zip', 'length', 'max'=>10),
                array('dob', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array('id, first_name, last_name, dob, email, gender, city, state, zip, hobbies', 'safe', 'on'=>'search'),
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
                'state' => array(self::BELONGS_TO, 'State', 'state')
            );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            return array(
                    'id' => 'ID',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'dob' => 'Date of Birth',
                    'email' => 'E-Mail',
                    'gender' => 'Gender',
                    'city' => 'City',
                    'state' => 'State',
                    'zip' => 'Zip',
                    'hobbies' => 'Hobbies',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('hobbies',$this->hobbies,true);

		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                    'sort'=>array(
                        'defaultOrder'=>'first_name ASC',
                    ),
                    'pagination'=>array(
                        'pageSize'=>5
                    ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Behavior - Kind of event listener.
	 */
	public function behaviors(){
		return array(
			'myBehavior' => array(
				'class' => 'application.components.behaviors.myBehavior',
			)
		);
	}
}