<?php

namespace App;

use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class DataTableHelper
{
    private int $draw;
    private int $totalRecords;
    private int $showLength;
    private int $startFrom;
    private array $search;
    private array $order;
    private array $columns;
    private array $dtColumns;
    private array $orderables;
    private mixed $data;
    private mixed $result;
    private ?Closure $columnsCallback = null;
    private ?Closure $filterCallback = null;
    private ?Closure $applyCallback = null;
    private array $filterColumns;
    private bool $autoIndex = false;
    private array $ignoredColumns = [];

    public function __construct(protected $query)
    {
        $this->draw = intval(request()->draw);
        $this->search = request()->search;
        $this->order = request()->order;
        $this->showLength = intval(request()->length);
        $this->startFrom = intval(request()->start);
        $this->dtColumns = request()->columns;
        $this->columns = Arr::pluck(array_filter($this->dtColumns, fn ($col) => $col['searchable']=='true'), 'name');
        $this->orderables = Arr::pluck(array_filter($this->dtColumns, fn ($col) => $col['orderable']=='true'), 'name');

        return $this;
    }

    public static function create($query): static
    {
        return new static($query);
    }

    public function columns(Closure $callback): static
    {
        $this->columnsCallback = $callback;

        return $this;
    }

    public function apply(Closure $callback): static
    {
        $this->applyCallback = $callback;

        return $this;
    }

    public function filter(Closure $callback): static
    {
        $this->filterCallback = $callback;

        return $this;
    }

    public function ignoreInQuery(array $columns): static
    {
        $this->ignoredColumns = $columns;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function make(): array
    {
        $this->defineSearch();
        $this->defineOrder();
        $this->executeQuery();
        $this->filterData();
        $this->buildAutoIndex();

        return [
            'draw' => $this->draw,
            'data' => $this->data,
            'recordsTotal' => $this->totalRecords,
            'recordsFiltered' => $this->totalRecords,
            'request' => request()->all(),
        ];
    }

    /**
     * @throws Exception
     */
    public function array()
    {
        return $this->make();
    }

    /**
     * @throws Exception
     */
    public function json(): JsonResponse
    {
        //return response()->json($this->search);
        return response()->json(
            $this->array()
        );
    }

    private function ignored($column): bool
    {
        return in_array($column, [...$this->ignoredColumns, 'dt_auto_index']);
    }

    private function getIgnored(): array
    {
        return [...$this->ignoredColumns, 'dt_auto_index'];
    }

    private function getSearchableColumns(): array
    {
        return array_diff($this->columns, $this->filterColumns, $this->getIgnored());
    }

    private function defineSearch(): void
    {
        $this->filterColumns = [];
        if (!empty($this->search['value'])) {
            $this->query->where(function($builder) {
                $searchValue = $this->search['value'];
                if($this->filterCallback) {
                    $filter = call_user_func($this->filterCallback, $builder, $searchValue);
                    $this->filterColumns = array_keys($filter);
                }
                $searchableColumns = $this->getSearchableColumns();
                foreach ($searchableColumns as $column) {
                    $builder->orWhere($column, 'like', "%$searchValue%");
                }
            });
        }
    }

    private function defineOrder(): void
    {
        // Handle ordering
        if (!empty($this->order)) {
            $_column = $this->order[0]['column'];
            $orderColumn = $this->dtColumns[$_column]['data'];
            $orderDir = $this->order[0]['dir'];
            if(in_array($orderColumn, $this->orderables) &&  !$this->ignored($orderColumn)) {
                $this->query->orderBy($orderColumn, $orderDir);
            }
        }
    }

    private function filterData(): void
    {
        if ($this->columnsCallback) {
            $this->data = $this->result->map(function() {
                return call_user_func($this->columnsCallback, ...func_get_args());
            })->toArray();
            return;
        }
        $this->data = $this->result->toArray();
    }

    private function executeQuery(): void
    {
        if ($this->applyCallback) {
            call_user_func($this->applyCallback, $this->query);
        }
        $this->totalRecords = (clone $this->query)->count();
        $this->result = $this->query->skip($this->startFrom)
            ->take($this->showLength)
            ->get();
    }

    public function addAutoIndex(): static
    {
        $this->autoIndex = true;

        return $this;
    }

    private function buildAutoIndex(): void
    {
        if ($this->autoIndex) {
            $_index = $this->startFrom;
            foreach ($this->data as $_key => $value) {
                $this->data[$_key]['dt_auto_index'] = ++$_index;
            }
        }
    }
}
