# Random User PHP SDK

This SDK allows You to generate from 1 to 2048 users at one time        

## API

`KielD01\RandomUser::__construct($version = null)`  
Sets the latest version, if `$version` is null or throws an `Exception`.      

`KielD01\RandomUser::asJson()`      
Sets the header of Content-Type to `application/json`.       

`KielD01\RandomUser::setVersion($version = null)`   
Sets the `$this->version` to `$version`. Throws an `Exception`.

`KielD01\RandomUser::setOutputFormat($format = null)`       
Sets the output format between `'json', 'xml', 'pretty', 'yaml', 'csv'`     

`KielD01\RandomUser::setResultsCount($results = null)`      
Sets results count. Available range is from 1 to 2048.

`KielD01\RandomUser::setPage($page = 1)`        
Sets results page

`KielD01\RandomUser::setSeed($seed = null)`     
Sets seed

`KielD01\RandomUser::setNoInfo($noInfo = false)`        
Disable or Enable `info` object.

`KielD01\RandomUser::setNationalityOnly($nationality = null, $value = false)`       
Set nationality value or values to `$value`

`KielD01\RandomUser::setIncludedOrExcludedFields($type = 'inc', $fields = null, $value = true)`     
Sets included or excluded fields

`KielD01\RandomUser::getVersion()`      
Returns version

`KielD01\RandomUser::getNationalities()`        
Returns nationalities list due to version

`KielD01\RandomUser::getQuery()`    
Returns request query to be sent

`KielD01\RandomUser::getResults()`      
Returns `KielD01\RandomUser\Helpers\Colelction`, which contains `items` array of an `KielD01\RandomUser\Helpers\Entity`

`KielD01\RandomUser::fetch($debug = false)`     
Fetch the results from the API and transform it into `KielD01\RandomUser\Helpers\Collection`

## Example
```php
<?php

use KielD01\RandomUser\RandomUser;

try {
    $randomUser = new RandomUser('1.1');

    $results = $randomUser
        ->setNationalityOnly('us', true)
        ->setResultsCount(50)
        ->fetch()
        ->getResults();

    // ToDo : Process with $results
} catch (Exception $e) {
    echo "<pre>{$e->getMessage()}</pre>";
}
```
