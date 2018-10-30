<?php

namespace KielD01\RandomUser;

use Exception;
use GuzzleHttp\Client;
use KielD01\RandomUser\Helpers\Collection;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RandomUser
 * @package KielD01\RandomUser
 * @property Info info
 * @property Collection|null results
 */
class RandomUser
{

    /**
     * Available output formats
     *
     * @var array
     */
    private $formats = array(
        'json',
        'xml',
        'pretty',
        'yaml',
        'csv'
    );

    /**
     * Fields list
     *
     * @var array
     */
    private $fields = array(
        'gender' => true,
        'name' => true,
        'location' => true,
        'email' => true,
        'login' => true,
        'registered' => true,
        'dob' => true,
        'phone' => true,
        'cell' => true,
        'id' => true,
        'picture' => true,
        'nat' => true,
    );

    /**
     * Currently available versions
     *
     * @var array
     */
    private $versions = array(
        '1.0', '1.1', '1.2'
    );

    /**
     * Currently available nationalities
     *
     * @var array
     */
    private $nationalities = array(
        '1.0' => array(
            'AU' => false,
            'BR' => false,
            'CA' => false,
            'CH' => false,
            'DE' => false,
            'DK' => false,
            'ES' => false,
            'FI' => false,
            'FR' => false,
            'GB' => false,
            'IE' => false,
            'IR' => false,
            'NL' => false,
            'NZ' => false,
            'TR' => false,
            'US' => false
        ),
        '1.1' => array(
            'AU' => false,
            'BR' => false,
            'CA' => false,
            'CH' => false,
            'DE' => false,
            'DK' => false,
            'ES' => false,
            'FI' => false,
            'FR' => false,
            'GB' => false,
            'IE' => false,
            'IR' => false,
            'NL' => false,
            'NZ' => false,
            'TR' => false,
            'US' => false
        ),
        '1.2' => array(
            'AU' => false,
            'BR' => false,
            'CA' => false,
            'CH' => false,
            'DE' => false,
            'DK' => false,
            'ES' => false,
            'FI' => false,
            'FR' => false,
            'GB' => false,
            'IE' => false,
            'IR' => false,
            'NO' => false,
            'NL' => false,
            'NZ' => false,
            'TR' => false,
            'US' => false
        )
    );

    /**
     * Endpoint placeholder
     *
     * @var string
     */
    private $endpoint = 'https://randomuser.me/api/{v}';

    /** @var string API Version */
    private $version;

    /** @var Collection */
    private $results = null;

    /**
     * Query params
     *
     * @var array
     */
    private $query = array(
        'format' => 'json',
        'results' => 12,
        'page' => 1,
        'seed' => false,
        'noinfo' => false,

        /** Fields Filter */
        'nat' => array(),
        'inc' => array(),
        'exc' => array()
    );

    /**
     * RandomUser constructor.
     * @param null $version
     * @throws Exception
     */
    public function __construct($version = null)
    {
        $this->version = end($this->versions);

        if ($version) {
            $this->setVersion($version);
        }

        $this->query['inc'] = $this->fields;
        $this->query['exc'] = $this->fields;

        foreach ($this->query['exc'] as $index => $value) {
            $this->query['exc'][$index] = false;
        }
    }

    /**
     * Sets header from text/html to application/json
     *
     * @return $this
     */
    public function asJson()
    {
        header('Content-Type: application/json');
        return $this;
    }

    /**
     * Sets the version to be executed
     *
     * @param null $version
     * @return $this
     * @throws Exception
     */
    public function setVersion($version = null)
    {
        if (!$version || !in_array($version, $this->versions)) {
            throw new Exception('Failed to find version ' . $version . ' within available list', 404);
        }

        $this->version = strval($version);
        $this->query['nat'] = $this->nationalities[$version];
        return $this;
    }

