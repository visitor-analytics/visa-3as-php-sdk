<?php

declare(strict_types=1);

namespace Visa\Websites;

class Consumption {
    private float $stpLimit;
    private float $stpConsumed;
    private float $stpRateVisit;
    private float $stpConsumedVisit;
    private float $stpRateVisitEvent;
    private float $stpConsumedVisitEvent;
    private float $stpRateSessionRecording;
    private float $stpConsumedSessionRecording;
    private float $stpRateHeatmapIncrement;
    private float $stpConsumedHeatmapIncrement;
    private float $stpRatePollAnswer;
    private float $stpConsumedPollAnswer;
    private float $stpRateSurveyAnswer;
    private float $stpConsumedSurveyAnswer;
    private float $stpRateFunnelMatch;
    private float $stpConsumedFunnelMatch;

    /**
     * Get the value of stpLimit
     */ 
    public function getStpLimit()
    {
        return $this->stpLimit;
    }

    /**
     * Set the value of stpLimit
     *
     * @return  self
     */ 
    public function setStpLimit($stpLimit)
    {
        $this->stpLimit = $stpLimit;

        return $this;
    }

     /**
     * Get the value of stpConsumed
     */ 
    public function getStpConsumed()
    {
        return $this->stpConsumed;
    }

    /**
     * Set the value of stpConsumed
     *
     * @return  self
     */ 
    public function setStpConsumed($stpConsumed)
    {
        $this->stpConsumed = $stpConsumed;

        return $this;
    }

    /**
     * Get the value of stpRateVisit
     */ 
    public function getStpRateVisit()
    {
        return $this->stpRateVisit;
    }

    /**
     * Set the value of stpRateVisit
     *
     * @return  self
     */ 
    public function setStpRateVisit($stpRateVisit)
    {
        $this->stpRateVisit = $stpRateVisit;

        return $this;
    }

    /**
     * Get the value of stpConsumedVisit
     */ 
    public function getStpConsumedVisit()
    {
        return $this->stpConsumedVisit;
    }

    /**
     * Set the value of stpConsumedVisit
     *
     * @return  self
     */ 
    public function setStpConsumedVisit($stpConsumedVisit)
    {
        $this->stpConsumedVisit = $stpConsumedVisit;

        return $this;
    }

    /**
     * Get the value of stpRateVisitEvent
     */ 
    public function getStpRateVisitEvent()
    {
        return $this->stpRateVisitEvent;
    }

    /**
     * Set the value of stpRateVisitEvent
     *
     * @return  self
     */ 
    public function setStpRateVisitEvent($stpRateVisitEvent)
    {
        $this->stpRateVisitEvent = $stpRateVisitEvent;

        return $this;
    }

    /**
     * Get the value of stpConsumedVisitEvent
     */ 
    public function getStpConsumedVisitEvent()
    {
        return $this->stpConsumedVisitEvent;
    }

    /**
     * Set the value of stpConsumedVisitEvent
     *
     * @return  self
     */ 
    public function setStpConsumedVisitEvent($stpConsumedVisitEvent)
    {
        $this->stpConsumedVisitEvent = $stpConsumedVisitEvent;

        return $this;
    }

    /**
     * Get the value of stpRateSessionRecording
     */ 
    public function getStpRateSessionRecording()
    {
        return $this->stpRateSessionRecording;
    }

    /**
     * Set the value of stpRateSessionRecording
     *
     * @return  self
     */ 
    public function setStpRateSessionRecording($stpRateSessionRecording)
    {
        $this->stpRateSessionRecording = $stpRateSessionRecording;

        return $this;
    }

    /**
     * Get the value of stpConsumedSessionRecording
     */ 
    public function getStpConsumedSessionRecording()
    {
        return $this->stpConsumedSessionRecording;
    }

    /**
     * Set the value of stpConsumedSessionRecording
     *
     * @return  self
     */ 
    public function setStpConsumedSessionRecording($stpConsumedSessionRecording)
    {
        $this->stpConsumedSessionRecording = $stpConsumedSessionRecording;

        return $this;
    }

