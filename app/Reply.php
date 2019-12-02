<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favouritable, RecordsActivity;

    protected $guarded = [];

    protected $with = ['owner', 'thread', 'favourites'];  //используем вместо метода boot. Подгружаем зависимости в одном sql запрос

    // полe $appends магическим образом позволяет вызвать методы модели с именем get_customMethodName_attribute (например getIsFavouritedAttribute)
    // и добавить результат выполнения метода в конце json ответа
//    protected $appends = ['isFavourited'];


    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path().'#reply-'.$this->id;
    }
}
