<?php

namespace Models;

interface ReminderInterface
{
    public function getImage( $image );

    public function getForm();

    public function populateForm( &$form, $reminderId );

    public function validateForm( &$form, $postValues );

    public function save( $data );

}