<?php
/**
 * Created by PhpStorm.
 * User: Edgardo
 * Date: 10/30/2018
 * Time: 11:39 PM
 */
include 'models/commentModel.php';


class Comments
{

    public function __construct(){
        $this->commento = new commentModel();
    }

    /**
     *
     * @return array
     */
    public function getComments()
    {
        $all_comments = $this->commento->getComments();
        $results = [];

        $results = $this->getChildComments($all_comments);

        return $results;
    }

    /**
     *
     * @param $data
     * @return mixed
     */
    public function addComment($data)
    {
        return $this->commento->addComment($data);
    }

    /**
     * Helper function that appends child comments to its parent.
     * @param array $elements
     * @param int $parent_id
     * @return array
     */
    private function getChildComments(array $elements, $parent_id = 0) {
        $parent = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parent_id) {
                $children = $this->getChildComments($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $parent[] = $element;
            }
        }

        return $parent;
    }


}