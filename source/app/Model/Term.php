<?php
App::uses('Model', 'AppModel');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @author : Bishwanath Jha <bishwanathkj@gmail.com>
 *
 * @package       Post.Model
 */
class Term extends AppModel
{
    public $name = 'Term';
    public $useTable = 'terms';
    public $primaryKey = 'term_id';

    // Core constants
    const TYPE_TAG = 'tag';
    const TYPE_CATEGORY = 'category';
    const TYPE_NONE = 'none';

    /**
     * @param $type
     * @return bool
     */
    static public function IsValidType($type)
    {
        return in_array($type, array(self::TYPE_CATEGORY, self::TYPE_TAG));
    }


    /**
     * Fetch all category/tag
     *
     * @param string $type (category/tag)
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function GetAll($type)
    {
        if (!self::IsValidType($type)) {
            throw new InvalidArgumentException('Invalid Argument provided.');
        }
        $param['conditions'] = array("term.type = '" . $type . "' ");
        $results = array();
        foreach ($this->find('all', $param) as $value) {
            $results[] = $value['term'];
        }
        return $results;
    }

    /**
     * Fetch category/tag based on id
     *
     * @param string $type (category/tag)
     * @param $id
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function GetOnID($type, $id)
    {
        if (empty($id) && !self::IsValidType($type)) {
            throw new InvalidArgumentException('Invalid Argument provided.');
        }

        $param['conditions'] = array('conditions' =>
            array("term.type = '" . $type . "'
                                            AND term.term_id = " . intval($id)));
        return $this->find('first', $param);
    }

    /**
     * Fetch category/tag based on name
     *
     * @param string $type (category/tag)
     * @param string $name
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function GetOnName($type, $name)
    {
        if (empty($name) && !self::IsValidType($type)) {
            throw new InvalidArgumentException('Invalid Argument provided.');
        }

        $param['conditions'] = array('conditions' =>
            array("term.type = '" . $type . "'
                                                AND term.name = '" . $name . "'"));
        return $this->find('first', $param);
    }
}
