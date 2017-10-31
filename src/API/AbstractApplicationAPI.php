<?php


namespace DockerCloud\API;


use DockerCloud\Exception;
use DockerCloud\Model\AbstractApplicationModel;
use DockerCloud\Model\Response\AbstractGetResponse;

/**
 * Class AbstractApplicationAPI
 *
 * @package DockerCloud\API
 */
abstract class AbstractApplicationAPI extends AbstractAPI
{
    const API_PRIFIX_BASE = '/api/app/v1';
    protected $api_prifix = self::API_PRIFIX_BASE;

    /**
     * @param $namespace
     */
    public function setOrganisationNamespace($namespace){
        $this->api_prifix = self::API_PRIFIX_BASE."/".$namespace;
    }

    /**
     * @param AbstractApplicationModel $Model
     * @param                          $state
     * @param int                      $sleepTime
     * @param int                      $timeOut
     *
     * @return AbstractApplicationModel
     * @throws Exception
     */
    public function waitForState(AbstractApplicationModel $Model, $state, $sleepTime = 10, $timeOut = 600)
    {
        $timer = 0;
        $Model = $this->getByUri($Model->getResourceUri());
        while ($state != $Model->getState()) {
            if ($timer >= $timeOut) {
                throw new Exception(sprintf('Waited resource [%s] to be in state [%s] timed out [%s seconds].',
                    $Model->getResourceUri(), $state, $timer));
            }
            sleep($sleepTime);
            $timer += $sleepTime;
            $Model = $this->getByUri($Model->getResourceUri());
        }

        return $Model;
    }

    /**
     * @param $uri
     *
     * @return AbstractApplicationModel
     */
    abstract function getByUri($uri);

    /**
     * @param $uri
     *
     * @return AbstractGetResponse
     */
    abstract function getListByUri($uri);
}
