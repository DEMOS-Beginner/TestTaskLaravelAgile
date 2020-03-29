<?php


/**
*
* Занимается фильтрацией запросов для менеджера
*
*/

namespace App;


class RequestsFilter
{
	protected $builder;
	protected $request;

	/**
	* RequestsFilter constructor
	*/
	public function __construct($builder, $request) {
		$this->builder = $builder;
		$this->request = $request;
	}

	public function apply() {
		foreach($this->filters() as $filter => $value) {
			if (method_exists($this, $filter)) {
				$this->builder = $this->$filter($value);
			}
		}
		return $this->builder;
	}

	public function filters() {
		return $this->request->all();
	}

	public function looked() {
		return $this->builder->where('status', '==', '2');
	}

	public function no_looked() {
		return $this->builder->where('status', '!=', '2');
	}

	public function opened() {
		return $this->builder->where('status', '!=', '1');
	}

	public function accepted() {
		return $this->builder->where('status', '==', '1');
	}
}
