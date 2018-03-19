<?php

namespace Rebing\Soccerama\Requests;

use Rebing\Soccerama\SocceramaClient;

class Head2Head extends SocceramaClient {

    public function byTeamsId($homeId, $awayId, $includes = array())
    {
    	if(count($includes)) $this->SetInclude($includes);
        return $this->callData('head2head/' . $homeId . '/' . $awayId);
    }

}