<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$issue = new TimberPost();
$articles=$issue->articles;

$context['issue'] = $issue;
$context['wp_title'] .= ' - ' . $issue->title();

$args = array(
  'post_type' => 'article',
  'post__in' => $articles,
  'orderby' => 'post__in'
);

query_posts($args);
$context['articles'] = Timber::get_posts();

Timber::render('toc.twig', $context);