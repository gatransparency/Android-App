<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'gettingStarted' => [
        'title'          => 'Getting Started',
        'title_singular' => 'Getting Started',
    ],
    'member' => [
        'title'          => 'Members',
        'title_singular' => 'Member',
    ],
    'investigatingGovernment' => [
        'title'          => 'Investigating Government 101',
        'title_singular' => 'Investigating Government 101',
    ],
    'openRecordsInfo' => [
        'title'          => 'Open Records Info',
        'title_singular' => 'Open Records Info',
    ],
    'form' => [
        'title'          => 'Forms',
        'title_singular' => 'Form',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'form_name'          => 'Form Name',
            'form_name_helper'   => ' ',
            'form_format'        => 'Form Format',
            'form_format_helper' => ' ',
            'form'               => 'Form',
            'form_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'form_number'        => 'Form Number',
            'form_number_helper' => 'Ex. Yr/Month-Form-Number (2312-Form-00001',
        ],
    ],
    'caseLaw' => [
        'title'          => 'Case Law',
        'title_singular' => 'Case Law',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'case'                  => 'Case',
            'case_helper'           => ' ',
            'case_narrative'        => 'Case Narrative',
            'case_narrative_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'court'                 => 'Court',
            'court_helper'          => ' ',
            'decided'               => 'Decided On',
            'decided_helper'        => ' ',
            'case_file'             => 'Case File',
            'case_file_helper'      => ' ',
            'added_by'              => 'Added By',
            'added_by_helper'       => ' ',
            'docket_number'         => 'Docket Number',
            'docket_number_helper'  => ' ',
            'judge'                 => 'Judge',
            'judge_helper'          => ' ',
        ],
    ],
    'donation' => [
        'title'          => 'Donations',
        'title_singular' => 'Donation',
    ],
    'publicInformation' => [
        'title'          => 'Public Information',
        'title_singular' => 'Public Information',
    ],
    'submitRecord' => [
        'title'          => 'Submit Record',
        'title_singular' => 'Submit Record',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'role'                      => 'Employee Role',
            'role_helper'               => 'EX. Police Officer, Mayor, Public Official, etc.',
            'name'                      => 'Public Official Name',
            'name_helper'               => ' ',
            'agency_affiliation'        => 'Agency or Affiliation',
            'agency_affiliation_helper' => 'Name of police department or city hall. etc.',
            'address'                   => 'Agency or Affiliation Address',
            'address_helper'            => ' ',
            'image'                     => 'Picture',
            'image_helper'              => ' ',
            'files'                     => 'Files/Records',
            'files_helper'              => 'Any public records.',
            'narrative'                 => 'Describe Your Submission',
            'narrative_helper'          => 'Describe why you are submitting this public official.',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
    'agenciesOffice' => [
        'title'          => 'Agencies / Offices',
        'title_singular' => 'Agencies / Office',
        'fields'         => [
            'id'                               => 'ID',
            'id_helper'                        => ' ',
            'agency_name'                      => 'Agency Name',
            'agency_name_helper'               => ' ',
            'created_at'                       => 'Created at',
            'created_at_helper'                => ' ',
            'updated_at'                       => 'Updated at',
            'updated_at_helper'                => ' ',
            'deleted_at'                       => 'Deleted at',
            'deleted_at_helper'                => ' ',
            'street_address'                   => 'Street Address',
            'street_address_helper'            => ' ',
            'street_address_additional'        => 'Street Address Additional',
            'street_address_additional_helper' => ' ',
            'city'                             => 'City',
            'city_helper'                      => ' ',
            'state'                            => 'State',
            'state_helper'                     => ' ',
            'zip'                              => 'Zip',
            'zip_helper'                       => ' ',
            'phone_number'                     => 'Phone Number',
            'phone_number_helper'              => ' ',
            'fax'                              => 'Fax',
            'fax_helper'                       => ' ',
            'notes'                            => 'Notes',
            'notes_helper'                     => ' ',
            'image'                            => 'Image',
            'image_helper'                     => ' ',
            'website_url'                      => 'Website Url',
            'website_url_helper'               => ' ',
            'agency_email'                     => 'Agency Email',
            'agency_email_helper'              => ' ',
            'agency_rating'                    => 'Agency Rating',
            'agency_rating_helper'             => 'Ex. 1 being the lowest and 5 being the highest.',
        ],
    ],
    'portalVersion' => [
        'title'          => 'Portal Version',
        'title_singular' => 'Portal Version',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'portal_version'        => 'Portal Version',
            'portal_version_helper' => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'bug' => [
        'title'          => 'Bugs',
        'title_singular' => 'Bug',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'version'           => 'Version',
            'version_helper'    => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'status'            => 'Status',
            'status_helper'     => 'Ex. New, Pending, Scheduled, Fixed',
            'fixed'             => 'Fixed',
            'fixed_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'synopsis'          => 'Synopsis',
            'synopsis_helper'   => ' ',
        ],
    ],
    'reportbug' => [
        'title'          => 'Report a Bug',
        'title_singular' => 'Report a Bug',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Your Name',
            'name_helper'       => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'synopsis'          => 'Synopsis',
            'synopsis_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'portalRequest' => [
        'title'          => 'Portal Requests',
        'title_singular' => 'Portal Request',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'request'           => 'Request',
            'request_helper'    => 'What you would like added to the portal for future development.',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'changeLog' => [
        'title'          => 'Change Log',
        'title_singular' => 'Change Log',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'portal_version'        => 'Portal Version',
            'portal_version_helper' => ' ',
            'change'                => 'Change',
            'change_helper'         => ' ',
            'log'                   => 'Log',
            'log_helper'            => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'publicOfficial' => [
        'title'          => 'Public Officials',
        'title_singular' => 'Public Official',
        'fields'         => [
            'id'                            => 'ID',
            'id_helper'                     => ' ',
            'image'                         => 'Image',
            'image_helper'                  => ' ',
            'public_official_number'        => 'Public Official #',
            'public_official_number_helper' => ' ',
            'first_name'                    => 'First Name',
            'first_name_helper'             => ' ',
            'middle_name'                   => 'Middle Name',
            'middle_name_helper'            => ' ',
            'last_name'                     => 'Last Name',
            'last_name_helper'              => ' ',
            'badge_employee_number'         => 'Badge Employee #',
            'badge_employee_number_helper'  => ' ',
            'rank'                          => 'Rank',
            'rank_helper'                   => 'Police Rank / Civilian Postion',
            'status'                        => 'Status',
            'status_helper'                 => ' ',
            'officer_key_number'            => 'Officer Key #',
            'officer_key_number_helper'     => 'Law Enforcement Only',
            'hired'                         => 'Date Hired',
            'hired_helper'                  => ' ',
            'years_in_profession'           => 'Years In Profession',
            'years_in_profession_helper'    => ' ',
            'email'                         => 'Email',
            'email_helper'                  => ' ',
            'phone_number'                  => 'Phone Number',
            'phone_number_helper'           => ' ',
            'created_at'                    => 'Created at',
            'created_at_helper'             => ' ',
            'updated_at'                    => 'Updated at',
            'updated_at_helper'             => ' ',
            'deleted_at'                    => 'Deleted at',
            'deleted_at_helper'             => ' ',
            'previous_agency'               => 'Previous Agencies',
            'previous_agency_helper'        => ' ',
            'notes'                         => 'Notes',
            'notes_helper'                  => ' ',
            'signature'                     => 'Signature',
            'signature_helper'              => ' ',
            'initials'                      => 'Initials',
            'initials_helper'               => ' ',
            'sex'                           => 'Sex',
            'sex_helper'                    => 'Male or Female',
            'agency'                        => 'Agency',
            'agency_helper'                 => ' ',
            'accuracy'                      => 'Information is true and accurate',
            'accuracy_helper'               => 'Yes / No',
        ],
    ],
    'report' => [
        'title'          => 'Reports',
        'title_singular' => 'Report',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'agency'                   => 'Agency',
            'agency_helper'            => ' ',
            'report_date'              => 'Report Date',
            'report_date_helper'       => ' ',
            'report_number'            => 'Report Number',
            'report_number_helper'     => 'Yr-State-Number (Ex. 2022-GA-00005)',
            'full_name'                => 'Full Name',
            'full_name_helper'         => ' ',
            'date_of_occurance'        => 'Date Of Occurance',
            'date_of_occurance_helper' => ' ',
            'time'                     => 'Time',
            'time_helper'              => ' ',
            'location'                 => 'Location',
            'location_helper'          => ' ',
            'narrative'                => 'Narrative',
            'narrative_helper'         => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'official_number'          => 'Public Official #',
            'official_number_helper'   => ' ',
        ],
    ],
    'record' => [
        'title'          => 'Records',
        'title_singular' => 'Record',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'date_added'             => 'Date Added',
            'date_added_helper'      => ' ',
            'full_name'              => 'Full Name',
            'full_name_helper'       => ' ',
            'record_type'            => 'Record Type',
            'record_type_helper'     => ' ',
            'record'                 => 'Record',
            'record_helper'          => ' ',
            'entered_by'             => 'Entered By',
            'entered_by_helper'      => ' ',
            'agency'                 => 'Agency',
            'agency_helper'          => ' ',
            'public_official'        => 'Public Official #',
            'public_official_helper' => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'vehicle' => [
        'title'          => 'Vehicles',
        'title_singular' => 'Vehicle',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'agency'                 => 'Agency',
            'agency_helper'          => ' ',
            'public_official'        => 'Public Official #',
            'public_official_helper' => ' ',
            'image'                  => 'Image',
            'image_helper'           => ' ',
            'make'                   => 'Make',
            'make_helper'            => ' ',
            'model'                  => 'Model',
            'model_helper'           => ' ',
            'year'                   => 'Year',
            'year_helper'            => ' ',
            'number'                 => 'VehicleNumber',
            'number_helper'          => ' ',
            'marked'                 => 'Marked',
            'marked_helper'          => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'internalInvestigation' => [
        'title'          => 'Internal Investigations',
        'title_singular' => 'Internal Investigation',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'agency'                 => 'Agency',
            'agency_helper'          => ' ',
            'public_official'        => 'Public Official #',
            'public_official_helper' => ' ',
            'narrative'              => 'Narrative',
            'narrative_helper'       => ' ',
            'file'                   => 'File',
            'file_helper'            => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'entered_by'             => 'Entered By',
            'entered_by_helper'      => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],

];
