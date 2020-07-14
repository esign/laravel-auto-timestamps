<?php

namespace Esign\AutoTimestamps\Database\Schema\Grammars;

use Illuminate\Database\Schema\Grammars\MySqlGrammar;
use Illuminate\Support\Fluent;

class ExtendedMySqlGrammar extends MySqlGrammar
{
    /**
     * Create the column definition for a timestamp type.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeTimestamp(Fluent $column)
    {
        $columnType = $column->precision ? "timestamp($column->precision)" : 'timestamp';

        $defaultCurrent = $column->precision ? "CURRENT_TIMESTAMP($column->precision)" : 'CURRENT_TIMESTAMP';

        if ($column->useCurrent) {
            return "$columnType default $defaultCurrent";
        }

        if ($column->useCurrentUpdate) {
            return "$columnType default $defaultCurrent ON UPDATE CURRENT_TIMESTAMP";
        }

        return $columnType;
    }
}
