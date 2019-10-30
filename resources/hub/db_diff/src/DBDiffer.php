<?php

namespace Encore\Admin\DBDiff;

use Illuminate\Database\MySqlConnection;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

class DBDiffer
{
    /**
     * @var array
     */
    protected $connections = [];

    /**
     * @var array
     */
    protected $tables = [];

    /**
     * DBDiffer constructor.
     *
     * @param MySqlConnection $source
     * @param MySqlConnection $target
     */
    public function __construct(MySqlConnection $source, MySqlConnection $target)
    {
        $this->connections = compact('source', 'target');

        $this->initTables();
    }

    protected function initTables()
    {
        $this->tables = [
            'source' => $this->getTables($this->connections['source']),
            'target' => $this->getTables($this->connections['target']),
        ];
    }

    /**
     * @return string
     */
    public function getDiff()
    {
        $diffs = [];

        foreach (array_flatten($this->tables) as $table) {
            $diffs[$table] = $this->diffCreateTableExpr($table);
        }

        return implode("\n", array_filter($diffs));
    }

    /**
     * @param string $table
     * @return string
     */
    protected function diffCreateTableExpr($table)
    {
        $header = $this->getDiffHeader($table);

        $builder = new UnifiedDiffOutputBuilder($header, true);

        $differ = new Differ($builder);

        $diff = $differ->diff(
            $this->getSourceCreateTableExpr($table),
            $this->getTargetCreateTableExpr($table)
        );

        if (substr_count($diff, "\n") == 3) {
            return '';
        }

        return $diff;
    }

    /**
     * @param string $table
     * @return string
     */
    protected function getDiffHeader(string $table)
    {
        $header = "diff $table\n--- $table\n+++ $table\n";

        if (!in_array($table, $this->tables['target'])) {
            $header = "diff $table\ndeleted file mode 100644\n--- /dev/null\n+++ $table\n";
        }

        if (!in_array($table, $this->tables['source'])) {
            $header = "diff $table\nnew file mode 100644\n--- /dev/null\n+++ $table\n";
        }

        return $header;
    }

    /**
     * @param MySqlConnection $connection
     * @param string $table
     * @return string
     */
    protected function getCreateTableExpr(MySqlConnection $connection, $table)
    {
        $sql = "SHOW CREATE TABLE {$table}";

        $expression = $connection->select($sql);

        return $this->purify(data_get($expression, '0.Create Table'));
    }

    /**
     * @param string $table
     * @return string
     */
    protected function getSourceCreateTableExpr($table)
    {
        if (!in_array($table, $this->tables['source'])) {
            return '';
        }

        return $this->getCreateTableExpr($this->connections['source'], $table);
    }

    /**
     * @param string $table
     * @return string
     */
    protected function getTargetCreateTableExpr($table)
    {
        if (!in_array($table, $this->tables['target'])) {
            return '';
        }

        return $this->getCreateTableExpr($this->connections['target'], $table);
    }

    /**
     * @param string $text
     * @return string
     */
    protected function purify(string $text) : string
    {
        return preg_replace('/AUTO_INCREMENT=\d+ /', '', $text);
    }

    /**
     * @param MySqlConnection $connection
     * @return array
     */
    protected function getTables(MySqlConnection $connection) : array
    {
        $results = $connection->select('SHOW TABLES;');

        return array_flatten(json_decode(json_encode($results), true));
    }
}
