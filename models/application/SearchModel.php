<?php

namespace app\models\application;

use app\models\BaseSearchModel;

/**
 * Search represents the model behind the search form of `app\models\application\Application`.
 */
class SearchModel extends BaseSearchModel
{
    public $id;
    public $program_id;
    public $month_id;
    public $from;
    public $to;
    public $page;
    public $limit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id',], 'safe'],
            [['program_id', 'month_id', 'from', 'to',], 'integer'],
            [['page', 'limit'], 'integer'],
        ];
    }
}
