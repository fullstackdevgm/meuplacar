<?php

namespace Rebing\Soccerama\Requests;

use Rebing\Soccerama\SocceramaClient;

class Competition extends SocceramaClient {

    public function all()
    {
        return $this->callData('competitions');
    }
	
	public function allWithCountries()
    {
    	$this->SetInclude(['country']);	
        return $this->callData('competitions');
    }
	

    public function byId($competitionId, $includes = array())
    {
    	if(count($includes)) $this->SetInclude($includes);	
        return $this->call('competitions/' . $competitionId);
    }

}