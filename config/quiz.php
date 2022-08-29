<?php

return [
    'main' => [
        'title' => 'Welcome to Studoc Quiz, Please select any of the following option',
        'menu' => ['create', 'list', 'reset']
    ],
    'create' => [
        'title' => 'Please select the CREATE option to create a new question',
        'user' => [
            'question' => 'Please enter the question',
            'answer' => 'Please answer the question'
        ]
    ],
    'list' => [
        'title' => 'List & practice the questions ',
        'user' => [
            'question' => 'Please enter the question',
            'answer' => 'Please answer the question'
        ]
    ],
    'practice' => [
        'title' => 'Do you want to practice the questions ?',
        'error_no_question' => 'No questions to display, please create a new question first',
        'user' => [
            'title' => 'Please select a question to answer',
            'msg_enter_questionid' => 'Please enter the question id',
            'success' => 'Welldone, your answer is correct',
            'error' => 'Sorry, your answer is wrong, try again :)',
            'error_not_found' => 'Question is not found, Enter the right id'
        ]
    ],
    'reset' => [
        'title' => 'Reset the quiz',
        'confirmation' => 'All the questions will be reset, Are you sure ?',
        'success' => 'Quiz is reset!!'
    ],
    'back' => [
        'title' => 'To go back to previous selection'
    ],
    'exit' => [
        'title' => 'To exit the menu',
        'confirmation' => 'Do you want to exit ?',
        'info_session_ended' => 'Your session is ended, thank you'
    ]
];
