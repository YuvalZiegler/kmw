<?php
/*
Template Name: Front Page
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render(array('page-front-page.twig'), $context);