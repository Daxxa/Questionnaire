<?php


namespace App\Reports;

use koolreport\processes\Custom;
use koolreport\processes\Group;
use koolreport\processes\RemoveColumn;
use koolreport\processes\Sort;

class Report1 extends \koolreport\KoolReport
{
    use koolreport\laravel\Friendship;

    protected function settings()
    {
        //Define the "sales" data source which is the orders.csv
        return array(
            "dataSources"=>array(
                "question"=>array(
                    'host' => 'localhost',
                    'username' => 'admin',
                    'password' => '1111',
                    'dbname' => 'question',
                    'charset' => 'utf8',
                    'class' => "\koolreport\datasources\MySQLDataSource",

                ),
            ),

        );
    }

    protected function setup()
    {
        //Select the data source then pipe data through various process
        //until it reach the end which is the dataStore named "sales_by_customer".
        $this->src()->query('SELECT q.title as Question,  aw.title as Answer,  aa.id as aa FROM question.answer aw
LEFT JOIN question.anon_answers aa ON aw.id = aa.answer_id
INNER JOIN question.question q ON q.id = aw.question_id')
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
}