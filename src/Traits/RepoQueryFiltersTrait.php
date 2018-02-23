<?php

namespace Ksoft\Klaravel\Traits;

/**
* Trait QueryFiltersTrait.
*/
trait QueryFiltersTrait
{
    protected function applySingleAttrsFilters($request)
    {
        foreach ($this->attrsFilter as $key) {
          if ($request->filled($key)) {
            $this->query->where($key, 'LIKE', '%'.$request->get($key).'%');
          }
        }
    }

    protected function removeSingleAttrFilter(array $filtro)
    {
        if (count($filtro)>0) {
            $this->attrsFilter = array_diff($this->attrsFilter, $filtro);
        }
    }

    protected function filterBool($attr, $value)
    {
        if ($value == 'NULL') { // hardcoded en VUE - could be any string.
            $this->query->whereNull($attr);
        } elseif ($value == 'NOT_NULL'){
            $this->query->whereNotNull($attr);
        } else {
            $this->query->where($attr, $value);
        }
    }

    protected function applyDateRangeFilter($request, $field = 'dateRange', $attr = 'created_at')
    {
        if ($request->filled($field)) {

            $range = $request->get($field);

            if ($range[0] == $range[1]) {
                $this->query->whereDate($attr, $range[0]);
            } else if (count($range)>1) {
                $this->query->whereDate($attr, '>=', $range[0])
                            ->whereDate($attr, '<=', $range[1]);
            }
        }
    }

    // this is a range comming from VUE element-ui
    protected function applyDateSessionFilter($request, $attr = 'created_at')
    {
        $session_name_from = config('klaravel.modules.crud.session_range_from');
        $session_name_to = config('klaravel.modules.crud.session_range_from');

        if ($request->has('d')){
            $desde = $request->get('d');
            $hasta = $request->get('a');

            session([$session_name_from => $desde]);
            session([$session_name_to => $hasta]);
        } else {
            $desde = session($session_name_from);
            $hasta = session($session_name_to);
        }

        if (!is_null($desde) && !is_null($hasta)) {

            session([$session_name_from => $desde]);
            session([$session_name_to => $hasta]);

            if ($desde == $hasta) {
                $this->query->whereDate($attr, $desde);
            } else if (!is_null($desde) && !is_null($hasta)) {
                $this->query->whereDate($attr, '>=', $desde)
                    ->whereDate($attr, '<=', $hasta);
            }
        }
    }
}
