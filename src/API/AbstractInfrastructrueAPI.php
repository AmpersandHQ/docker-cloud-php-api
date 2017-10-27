<?php


namespace DockerCloud\API;


use DockerCloud\Model\AbstractInfrastructrueModel;
use DockerCloud\Model\Response\AbstractGetResponse;

abstract class AbstractInfrastructrueAPI extends AbstractAPI
{
    const API_PRIFIX_BASE = '/api/infra/v1';
    protected $api_prifix = self::API_PRIFIX_BASE;

    /**
     * @param $namespace
     */
    function setOrganisationNamespace($namespace){
        $this->api_prifix = self::API_PRIFIX_BASE."/".$namespace;
    }

    /**
     * @param $uri
     *
     * @return AbstractInfrastructrueModel
     */
    abstract function getByUri($uri);

    /**
     * @param $uri
     *
     * @return AbstractGetResponse
     */
    abstract function getListByUri($uri);
}
