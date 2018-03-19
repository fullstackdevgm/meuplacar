<?php

namespace Rebing\Soccerama\Requests;

use Rebing\Soccerama\SocceramaClient;

class Season extends SocceramaClient {

    public function all()
    {
        return $this->callData('seasons');
    }

    public function byId($seasonId)
    {
        return $this->call('seasons/' . $seasonId);
    }

    public function resultsById($seasonId, $includes = array())
    {
        if(count($includes)) $this->SetInclude($includes);
        return $this->call('seasons/results/' . $seasonId);
    }
	
	public function resultsbyDate($seasonId, $fromDate, $toDate, $includes = array())
    {
        if($fromDate instanceof Carbon)
        {
            $fromDate = $fromDate->format('Y-m-d');
        }
        if($toDate instanceof Carbon)
        {
            $toDate = $toDate->format('Y-m-d');
        }
		
		if(count($includes)) $this->SetInclude($includes);

        return $this->callData('seasons/' . $seasonId . '/' . $fromDate . '/' . $toDate);
    }

}