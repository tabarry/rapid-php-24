<?php

$main->mset(
        array(
            /* db */
            'db' => array(
                /* table starts */
                'sulata_users' => array(
                    /* fields */
                    'user__ID' => array('name'=>'user__ID','label' => 'ID', 'type' => 'number', 'length' => '9', 'required' => "required='required'", 'star' => '*'),
                    'user__Name' => array('name'=>'user__Name','label' => 'Name', 'type' => 'text', 'length' => '32', 'required' => "required='required'", 'star' => '*'),
                    'user__Email' => array('name'=>'user__Email','label' => 'Email', 'type' => 'email', 'length' => '32', 'required' => "required='required'", 'star' => '*'),
                    'user__Password' => array('name'=>'user__Password','label' => 'Password', 'type' => 'password', 'length' => '32', "required='required'" => 'required', 'star' => '*'),
                ),
                
            ),
            /* table ends */
            /* table starts */
            'sulata_settings' => array(
                /* fields */
                'setting__ID' => array('label' => 'ID', 'type' => 'number', 'length' => '9', 'required' => "required='required'", 'star' => '*'),
                'setting__Setting' => array('label' => 'Setting', 'type' => 'text', 'length' => '64', 'required' => "required='required'", 'star' => '*'),
                'setting__Key' => array('label' => 'Key', 'type' => 'text', 'length' => '64', 'required' => "required='required'", 'star' => '*'),
                'setting__Value' => array('label' => 'Value', 'type' => 'text', 'length' => '256', 'required' => "required='required'", 'star' => '*'),
            ),
            /* table ends */
        )
);
