<?php


namespace App\Traits;


use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

Trait Searcher
{
    /**
     * @param $model
     * @param array $with
     * @param array $joins
     * @param array $searchColumns
     * @param string[] $selectColumns
     * @param array $where
     * @param array $where_Not_or_just_In
     * @param array $order
     * @param string $output_style
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     *
     * $joins = [
        * [
            * 'categories',
        * [
            * ['categories.id','=','sub_categories.parent_id']
        * ],
            * 'left'
        * ],
     * ];
     * $data = $this->searching(Model::class,$with,$joins,$searchColumns,['*'],$where,$where_Not_or_just_In,$order);
     */
    public function searching($model, array $with = [], array $joins = [], array $searchColumns = [], array $selectColumns = ['*'], array $where = [], array $where_Not_or_just_In = [], array $order = [], string $output_style = 'pagination_format')
    {
        $this->validate(request(), [
            'count' => 'nullable|integer|min:1|max:500',
            'search' => 'nullable|max:25',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $count  = \request()->get('count') ? \request()->get('count') : config('system.per_page');

        $search = \request()->get('search') ? \request()->get('search') : null;

        $data = $model::query();

        if (!empty($with))
        {
            $data = $data->with($with);
        }

        foreach ($joins as $join)
        {
            $table      = $join[0];
            $conditions = $join[1];
            $joinType   = $join[2];

            $data = $data->{$joinType.'join'}($table, static function($join) use ($conditions)
            {
                foreach ($conditions as $condition)
                {
                    $join->on($condition[0], $condition[1], $condition[2]);
                }
            });
        }

        foreach ($where as $condition)
        {
            $data = $data->where($condition[0],$condition[1],$condition[2]);
        }

        foreach ($where_Not_or_just_In as $condition)
        {
            if ($condition[2])
            {
                $data = $data->{'where'.$condition[0]}($condition[1], $condition[2]);
            }
        }

        if ($search)
        {
            $searchValues = preg_split('/\s+/', $search, -1, PREG_SPLIT_NO_EMPTY);


            $data = $data->where(static function($q) use($searchColumns, $searchValues) {
                foreach ($searchColumns as $searchColumn)
                {
                    foreach ($searchValues as $searchValue)
                    {
                        $q->orWhere($searchColumn, 'like', "%{$searchValue}%");
                    }
                }
            });
        }

        $data->select($selectColumns);

        foreach ($order as $orderItem)
        {
            $data = $data->orderBy($orderItem[0],$orderItem[1]);
        }

        if ($output_style == 'pagination_format')
        {
            return $data->paginate($count);
        }
        else
        {
            return $data->take($count)->get();
        }
    }
}
