<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;

class RedisSubscribe extends Command
{
  /**
   * Название и сигнатура терминальной команды.
   *
   * @var string
   */
  protected $signature = 'redis:subscribe';

  /**
   * Описание терминальной команды.
   *
   * @var string
   */
  protected $description = 'Subscribe to a Redis channel';

  /**
   * Выполнение терминальной команды.
   *
   * @return mixed
   */
  public function handle()
  {
    Redis::subscribe(['test-channel'], function ($message) {
      echo $message;
    });
  }
}