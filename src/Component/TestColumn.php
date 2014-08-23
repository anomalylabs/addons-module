<?php namespace Streams\Addon\Module\Addons\Component;

use Streams\Core\Ui\Component\TableColumn;

class TestColumn extends TableColumn
{
    protected function buildData()
    {
        return 'I says dis ' . $this->entry->getKey();
    }
}
