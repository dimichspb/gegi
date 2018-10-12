<?php

namespace app\models\result;

use app\models\BaseSearchModel;

/**
 * Search represents the model behind the search form of `app\models\result\Result`.
 */
class SearchModel extends BaseSearchModel
{
    public $program_id;
    public $page;
    public $limit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_id',], 'integer'],
            [['page', 'limit'], 'integer'],
        ];
    }
}
