<?php
/*
Template Name: Grooming Chronicles
*/

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;

Timber::render(array('page-grooming-chronicles.twig'), $context);