    /**
     * Sets output format
     *
     * @param null $format
     * @return $this
     * @throws Exception
     */
    public function setOutputFormat($format = null)
    {
        if (!$format || !in_array($format, $this->formats)) {
            throw new Exception('Failed to find format ' . $format . ' within available list', 404);
        }

        $this->query['format'] = $format;
        return $this;
    }

    /**
     * @param int $result
     * @return $this
     * @throws Exception
     */
    public function setResultsCount($result = 12)
    {
        if (!$result || !in_array($result, range(1, 2048))) {
            throw new Exception('Results count number is lower than 1 or nullable');
        }

        $this->query['results'] = $result;
        return $this;
    }

    /**
     * Sets the page index
     *
     * @param int $page
     * @return $this
     * @throws Exception
     */
    public function setPage($page = 1)
    {
        if (!$page || $page < 1) {
            throw new Exception('Page number can\'t be lower than 1 or nullable');
        }

        $this->query['page'] = $page;
        return $this;
    }

    /**
     * Sets seed
     *
     * @param null $seed
     * @return $this
     */
    public function setSeed($seed = null)
    {
        $this->query['seed'] = $seed;
        return $this;
    }

    /**
     * Sets noinfo
     *
     * @param bool $noInfo
     * @return $this
     */
    public function setNoInfo($noInfo = false)
    {
        $this->query['noinfo'] = $noInfo;
        return $this;
    }

    /**
     * Switch nationality to true or false
     *
     * @param null $nationality
     * @param bool $value
     * @return $this
     * @throws Exception
     */
    public function setNationalityOnly($nationality = null, $value = false)
    {
        if (!$nationality || !array_key_exists(strtoupper($nationality), $this->query['nat'])) {
            throw new Exception('No nationality like ' . $nationality . ' within the list');
        }

        $this->query['nat'][strtoupper($nationality)] = $value;
        return $this;
    }

    /**
     * Sets included fields
     *
     * @param string $type
     * @param null $fields
     * @param bool $value
     * @return $this
     * @throws Exception
     */
    public function setIncludedOrExcludedFields($type = 'inc', $fields = null, $value = true)
    {
        if (!$fields || !in_array($type, ['inc', 'exc'])) {
            throw new Exception('Fields are empty or type of action is not within `inc` or `exc`');
        }

        if (is_string($fields)) {
            $this->query[$type][$fields] = $value;
        }

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $this->query[$type][$field] = $value;
            }
        }

        return $this;
    }

    /**
     * Returns version
     *
     * @return float|mixed|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Returns nationalities list
     *
     * @return array
     */
    public function getNationalities()
    {
        return $this->nationalities[$this->getVersion()];
    }

    /**
     * Returns query
     *
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return Collection|null
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param bool $debug
     * @return $this
     */
    public function fetch($debug = false)
    {
        $uri = str_replace('{v}', $this->getVersion(), $this->endpoint);
        $http = new Client();

        $query = $uri . '?' . $this->prepareRequest();
        if ($debug) {
            die(json_encode($query, JSON_PRETTY_PRINT));
        }

        $response = $this->convertFromJson($http->get($query));
        $this->results = new Collection($response->results);
        $this->info = new Info($response->info);

        return $this;
    }

    /**
     * Prepares request query
     *
     * @return string
     */
    private function prepareRequest()
    {
        $this->glue($this->query['nat']);
        $this->glue($this->query['exc']);
        $this->glue($this->query['inc']);

        return urldecode(http_build_query(array_filter($this->query)));
    }

    /**
     * Join array items with a delimiter
     *
     * @param $variable
     */
    private function glue(&$variable)
    {
        $variable = implode(',', $this->getKeys($variable));

        if (!$variable) {
            $variable = false;
        }
    }

    /**
     * Getting keys from the array
     *
     * @param array $array
     * @return array
     */
    private function getKeys($array = [])
    {
        $keys = array();

        foreach ($array as $key => $bool) {
            !$bool ?: array_push($keys, $key);
        }

        return $keys;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    private function convertFromJson(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents());
    }

}
