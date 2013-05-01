<?php

/**
 * This is the model class for table "document".
 *
 * The followings are the available columns in table 'document':
 * @property integer $id
 * @property string $name
 * @property string $uri
 * @property integer $id_type_document
 *
 * The followings are the available model relations:
 * @property TypeDocument $idTypeDocument
 * @property Item[] $items
 */
class Document extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Document the static model class
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
		return 'document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, uri', 'required'),
			array('id_type_document', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('uri', 'length', 'max'=>255),
                        array('uri', 'file', 'types'=>'jpg, gif, png'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, uri, id_type_document', 'safe', 'on'=>'search'),
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
			'idTypeDocument' => array(self::BELONGS_TO, 'TypeDocument', 'id_type_document'),
			'items' => array(self::MANY_MANY, 'Item', 'itemxdocument(id_document, id_item)'),
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
			'uri' => 'Uri',
			'id_type_document' => 'Id Type Document',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('uri',$this->uri,true);
		$criteria->compare('id_type_document',$this->id_type_document);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}