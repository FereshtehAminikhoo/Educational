<?php

function newFeedback($title, $body, $type){
    if(session()->has('feedbacks'))
        $session = session()->get('feedbacks');
    else
        $session = [];


    $session[] = ['title' => $title, 'body' => $body, 'type' => $type];
    session()->flash('feedbacks', $session);
}
