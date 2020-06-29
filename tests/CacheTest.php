<?php

    namespace Tests;

    use App\Utils\Cache;

    class CacheTest extends Wrapper{

        public function testFileCache(){
            $handler = new \Lefuturiste\LocalStorage\LocalStorage("./cache.json");
            $cache = new Cache("file", $handler);

            $this->assertEquals(false, $cache->has("track:random_element"));
            $cache->set("track:random_element", "content");
            $this->assertEquals("content", $cache->get("track:random_element"));
            $cache->removeOlderElements();
            $this->assertEquals(true, $cache->has("track:random_element"));
            $handler->del("track:random_element");
            $handler->save();
        }

        public function testRedisCache(){
            $handler = new \Predis\Client([
                'scheme' => 'tcp',
                'host'   => '127.0.0.1',
                'port'   => '6379',
            ]);
            $cache = new Cache("redis", $handler);

            $this->assertEquals(false, $cache->has("track:random_element"));
            $cache->set("track:random_element", "content");
            $this->assertEquals("content", $cache->get("track:random_element"));
            $cache->removeOlderElements();
            $this->assertEquals(true, $cache->has("track:random_element"));
            $handler->del("track:random_element");
            $handler->save();
        }

    }