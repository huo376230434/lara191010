<?php

namespace Huojunhao\LaraAdmin\BaseExtends\Plugins\Config;

use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{

    public static function configTable()
    {
        return config('admin.extensions.config.table', 'admin_config');

    }

    public static function loadConfigs()
    {
        foreach (ConfigModel::all(['name', 'value']) as $config) {
            config([$config['name'] => $config['value']]);
        }
    }

    /**
     * Settings constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(config('admin.database.connection') ?: config('database.default'));

        $this->setTable(static::configTable());
    }
}
