<?php

namespace Esign\AutoTimestamps\Database;

use Esign\AutoTimestamps\Database\Schema\Grammars\ExtendedMySqlGrammar;
use Illuminate\Database\MySqlConnection;

class ExtendedMySqlConnection extends MySqlConnection
{
    /**
     * Get the default schema grammar instance.
     *
     * @return \Esign\AutoTimestamps\Database\Schema\Grammars\ExtendedMySqlGrammar;
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new ExtendedMySqlGrammar);
    }
}
