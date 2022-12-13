<?php

namespace App\Utilities\Helper;

use Carbon\Carbon;

class QueryHelper
{
    public static function tokenizeKeywords(string $searchValue): array
    {
        $keywords = array_filter(array_map('trim', explode(' ', trim($searchValue))));
        return $keywords;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $cols
     * @param array $keywords
     */
    public static function searchColumns($query, array $cols, array $keywords)
    {
        foreach ($cols as $col) {
            $query->orWhere(function ($inQuery) use (&$keywords, &$col) {
                foreach ($keywords as $keyword) {
                    $inQuery->where($col, 'like', '%' . $keyword . '%');
                }
            });
        }
    }

    /**
     * the columns should considered joined string, like firstName and lastName
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $cols
     * @param array $keywords
     */
    public static function searchJoinedColumns($query, array $cols, array $keywords)
    {
        foreach ($cols as $col) {
            foreach ($keywords as $keyword) {
                $query->orWhere($col, 'like', '%' . $keyword . '%');
            }
        }
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $col
     * @param string $range
     * $range format {d/m/Y}-{d/m/Y}, either can be empty
     */
    public static function dateRange($query, string $col, string $range)
    {
        $dataValues = explode('-', $range);

        $from = empty($dataValues[0]) ? null :
            Carbon::createFromFormat('d/m/Y H:i:s', $dataValues[0] . ' 00:00:00');
        $to = empty($dataValues[1]) ? null :
            Carbon::createFromFormat('d/m/Y H:i:s', $dataValues[1] . ' 23:59:59');

        if ($from) {
            $query->where($col, '>=', $from);
        }
        if ($to) {
            $query->where($col, '<=', $to);
        }
    }
}
