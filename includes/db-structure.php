<?php

$main->mset(
        array(
            /* db */
            'db' => array(
                /* table starts */
                'sulata_users' => array(
                    /* fields */
                    'user__ID' => array('name' => 'user__ID', 'label' => 'ID', 'type' => 'number', 'length' => '9', 'required' => "required='required'", 'star' => '*'),
                   
                    'user__Password' => array('name' => 'user__Password', 'label' => 'Password', 'type' => 'password', 'length' => '32', "required='required'" => 'required', 'star' => '*'),
                ),
                /* table ends */
                /* table starts */
                'sulata_employees' => array(
                    /* fields */
                    'employee__ID' => array('name' => 'employee__ID', 'label' => 'ID', 'type' => 'number', 'length' => '9', 'required' => "required='required'", 'star' => '*'),
                    'employee__Name' => array('name' => 'employee__Name', 'label' => 'Name', 'type' => 'text', 'length' => '32', 'required' => "required='required'", 'star' => '*'),
                    'employee__Email' => array('name' => 'employee__Email', 'label' => 'Email', 'type' => 'email', 'length' => '32', 'required' => "required='required'", 'star' => '*'),
                    'user__Password' => array('name' => 'user__Password', 'label' => 'Password', 'type' => 'password', 'length' => '32', "required='required'" => 'required', 'star' => '*'),
                ),
            ),
        /* table ends */
        )
);

