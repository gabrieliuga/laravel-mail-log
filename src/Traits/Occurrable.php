<?php

namespace Giuga\LaravelMailLog\Traits;

use Illuminate\Database\Eloquent\Model;

trait Occurrable {



    public static function getOccuredProcessKey() {
        return 'event.occurred_process';
    }



    public static function getOccuredEntityKey() {
        return 'event.occurred_entity';
    }



    public function occurred(Model $entity = null, Model $process = null) {

        $this->with(static::getOccuredEntityKey(), $entity);

        $this->with(static::getOccuredProcessKey(), $process);

        return $this;
    }



}
