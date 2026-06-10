<?php

namespace App\Traits;

trait Searchable
{
    /*
    ===================================
    ===== BASIC COLUMN SEARCH =====
    ===================================
    */
    public function scopeSearch($query, ?string $search)
    {
        if (!$search) return $query;

        $columns = $this->searchable ?? [];

        return $query->where(function ($q) use ($search, $columns) {

            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', "%{$search}%");
            }
        });
    }

    /*
    ===================================
    ===== RELATION SEARCH =====
    ===================================
    */
    public function scopeSearchRelations($query, ?string $search, array $relations = [])
    {
        if (!$search || empty($relations)) return $query;

        return $query->where(function ($q) use ($search, $relations) {

            foreach ($relations as $relation => $columns) {

                $q->orWhereHas($relation, function ($relQuery) use ($search, $columns) {

                    foreach ($columns as $column) {
                        $relQuery->orWhere($column, 'LIKE', "%{$search}%");
                    }
                });
            }
        });
    }
}
