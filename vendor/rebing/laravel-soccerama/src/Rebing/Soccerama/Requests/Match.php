<?php

namespace Rebing\Soccerama\Requests;


use Carbon\Carbon;
use Rebing\Soccerama\SocceramaClient;

class Match extends SocceramaClient {

    /**
     * Accepts dates as Carbon or 'YYYY-mm-dd' strings
     */
    public function byDate($fromDate, $toDate, $includes = array())
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

        return $this->callData('matches/' . $fromDate . '/' . $toDate);
    }

    public function byId($matchId, $includes = array())
    {
    	if(count($includes)) $this->SetInclude($includes);
        return $this->call('matches/' . $matchId);
    }

}
