<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property Category $parent0
 * @property Category[] $categories
 * @property Feature[] $features
 * @property Item[] $items
 * @property Itemxcategoryxfeature[] $itemxcategoryxfeatures
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('name', 'required'),
			array('parent', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent', 'safe', 'on'=>'search'),
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
			//'parent0' => array(self::BELONGS_TO, 'Category', 'parent'),
                        'myParent' => array(self::BELONGS_TO, 'Category', 'parent'),
			'categories' => array(self::HAS_MANY, 'Category', 'parent'),
			'features' => array(self::MANY_MANY, 'Feature', 'featurexcategory(id_category, id_feature)'),
			'items' => array(self::HAS_MANY, 'Item', 'id_category'),
			'itemxcategoryxfeatures' => array(self::HAS_MANY, 'Itemxcategoryxfeature', 'id_category'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'parent' => 'Parent',
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
                $criteria->with = array('myParent');
                
		$criteria->compare('id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		//$criteria->compare('parent',$this->parent);
                $criteria->compare('myParent.name',$this->parent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
      
}