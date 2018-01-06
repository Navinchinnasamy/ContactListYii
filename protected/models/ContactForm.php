<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
    public $firstName;
    public $lastName;
    public $dob;
    public $email;
    public $city;
    public $state;
    public $gender;
    public $zip;
    public $hobbies;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('firstName, dob, city, state, zip, gender', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'dob'=>'Date Of Birth',
        );
    }
}