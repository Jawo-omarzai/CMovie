<?php

namespace Anax\Movies;

/**
 * Model for Users
 *
 */
class Movie extends \Anax\MVC\CDatabaseModel
{
    /**
     * Get the table name.
     *
     * @return string with table name
     */

    public function getSource()
    {
        return strtolower(implode('', array_slice(explode('\\', get_class($this)), -1)));
    }
    
    /*
     * Create new row
     * 
     */

    public function create($values){
        
        $keys = array_keys($values);
        $values = array_values($values);

        $this->db->insert(
            $this->getSource(),
            $keys
        );

        $res = $this->db->execute($values);

        $this->id = $this->db->lastInsertId();

        return $res;

    }

    /* 
     * Updete row
     *
     * @params array $values $key/$value to save
     *
     * @return boolean true or false if saving went okey.
     */

    public function update($values){

        

        $keys = array_keys($values);
        $values = array_values($values);

        
        
            
        unset($keys['id']);
        
        $values[] = $this->id;

        $this->db->update(
            $this->getSource(),
            $keys,
            'id = ?');

        return $this->db->execute($values);
    }
    /**
     *
     * Delete row
     *
     *@param ingeger $id to delete
     * 
     *
     @return boolean true or false if deleting went okey.
     */
     public function delete($id){

        $this->db->delete($this->getSource(), 'id = ?'

        );

        return $this->db->execute([$id]);
     }
    /**
     * Find and return all 
     *
     * @return array
     */
    public function findAll(){

       $this->db->select()->from($this->getSource());
       $this->db->execute();
       $this->db->setFetchModeClass(__CLASS__);
       return $this->db->fetchAll();

    }

    /**
     * Find and return specific
     *
     * @return this
     **/
    public function find($id){

        $this->db->select()->from($this->getSource())->where('id = ? ');
        $this->db->execute([$id]);
        return $this->db->fetchInto($this);
    }

    

    /**
     * Save current object/row.
     *
     * @param array $values key/values to save or empty to use object properties.
     *
     * @return boolean true or false if saving went okey.
         */
    public function save($values = []){


        $this->setProperties($values);

        $values = $this->getProperties();

        if (isset($values['id'])) {

            return $this->update($values);
        } else {

            return $this->create($values);
        }


        
    }

    /*
     * Set properties obj
     * @param array $properties  with properties to set
     * 
     * @return void
     *
     **/
    public function setProperties($properties){

        //update obj witj incoming values if any
        if(!empty($properties)){
            foreach ($properties as $key => $val) {
                # code...
                $this->$key = $val;
            }
        }
    }
    /**
     * Get object properties
     *
     * @return array with object properties
     *
     */
    /**
 * Get object properties.
 *
 * @return array with object properties.
 */
public function getProperties()
{
    $properties = get_object_vars($this);
    unset($properties['di']);
    unset($properties['db']);

    return $properties;
}
}