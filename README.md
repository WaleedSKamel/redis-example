php artisan migrate:refresh --seed

php artisan migrate:fresh --seed

* queue
* php artisan queue:work  // default queue
* php artisan queue:work --queue=Waleed  // if you want to fire queue by name
* how to stop queue when running

redis-cli // enter to redis

keys * // get all keys in redis
set keyName "KeyValue" //how to set key in redis and value on this key

get KeyName //to get value on this keyName 

del keyName // to delete key name and value on this key

  // delete all keys 

