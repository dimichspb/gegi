<?php

namespace app\models\month;

use app\models\BaseSearchModel;

/**
 * Search represents the model behind the search form of `app\models\month\Month`.
 */
class SearchModel extends BaseSearchModel
{
    public $id;
    public $name;
    public $page;
    public $limit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'safe'],
            [['page', 'limit'], 'integer'],
        ];
    }
}
