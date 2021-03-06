<?php

namespace RippleAdmin\Pages;

use RippleAdmin\Components\Table;
use RippleAdmin\Page;

class TablePage extends Page
{
    protected $name = 'List/Table';

    protected $title = 'Table page';

    public function columns()
    {
        return $this->droplet->getFieldsLabel();
    }

    public function data()
    {
        return $this->droplet->buildModelData();
    }

    public function pageProps()
    {
        return [
            'table' => Table::make()
                ->setColumns($this->columns())
                ->setData($this->data()),
        ];
    }
}
