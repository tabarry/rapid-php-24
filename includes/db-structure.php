<?php

$main->set(
        'sulata_users', array(
    'user__ID' => array(
        'label' => 'ID',
        'type' => 'number',
        'length' => '',
        'required' => 'required',
        'star' => '*',
    ),
    'user__Name' => array(
        'label' => 'Name',
        'type' => 'text',
        'length' => '32',
        'required' => 'required',
        'star' => '*',
    ),
    'user__Email' => array(
        'label' => 'Email',
        'type' => 'email',
        'length' => '64',
        'required' => 'required',
        'star' => '*',
    ),
    'user__Password' => array(
        'label' => 'Password',
        'type' => 'password',
        'length' => '64',
        'required' => 'required',
        'star' => '*',
    ),
    'sulata_settings', array(
        'setting__ID' => array(
            'label' => 'ID',
            'type' => 'number',
            'length' => '',
            'required' => 'required',
            'star' => '*',
        ),
        'setting__Setting' => array(
            'label' => 'ID',
            'type' => 'number',
            'length' => '',
            'required' => 'required',
            'star' => '*',
        ),
    )
));
