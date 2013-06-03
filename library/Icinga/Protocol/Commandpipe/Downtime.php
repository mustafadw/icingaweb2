<?php
namespace Icinga\Protocol\Commandpipe;

class Downtime
{
    public $startTime;
    public $endTime;
    private $fixed = false;
    public $duration;
    public $comment;

    public function __construct($start,$end,Comment $comment,$duration=0)
    {
        $this->startTime = $start;
        $this->endTime = $end;
        $this->comment = $comment;
        if($duration != 0)
            $this->fixed = true;
        $this->duration = intval($duration);
    }

    public function getFormatString($type) {
        return 'SCHEDULE_'.$type.'_DOWNTIME;%s'
            .($type == CommandPipe::TYPE_SERVICE ? ';%s;' : ';')
            .$this->startTime.';'.$this->endTime
            .';'.($this->fixed ? '1' : '0').';'.$this->duration.';0;'
            .$this->comment->author.';'.$this->comment->comment;
    }
}
