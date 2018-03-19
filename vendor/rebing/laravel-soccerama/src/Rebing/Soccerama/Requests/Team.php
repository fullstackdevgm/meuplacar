<?php

namespace Rebing\Soccerama\Requests;

use Rebing\Soccerama\SocceramaClient;

class Team extends SocceramaClient {

    public function allBySeasonId($seasonId)
    {
        return $this->callData('teams/season/' . $seasonId);
    }

    public function byId($teamId, $includes = array())
    {
        if(count($includes)) $this->SetInclude($includes);
        return $this->call('teams/' . $teamId);
    }

    public function bySeasonId($teamId, $seasonId, $includes = array())
    {
        if(count($includes)) $this->SetInclude($includes);
        return $this->call('teams/' . $teamId . '/season/' . $seasonId);
    }

}
