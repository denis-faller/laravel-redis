<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    // Геттеры и сеттеры
    public function test()
    {   
        Redis::set('name', 'Taylor');
        if(Redis::exists('name')){
            echo Redis::get('name');
        }
    }
    
    // Инкремент и декремент
    public function test2()
    {   
        Redis::set('counter', 0);
        
        Redis::incr('counter');
        Redis::incr('counter');
        
        Redis::decr('counter');
        
        echo Redis::get('counter');
        
        echo '<br>';
        
        Redis::set('counter', 0);
        
        Redis::incrby('counter', 5);
        Redis::incrby('counter', 10);
        
        Redis::decrby('counter', 5);
        
        echo Redis::get('counter');
    }
    
    // Работа с списками
    public function test3()
    {   
        Redis::del('names');
        
        Redis::lpush('names', 'Ivan');
        Redis::lpush('names', 'Fedor');
        
        print_r(Redis::lrange('names', 0, 1));
        
        echo '<br>';
        
        Redis::rpush('names', 'Jhon');
        Redis::rpush('names', 'Michael');
        
        print_r(Redis::lrange('names', 0, 3));
        
        echo '<br>';
        
        echo Redis::lpop('names');
        
        echo '<br>';
        
        echo Redis::rpop('names');
        
        echo '<br>';
        
        echo Redis::llen('names');
        
        echo '<br>';
    }
    
    // Работа с хэш-таблицами
    public function test4()
    {   
        $key = "linus torvalds";
        
        Redis::hset($key, 'age', 44);
        Redis::hset($key, 'country', 'finland');
        Redis::hset($key, 'occupation', 'software engineer');
        Redis::hset($key, 'reknown', 'linux kernel');
        
        echo Redis::hget($key, 'age');
        echo '<br>';
        echo Redis::hget($key, 'country');
        echo '<br>';
        
        Redis::hmset($key, [
            'age' => 45,
            'country' => 'finland',
            'occupation' => 'software engineer',
            'reknown' => 'linux kernel',
            ]);

        print_r(Redis::hgetall($key));
        echo '<br>';
    }
    
    // Работа с множествами
    public function test5()
    {   
        $key = "countries";
        Redis::sadd($key, 'china');
        Redis::sadd($key, ['england', 'france', 'germany']);
        Redis::sadd($key, 'china');

        Redis::srem($key, ['england', 'china']);
        
        echo Redis::sismember($key, 'england');
        echo '<br>';
        
        print_r(Redis::smembers($key));
        echo '<br>';
    }
    
    // Время истечения
    public function test6()
    {   
        $key = "expire in 1 hour";
        Redis::set($key, 'Test');
        Redis::expire($key, 3600); // истечёт через 1 час
        Redis::expireat($key, time() + 3600);// истечёт через 1 час
        
        echo Redis::ttl($key);
        echo '<br>';

        Redis::persist($key); // никогда не истечёт
    }
    
    // Конвейер команд
    public function test7()
    {   
        Redis::pipeline(function ($pipe) {
          for ($i = 0; $i < 3; $i++) {
            $pipe->set("key:$i", $i);
          }
        });
        echo Redis::get("key:2");
        echo '<br>';
    }
}