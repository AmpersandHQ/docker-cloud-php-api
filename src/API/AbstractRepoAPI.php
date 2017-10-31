<?php


namespace DockerCloud\API;


abstract class AbstractRepoAPI extends AbstractAPI
{
    const API_PRIFIX_BASE = '/api/repo/v1';
    protected $api_prifix = self::API_PRIFIX_BASE;

    /**
     * @param $namespace
     */
    public function setOrganisationNamespace($namespace){
        $this->api_prifix = self::API_PRIFIX_BASE."/".$namespace;
    }
}
