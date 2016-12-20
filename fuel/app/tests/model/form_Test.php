<?php

/**
 * Model Form class Tests
 *
 * @group App
 */
 class model_form_Test extends DbTestCase
 {
    protected $tables = array(
        // テーブル名 => YAMLファイル名
        'hatebs' => 'result',
    );

    public function test_IDでレコードを検索する()
    {
        foreach($this->result_fixt as $row)
        {
            $result = Model_Result::find_one_by_id($row['id']);

            foreach($row as $field => $value)
            {
                $test = $result->$field;
                $expected = $row[$field];
                $this->assertEquals($expected, $test);
            }
        }
    }
 }