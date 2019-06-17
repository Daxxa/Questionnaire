<?php


namespace App\Reports;
use koolreport;
use koolreport\processes\Custom;
use koolreport\processes\Group;
use koolreport\processes\RemoveColumn;
use koolreport\processes\Sort;
use koolreport\laravel\Friendship;

class Report1 extends \koolreport\KoolReport
{
    protected $poll;
    use Friendship;


    protected function setup()
    {
        $this->src("mysql")->query('SELECT q.title as Question,  aw.title as Answer,  aa.id as aa FROM question.answer aw
LEFT JOIN question.anon_answers aa ON aw.id = aa.answer_id
INNER JOIN question.question q ON q.id = aw.question_id
INNER JOIN question.poll p ON p.id = q.poll_id
')
            ->pipe(new Group(array(
                "by"=>"aa",
            )))

            ->pipe(new Group(array(
                "by"=>"Answer",
                "count"=>"Count"
            )))
            ->pipe(new Custom(function($row){
                if ($row["aa"]==0) $row["Count"]=0;
                return $row;
            }))

            ->pipe(new Sort(array(
               'Question'=>'asc',

            )))
            ->pipe(new RemoveColumn(array(
                "aa","unwantedColumn"
            )))

           ->pipe($this->dataStore('question'));
    }

    protected function OnBeforeSetup()
    {
        // Happens when report is about to call setup() method

        return true; // To allow setup() to run
    }
    public function setPoll($poll)
    {
        $this->poll = $poll->id;

    }
}