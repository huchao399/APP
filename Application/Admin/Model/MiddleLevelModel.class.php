<?php
/**
 * Created by PhpStorm.
 * User: huchao
 * Date: 2017/11/30
 * Time: 15:27
 */

namespace Admin\Model;

use Think\Model\RelationModel;

class MiddleLevelModel extends RelationModel {
    protected $_link = array(
        'high_level' => array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key' => 'high_id',
            'as_fields' => 'high_name'
        )
    );
}