    /**
     * Get the value of stpRateHeatmapIncrement
     */ 
    public function getStpRateHeatmapIncrement()
    {
        return $this->stpRateHeatmapIncrement;
    }

    /**
     * Set the value of stpRateHeatmapIncrement
     *
     * @return  self
     */ 
    public function setStpRateHeatmapIncrement($stpRateHeatmapIncrement)
    {
        $this->stpRateHeatmapIncrement = $stpRateHeatmapIncrement;

        return $this;
    }

    /**
     * Get the value of stpConsumedHeatmapIncrement
     */ 
    public function getStpConsumedHeatmapIncrement()
    {
        return $this->stpConsumedHeatmapIncrement;
    }

    /**
     * Set the value of stpConsumedHeatmapIncrement
     *
     * @return  self
     */ 
    public function setStpConsumedHeatmapIncrement($stpConsumedHeatmapIncrement)
    {
        $this->stpConsumedHeatmapIncrement = $stpConsumedHeatmapIncrement;

        return $this;
    }

    /**
     * Get the value of stpRatePollAnswer
     */ 
    public function getStpRatePollAnswer()
    {
        return $this->stpRatePollAnswer;
    }

    /**
     * Set the value of stpRatePollAnswer
     *
     * @return  self
     */ 
    public function setStpRatePollAnswer($stpRatePollAnswer)
    {
        $this->stpRatePollAnswer = $stpRatePollAnswer;

        return $this;
    }

    /**
     * Get the value of stpConsumedPollAnswer
     */ 
    public function getStpConsumedPollAnswer()
    {
        return $this->stpConsumedPollAnswer;
    }

    /**
     * Set the value of stpConsumedPollAnswer
     *
     * @return  self
     */ 
    public function setStpConsumedPollAnswer($stpConsumedPollAnswer)
    {
        $this->stpConsumedPollAnswer = $stpConsumedPollAnswer;

        return $this;
    }

    /**
     * Get the value of stpRateSurveyAnswer
     */ 
    public function getStpRateSurveyAnswer()
    {
        return $this->stpRateSurveyAnswer;
    }

    /**
     * Set the value of stpRateSurveyAnswer
     *
     * @return  self
     */ 
    public function setStpRateSurveyAnswer($stpRateSurveyAnswer)
    {
        $this->stpRateSurveyAnswer = $stpRateSurveyAnswer;

        return $this;
    }

    /**
     * Get the value of stpConsumedSurveyAnswer
     */ 
    public function getStpConsumedSurveyAnswer()
    {
        return $this->stpConsumedSurveyAnswer;
    }

    /**
     * Set the value of stpConsumedSurveyAnswer
     *
     * @return  self
     */ 
    public function setStpConsumedSurveyAnswer($stpConsumedSurveyAnswer)
    {
        $this->stpConsumedSurveyAnswer = $stpConsumedSurveyAnswer;

        return $this;
    }

    /**
     * Get the value of stpRateFunnelMatch
     */ 
    public function getStpRateFunnelMatch()
    {
        return $this->stpRateFunnelMatch;
    }

    /**
     * Set the value of stpRateFunnelMatch
     *
     * @return  self
     */ 
    public function setStpRateFunnelMatch($stpRateFunnelMatch)
    {
        $this->stpRateFunnelMatch = $stpRateFunnelMatch;

        return $this;
    }

    /**
     * Get the value of stpConsumedFunnelMatch
     */ 
    public function getStpConsumedFunnelMatch()
    {
        return $this->stpConsumedFunnelMatch;
    }

    /**
     * Set the value of stpConsumedFunnelMatch
     *
     * @return  self
     */ 
    public function setStpConsumedFunnelMatch($stpConsumedFunnelMatch)
    {
        $this->stpConsumedFunnelMatch = $stpConsumedFunnelMatch;

        return $this;
    }
}
