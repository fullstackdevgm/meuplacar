<?php

namespace Rebing\Soccerama\Requests;

use Rebing\Soccerama\SocceramaClient;

class Player extends SocceramaClient {

    public function byTeamAndSeasonId($teamId, $seasonId)
    {
        return $this->callData('players/team/' . $teamId . '/season/' . $seasonId);
    }

    public function byTeamId($teamId, $includes = array())
    {
        if(count($includes)) $this->SetInclude($includes);
        return $this->callData('players/team/' . $teamId);
    }

    public function byId($playerId, $includes = array())
    {
    	  if(count($includes)) $this->SetInclude($includes);
        return $this->call('players/' . $playerId);
    }

}
