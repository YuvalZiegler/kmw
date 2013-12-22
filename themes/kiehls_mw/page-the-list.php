<?php
/*
Template Name: The List
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(array('page-the-list.twig'), $context);