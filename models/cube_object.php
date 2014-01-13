<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::library('3rdparty/Varien/Object','cube_testimonials');
class Cube_Object extends Varien_Object
{
    protected $_table	=null;
    protected $_primaryKey = null;
    protected $_errors	=	array();

    public function _construct()
    {
        parent::_construct();
        if(is_null($this->_idFieldName))
            $this->_idFieldName	=	$this->getPrimaryKey ();
    }

    public function getPrimaryKey($refresh=false)
    {
        if ($refresh || $this->_primaryKey==NULL) {
            $qry	=	"SELECT k.column_name
                        FROM information_schema.table_constraints t
                        JOIN information_schema.key_column_usage k
                        USING(constraint_name,table_schema,table_name)
                        WHERE t.constraint_type='PRIMARY KEY'
                        AND t.table_name=?";
            $res	=	$this->getDB()->GetArray($qry,array($this->getTableName()));
            $this->_primaryKey	=	$res[0]['column_name'];
        }

        return $this->_primaryKey;
    }

    /**
     *
     * @return ADOdb_Active_Record
     */
    public function getDB()
    {
        return Loader::db();
    }

    public function getTableName()
    {
        return $this->_table;
    }

    public function isValid()
    {
        $this->_validate();

        return count($this->getErrors())==0 ? true : false;
    }

    protected function _validate()
    {
        return true;
    }

    public function addError($message,$field='')
    {
        $this->_errors[] = $message;
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    public function save()
    {
        if(!$this->isValid())

            return false;
        $this->getDB()->Replace($this->getTableName(),$this->getData(),$this->getIdFieldName(),$autoquote=true);
        if(!$this->getID())	$this->setData($this->getIdFieldName(),$this->getDB()->Insert_ID());

        return $this;
    }

    public function delete()
    {
        $db	=	Loader::db();
        $qry    =   "DELETE FROM ". $this->getTableName() ." WHERE ".$this->getIdFieldName()."=?";

        return $db->Execute($qry,array($this->getID()));
    }
}
